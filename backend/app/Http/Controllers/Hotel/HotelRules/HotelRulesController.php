<?php

namespace App\Http\Controllers\Hotel\HotelRules;

use App\Enums\HotelRule\HotelRuleChildPolicy;
use App\Enums\HotelRule\HotelRulePetPolicy;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\HotelRules\HotelRulesRequest;
use App\Models\Hotel;
use App\Models\HotelRule;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelRulesController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView(): array
    {
        return [
            'index' => 'hotel.hotel_rules.index',
        ];
    }

    public function getRoute(): array
    {
        return [
            'index' => 'hotel.hotel_rules.index',
            'update' => 'hotel.hotel_rules.update'
        ];
    }

    public function index($hotel_id)
    {
        $hotel = HotelRule::where('id', $hotel_id)->first();
        return view($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Quy tắc Khách sạn')),
            'hotel' => $hotel
        ]);
    }
    public function update(HotelRulesRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();
            $this->data['pet_policy'] = $this->data['pet_policy'] ?? HotelRulePetPolicy::NotAllowed->value;
            $this->data['child_policy'] = $this->data['child_policy'] ?? HotelRuleChildPolicy::NotAllowed->value;
            $this->data['extra_bed_fee'] = isset($this->data['extra_bed_fee_check']) ? $this->data['extra_bed_fee'] : -1;
            unset($this->data['extra_bed_fee_check']);

            $hotel = Hotel::find($this->data['id']);

            if ($hotel->hotelRule()->exists()) {
                $hotel->hotelRule()->update($this->data);
            } else {
                $hotel->hotelRule()->create($this->data);
            }

            DB::commit();
            return redirect()->route($this->route['index'], [$this->data['id']])->with('success', 'Cập nhập thành công');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route($this->route['index'], [$this->data['id']])->with('error', 'Cập nhập thất bại');
        }
    }
}
