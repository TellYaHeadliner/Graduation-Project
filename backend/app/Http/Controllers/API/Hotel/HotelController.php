<?php

namespace App\Http\Controllers\API\Hotel;

use App\Enums\Hotel\HotelStatus;
use App\Enums\Season\SeasonStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Hotel\HotelRequest;
use App\Models\Hotel;
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
            'vouchers'
        ])->find($id);
        return response()->json([
            'message' => 'Chi tiết khách sạn.',
            'data' => [
                'hotel' => $hotel
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

            if ($request->hasFile('gallery')) {
                $this->data['gallery'] = [];
                foreach ($request->file('gallery') as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $this->data['gallery'][] = '/assets/images/' . $fileName;
                    $file->move(public_path('assets/images'), $fileName);
                }
                $this->data['gallery'] = implode(',', $this->data['gallery']);
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
}
