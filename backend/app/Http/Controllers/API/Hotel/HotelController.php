<?php

namespace App\Http\Controllers\API\Hotel;

use App\Enums\Booking\BookingStatus;
use App\Enums\Hotel\HotelStatus;
use App\Enums\RoomType\RoomTypeStatus;
use App\Enums\Season\SeasonStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Hotel\HotelRequest;
use App\Http\Resources\FavoriteHotelResource;
use App\Http\Resources\HotelDetailResource;
use App\Http\Resources\HotelSuggestResource;
use App\Models\Hotel;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HotelController extends Controller
{
    private $data;
    public function __construct()
    {
        parent::__construct();
    }

    public function listHotelSeasons(Request $request)
    {
        $name = $request->query('name');
        $hotels = Hotel::whereHas('roomTypes.variants.seasons', function ($query) use ($name) {
            $query->where('status', SeasonStatus::Active->value);
            if ($name) {
                $query->where('name', 'LIKE', '%' . $name . '%');
            }
        })->with(['roomTypes.variants.seasons'])
            ->where('status', HotelStatus::Active->value)
            ->get();
        return response()->json([
            'message' => 'Danh sách khách sạn có ưu đãi.',
            'data' => [
                'hotels' => $hotels
            ]
        ], 200);
    }

    public function detailHotel(Request $request)
    {
        $id = $request->query('id');
        $hotel = Hotel::with([
            'hotelRule',
            'amenities',
            'services',
            'combos.comboServices.service',
            'vouchers',
            'hotelServices',
            'reviews.user',
            'reviews.booking.bookingDetails.roomType'
        ])
        ->find($id);
        return response()->json([
            'message' => 'Chi tiết khách sạn.',
            'data' => [
                'hotel' => new HotelDetailResource($hotel),
            ]
        ], 200);
    }

    public function registerHotel(HotelRequest $request)
    {
        $this->data = $request->validated();
        DB::beginTransaction();
        $hotel = Hotel::find($request->user_id);
        if ($hotel && $hotel->status == HotelStatus::Pending) {
            return response()->json([
                'message' => 'Bạn đã đăng kí khách sạn vui lòng chờ kết quả!.',
                'data' => []
            ], 400);
        }
        if ($hotel && $hotel->status == HotelStatus::Active) {
            return response()->json([
                'message' => 'Bạn đã có khách sạn.',
                'data' => []
            ], 400);
        }
        try {
            if ($this->data['star_rating'] && $this->data['star_rating'] == 0) {
                unset($this->data['star_rating']);
            }
            $this->data['status'] = HotelStatus::Pending->value;

            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');

                $fileName = time() . '_' . $file->getClientOriginalName();
                $this->data['avatar'] = '/assets/images/' . $fileName;

                $file->move(public_path('assets/images'), $fileName);
            }

            $this->data['id'] = $request->user_id;

            Hotel::create($this->data);
            DB::commit();
            return response()->json([
                'message' => 'Đăng kí thành công. Cảm ơn vì đã hợp tác cùng chúng tôi!',
                'data' => []
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Lỗi thêm khách sạn: ' . $e->getMessage());
            return response()->json([
                'message' => 'Có lỗi khi đăng kí.',
                'data' => []
            ], 500);
        }
    }

    public function favorites(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::find($request->user_id);

            $favorited = $user->favorites()->where('hotel_id', $request->hotel_id)->exists();

            if ($favorited) {
                $user->favorites()->detach($request->hotel_id);
                $message = 'Đã xóa khỏi danh sách yêu thích';
            } else {
                $user->favorites()->attach($request->hotel_id);
                $message = 'Đã thêm vào danh sách yêu thích';
            }

            DB::commit();
            return response()->json([
                'message' => $message,
                'data' => []
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Lỗi yêu thích: ' . $e->getMessage());
            return response()->json([
                'message' => 'Có lỗi khi yêu thích:' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }
    public function list_favorites(Request $request)
    {
        $user = User::with('favorites')->where('status', HotelStatus::Active->value)->findOrFail($request->user_id);

        return response()->json([
            'data' => FavoriteHotelResource::collection($user->favorites),
        ]);
    }

    public function search_hotel(Request $request)
    {
        $address    = $request->string('address')->trim();
        $amenities  = $request->input('amenities', []);
        $guest      = (int) $request->input('guest', 1);
        $children   = (int) $request->input('children', 0);
        $checkIn    = $request->date('checkin');
        $checkOut   = $request->date('checkout');
        $minPrice   = $request->input('min_price');
        $maxPrice   = $request->input('max_price');
        $quantity   = (int) $request->input('quantity', 1);
        $minRating  = $request->input('min_rating');

        if (!$checkIn || !$checkOut) {
            return response()->json([
                'message' => 'Phải chọn ngày giờ check-in và check-out'
            ], 400);
        }

        $hotels = Hotel::query()
            ->where('status', HotelStatus::Active->value)

            ->when(!empty($address), function ($q) use ($address) {
                $q->where('address', 'LIKE', '%' . $address . '%');
            })

            ->when(!empty($amenities), function ($q) use ($amenities) {
                foreach ($amenities as $amenityId) {
                    $q->whereHas('amenities', fn($q2) => $q2->where('amenities.id', $amenityId));
                }
            })

            ->whereHas('roomTypes', function ($roomTypeQ) use ($checkIn, $checkOut, $quantity, $guest, $children, $minPrice, $maxPrice) {

                $roomTypeQ->withCount(['rooms as available_room_count' => function ($roomQ) use ($checkIn, $checkOut) {
                    $roomQ->where('status',RoomTypeStatus::Active);
                    $roomQ->whereDoesntHave(
                        'bookingDetails',
                        fn($bd) =>
                        $bd->whereHas(
                            'booking',
                            fn($b) =>
                            $b->where('checkin_date', '<',  $checkOut)
                                ->where('checkout_date', '>', $checkIn)
                                ->whereIn('status', [
                                    BookingStatus::Pending->value,
                                    BookingStatus::Confirmed->value,
                                    BookingStatus::CheckedIn->value,
                                ])
                        )
                    );
                }])
                    ->having('available_room_count', '>=', $quantity)

                    ->whereHas('variants', function ($variantQ) use ($guest, $children, $checkIn, $checkOut, $minPrice, $maxPrice) {
                        $variantQ
                            ->whereHas('attributes', function ($q) use ($guest) {
                                $q->where('attributes.type', 'guest')
                                    ->whereRaw('CAST(variant_attributes.attribute_value AS UNSIGNED) >= ?', [$guest]);
                            })
                            ->whereHas('attributes', function ($q) use ($children) {
                                $q->where('attributes.type', 'children')
                                    ->whereRaw('CAST(variant_attributes.attribute_value AS UNSIGNED) >= ?', [$children]);
                            })
                            ->whereDoesntHave('bookingDetails', function ($d) use ($checkIn, $checkOut) {
                                $d->whereHas('booking', function ($b) use ($checkIn, $checkOut) {
                                    $b->where('checkin_date', '<',  $checkOut)
                                        ->where('checkout_date', '>', $checkIn)
                                        ->whereIn('status', [
                                            BookingStatus::Pending->value,
                                            BookingStatus::Confirmed->value,
                                            BookingStatus::CheckedIn->value,
                                        ]);
                                });
                            })
                            ->when($minPrice && $maxPrice, function ($q) use ($minPrice, $maxPrice) {
                                $q->whereRaw('CASE WHEN discount_price > 0 THEN discount_price ELSE base_price END BETWEEN ? AND ?', [$minPrice, $maxPrice]);
                            })
                            ->when($minPrice && !$maxPrice, function ($q) use ($minPrice) {
                                $q->whereRaw('CASE WHEN discount_price > 0 THEN discount_price ELSE base_price END >= ?', [$minPrice]);
                            })
                            ->when(!$minPrice && $maxPrice, function ($q) use ($maxPrice) {
                                $q->whereRaw('CASE WHEN discount_price > 0 THEN discount_price ELSE base_price END <= ?', [$maxPrice]);
                            });
                    });
            })

            // Load các quan hệ
            ->with([
                'roomTypes' => function ($roomTypeQ) use ($guest, $children, $checkIn, $checkOut, $minPrice, $maxPrice, $quantity) {
                    $roomTypeQ->where('status',RoomTypeStatus::Active);
                    $roomTypeQ->withCount(['rooms as available_room_count' => function ($roomQ) use ($checkIn, $checkOut) {
                        $roomQ->whereDoesntHave(
                            'bookingDetails',
                            fn($bd) =>
                            $bd->whereHas(
                                'booking',
                                fn($b) =>
                                $b->where('checkin_date', '<',  $checkOut)
                                    ->where('checkout_date', '>', $checkIn)
                                    ->whereIn('status', [
                                        BookingStatus::Pending->value,
                                        BookingStatus::Confirmed->value,
                                        BookingStatus::CheckedIn->value,
                                    ])
                            )
                        );
                    }])
                        ->having('available_room_count', '>=', $quantity)
                        ->with([
                            'variants' => function ($variantQ) use ($guest, $children, $checkIn, $checkOut, $minPrice, $maxPrice) {
                                $variantQ
                                    ->whereHas('attributes', function ($q) use ($guest) {
                                        $q->where('attributes.type', 'guest')
                                            ->whereRaw('CAST(variant_attributes.attribute_value AS UNSIGNED) >= ?', [$guest]);
                                    })
                                    ->whereHas('attributes', function ($q) use ($children) {
                                        $q->where('attributes.type', 'children')
                                            ->whereRaw('CAST(variant_attributes.attribute_value AS UNSIGNED) >= ?', [$children]);
                                    })
                                    ->whereDoesntHave('bookingDetails', function ($d) use ($checkIn, $checkOut) {
                                        $d->whereHas('booking', function ($b) use ($checkIn, $checkOut) {
                                            $b->where('checkin_date', '<',  $checkOut)
                                                ->where('checkout_date', '>', $checkIn)
                                                ->whereIn('status', [
                                                    BookingStatus::Pending->value,
                                                    BookingStatus::Confirmed->value,
                                                    BookingStatus::CheckedIn->value,
                                                ]);
                                        });
                                    })
                                    ->when($minPrice && $maxPrice, function ($q) use ($minPrice, $maxPrice) {
                                        $q->whereRaw('CASE WHEN discount_price > 0 THEN discount_price ELSE base_price END BETWEEN ? AND ?', [$minPrice, $maxPrice]);
                                    })
                                    ->when($minPrice && !$maxPrice, function ($q) use ($minPrice) {
                                        $q->whereRaw('CASE WHEN discount_price > 0 THEN discount_price ELSE base_price END >= ?', [$minPrice]);
                                    })
                                    ->when(!$minPrice && $maxPrice, function ($q) use ($maxPrice) {
                                        $q->whereRaw('CASE WHEN discount_price > 0 THEN discount_price ELSE base_price END <= ?', [$maxPrice]);
                                    })
                                    ->with(['attributes', 'seasons']);
                            },
                            'bedType:id,name',
                        ]);
                },
                'amenities'
            ])

            ->withAvg('reviews', 'star')
            ->withCount('reviews')

            ->when($minRating, fn($q) =>
            $q->having('reviews_avg_star', '>=', $minRating));

        $results = $hotels->get();

        return response()->json([
            'message' => 'Danh sách khách sạn tìm kiếm',
            'data' => HotelSuggestResource::collection($results),
        ]);
    }
}
