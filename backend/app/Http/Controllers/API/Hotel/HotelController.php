<?php

namespace App\Http\Controllers\API\Hotel;

use App\Enums\Hotel\HotelStatus;
use App\Enums\Season\SeasonStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Hotel\HotelRequest;
use App\Http\Resources\FavoriteHotelResource;
use App\Http\Resources\HotelDetailResource;
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
            'hotelServices'
        ])->find($id);
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
        $user = User::with('favorites')->findOrFail($request->user_id);

        return response()->json([
            'data' => FavoriteHotelResource::collection($user->favorites),
        ]);
    }

    public function searh_hotel($check_in = null, $check_out = null, $address = null, $guest = null, $children = null, $quantity = 1)
    {

    }
}
