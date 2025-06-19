<?php

namespace App\Http\Controllers\Hotel\Combo;

use App\DataTables\Hotel\Combo\ComboDataTable;
use App\Enums\Combo\ComboStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\Combo\ComboRequest;
use App\Models\Combo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ComboController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView()
    {
        return [
            'index' => 'hotel.Combos.index',
            'create' => 'hotel.Combos.create',
            'edit' => 'hotel.Combos.edit'
        ];
    }
    public function getRoute(): array
    {
        return [
            'index' => 'hotel.combo.index',
            'create' => 'hotel.combo.create',
            'edit' => 'hotel.combo.edit',
            'delete' => 'hotel.combo.delete'
        ];
    }
    public function index(ComboDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách combo'))
        ]);
    }
    public function create($hotel_id)
    {
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách Combo'),
                route($this->route['index'], $hotel_id)
            )->add('Thêm Combo')
        ]);
    }
    public function edit($hotel_id, $id)
    {
        $combo = Combo::find($id);
        return view($this->view['edit'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách Combo'),
                route($this->route['index'], $hotel_id)
            )->add('Cập nhập Combo'),
            'combo' => $combo
        ]);
    }
    public function store($hotel_id, ComboRequest $request)
    {
        $this->data = $request->validated();
        DB::beginTransaction();
        try {
            $this->data['original_price'] = 0;
            $this->data['hotel_id'] = $hotel_id;
            $this->data['status'] = $this->data['status'] ?? ComboStatus::Inactive->value;
            Combo::create($this->data);
            DB::commit();
            return redirect()->route($this->route['index'], $hotel_id)->with('success', 'Thêm thành công');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route($this->route['create'], $hotel_id)->with('error', 'Thêm thất bại');
        }
    }
    public function update($hotel_id, ComboRequest $request)
    {
        $this->data = $request->validated();
        DB::beginTransaction();
        try {
            $this->data['status'] = $this->data['status'] ?? ComboStatus::Inactive->value;
            $combo = Combo::find($this->data['id']);
            $combo->update($this->data);
            DB::commit();
            return redirect()->route($this->route['index'], $hotel_id)->with('success', 'Cập nhật thành công');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route($this->route['edit'], ['hotel_id' => $hotel_id, 'id' => $this->data['id']])->with('error', 'Cập nhật thất bại');
        }
    }

    public function delete($hotel_id,$id)
    {
        DB::beginTransaction();
        try {
            $this->data = Combo::find($id);
            $this->data->delete();
            DB::commit();
            return redirect()->route($this->route['index'],$hotel_id)->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route($this->route['index'],$hotel_id)->with('error', 'Xóa thất bại');
        }
    }
}
