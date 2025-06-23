<?php

namespace App\Http\Controllers\Hotel\ComboService;

use App\DataTables\Hotel\Combo\ComboServiceDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\ComboService\ComboServiceRequest;
use App\Models\Combo;
use App\Models\ComboService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ComboServiceController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView()
    {
        return [
            'index' => 'hotel.combos.combo_services.index',
            'create' => 'hotel.combos.combo_services.create',
            'edit' => 'hotel.combos.combo_services.edit'
        ];
    }
    public function getRoute(): array
    {
        return [
            'index' => 'hotel.combo_service.index',
            'create' => 'hotel.combo_service.create',
            'edit' => 'hotel.combo_service.edit',
            'delete' => 'hotel.combo_service.delete'
        ];
    }
    public function index($hotel_id, $combo_id, ComboServiceDataTable $dataTable)
    {
        $combo = Combo::find($combo_id);
        return $dataTable->with('combo', $combo)->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách Combo'),
                route('hotel.combo.index', [$hotel_id])
            )->add('Danh sách dịch vụ combo'),
            'combo' => $combo,
        ]);
    }
    public function create($hotel_id, $combo_id)
    {
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách dịch vụ combo'),
                route($this->route['index'], [$hotel_id, $combo_id])
            )->add('Thêm dịch vụ combo'),
            'combo_id' => $combo_id,
        ]);
    }
    public function edit($hotel_id, $combo_id, $hotel_service_id)
    {
        $combo_service = ComboService::with('hotelService', 'service')->where('hotel_service_id', $hotel_service_id)
            ->where('combo_id', $combo_id)->first();
        return view($this->view['edit'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách dịch vụ combo'),
                route($this->route['index'], [$hotel_id, $combo_id])
            )->add('Cập nhập dịch vụ combo'),
            'combo_service' => $combo_service,
        ]);
    }

    public function store($hotel_id, $combo_id, ComboServiceRequest $request)
    {
        $this->data = $request->validated();
        DB::beginTransaction();
        try {
            if (ComboService::where('hotel_service_id', $this->data['hotel_service_id'])
                ->where('combo_id', $combo_id)->exists()
            ) {
                return redirect()->route($this->route['create'], ['hotel_id' => $hotel_id, 'combo_id' => $combo_id])
                    ->with('error', 'Dịch vụ đã tồn tại trong combo này');
            }
            $combo = Combo::find($combo_id);

            $combo->hotelServices()->attach($this->data['hotel_service_id'], [
                'quantity' => $this->data['quantity']
            ]);

            $comboService = ComboService::with('hotelService')->where('hotel_service_id', $this->data['hotel_service_id'])
                ->where('combo_id', $combo_id)->first();

            $combo->update([
                'original_price' => $combo->original_price + $comboService->hotelService->base_price * $this->data['quantity']
            ]);
            DB::commit();
            return redirect()->route($this->route['index'], ['hotel_id' => $hotel_id, 'combo_id' => $combo_id])->with('success', 'Thêm thành công');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route($this->route['create'], ['hotel_id' => $hotel_id, 'combo_id' => $combo_id])->with('error', 'Thêm thất bại');
        }
    }
    public function update($hotel_id, ComboServiceRequest $request)
    {
        $this->data = $request->validated();
        DB::beginTransaction();
        try {
            $combo = Combo::find($this->data['combo_id']);

            $comboService = ComboService::with('hotelService')->where('hotel_service_id', $this->data['hotel_service_id'])
                ->where('combo_id', $this->data['combo_id'])->first();

            $combo->hotelServices()->updateExistingPivot($this->data['hotel_service_id'], [
                'quantity' => $this->data['quantity']
            ]);

            $oldQuantity = $comboService->quantity;
            $updateQuantity = $this->data['quantity'] - $oldQuantity;

            $combo->original_price += $comboService->hotelService->base_price * $updateQuantity;
            $combo->save();
            DB::commit();
            return redirect()->route($this->route['index'], ['hotel_id' => $hotel_id, 'combo_id' => $this->data['combo_id']])->with('success', 'Cập nhập thành công');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route($this->route['edit'], ['hotel_id' => $hotel_id, 'combo_id' => $this->data['combo_id'], 'hotel_service_id' => $this->data['hotel_service_id']])->with('error', 'Cập nhập thất bại');
        }
    }

    public function delete($hotel_id, $combo_id, $hotel_service_id)
    {
        DB::beginTransaction();
        try {
            $combo = Combo::find($combo_id);
            $comboService = ComboService::with('hotelService')->where('hotel_service_id', $hotel_service_id)
                ->where('combo_id', $combo_id)->first();

            $combo->update([
                'original_price' => $combo->original_price - $comboService->hotelService->base_price * $comboService->quantity
            ]);
            $combo->hotelServices()->detach($hotel_service_id);
            DB::commit();
            return redirect()->route($this->route['index'], ['hotel_id' => $hotel_id, 'combo_id' => $combo_id])->with('success', 'Xóa thành công');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route($this->route['index'], ['hotel_id' => $hotel_id, 'combo_id' => $combo_id])->with('error', 'Xóa thất bại');
        }
    }
}
