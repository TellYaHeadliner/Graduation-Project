<?php

namespace App\Http\Controllers\Admin\Voucher;

use App\DataTables\Admin\Voucher\VoucherDataTable;
use App\Enums\Voucher\VoucherCustomerScope;
use App\Enums\Voucher\VoucherDiscountType;
use App\Enums\Voucher\VoucherHotelScope;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Voucher\VoucherRequest;
use App\Models\Hotel;
use App\Models\User;
use App\Models\Voucher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VoucherController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView(): array
    {
        return [
            'index' => 'admin.voucher.index',
            'create' => 'admin.voucher.create',
            'edit' => 'admin.voucher.edit'
        ];
    }

    public function getRoute(): array
    {
        return [
            'index' => 'admin.voucher.index',
            'create' => 'admin.voucher.create',
            'edit' => 'admin.voucher.edit',
            'delete' => 'admin.voucher.delete'
        ];
    }

    public function index(VoucherDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách Voucher'))
        ]);
    }
    public function create()
    {
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add('Danh sách Voucher')
        ]);
    }
    public function store(VoucherRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();

            $this->data['discount_value'] = $this->data['discount_type'] == VoucherDiscountType::FixedAmount->value ? $this->data['discount_value_price'] : $this->data['discount_value_percent'];

            unset($this->data['discount_value_percent'], $this->data['discount_value_price']);

            $this->data['hotel_scope'] = isset($this->data['hotel_id']) ? VoucherHotelScope::SpecificHotels->value : VoucherHotelScope::All->value;
            $this->data['customer_scope'] = isset($this->data['user_id']) ? VoucherCustomerScope::SpecificCustomers->value : VoucherCustomerScope::All->value;

            $this->data['is_active'] = $this->data['is_active'] ?? 0;

            $users = isset($this->data['user_id']) ? $this->data['user_id'] : User::pluck('id')->toArray();
            unset($this->data['user_id']);


            $hotels = isset($this->data['hotel_id']) ? $this->data['hotel_id'] : Hotel::pluck('id')->toArray();
            unset($this->data['hotel_id']);


            $voucher = voucher::create($this->data);

            $voucher->users()->attach($users);
            $voucher->hotels()->attach($hotels);
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Thêm thành công');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->route($this->route['create'])->with('error', 'Thêm thất bại');
        }
    }

    public function edit($id)
    {
        $voucher = Voucher::with(['users', 'hotels'])->find($id);
        return view($this->view['edit'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách voucher'),
                route($this->route['index'])
            )->add('Cập nhập voucher'),
            'voucher' => $voucher,
        ]);
    }
    public function update(VoucherRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();

            $this->data['discount_value'] = $this->data['discount_type'] == VoucherDiscountType::FixedAmount->value ? $this->data['discount_value_price'] : $this->data['discount_value_percent'];

            unset($this->data['discount_value_percent'], $this->data['discount_value_price']);

            $this->data['hotel_scope'] = isset($this->data['hotel_id']) ? VoucherHotelScope::SpecificHotels->value : VoucherHotelScope::All->value;
            $this->data['customer_scope'] = isset($this->data['user_id']) ? VoucherCustomerScope::SpecificCustomers->value : VoucherCustomerScope::All->value;

            $this->data['is_active'] = $this->data['is_active'] ?? 0;

            $users = isset($this->data['user_id']) ? $this->data['user_id'] : User::pluck('id')->toArray();
            unset($this->data['user_id']);


            $hotels = isset($this->data['hotel_id']) ? $this->data['hotel_id'] : Hotel::pluck('id')->toArray();
            unset($this->data['hotel_id']);


            $voucher = voucher::find($this->data['id']);
            $voucher->update($this->data);
            $voucher->users()->sync($users);
            $voucher->hotels()->sync($hotels);
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Cập nhập thành công');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->route($this->route['edit'], [$this->data['id']])->with('error', 'Cập nhập thất bại');
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $this->data = Voucher::find($id);
            $this->data->delete();
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route($this->route['index'])->with('error', 'Xóa thất bại');
        }
    }
}
