<?php

namespace App\Http\Controllers\Admin\BedType;

use App\DataTables\Admin\BedType\BedTypeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BedType\BedTypeRequest;
use App\Models\BedType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BedTypeController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView(): array
    {
        return [
            'index' => 'admin.bed_types.index',
            'create' => 'admin.bed_types.create',
            'edit' => 'admin.bed_types.edit'
        ];
    }

    public function getRoute(): array
    {
        return [
            'index' => 'admin.bed_type.index',
            'create' => 'admin.bed_type.create',
            'edit' => 'admin.bed_type.edit',
            'delete' => 'admin.bed_type.delete'
        ];
    }

    public function index(BedTypeDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách Loại Giường'))
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách loại giường'),
                route($this->route['index'])
            )->add('Thêm loại giường')
        ]);
    }

    public function edit($id)
    {
        $bedType = BedType::find($id);
        return view($this->view['edit'], [
            'breadcrumbs' => $this->crums->add(('Danh sách loại giường'), route($this->route['index']))->add('Sửa Loại giường'),
            'bedType' => $bedType,
        ]);
    }

    public function update(BedTypeRequest $request)
    {
        $this->data = $request->validated();
        if (BedType::where('name', '=', $this->data['name'])->exists()) {
            return redirect()->route($this->route['edit'], $this->data['id'])->with('error', 'Loại giường đã tồn tại');
        }
        try {
            DB::beginTransaction();
            $bedType = BedType::findOrFail($this->data['id']);
            unset($this->data['id']);
            $bedType->update($this->data);
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Cập nhập thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route($this->route['edit'], $this->data['id'])->with('error', 'Cập nhập thất bại');
        }
    }

    public function store(BedTypeRequest $request)
    {
        $this->data = $request->validated();
        if (BedType::where('name', '=', $this->data['name'])->exists()) {
            return redirect()->route($this->route['create'])->with('error', 'Loại giường đã tồn tại');
        }
        try {
            DB::beginTransaction();
            BedType::create($this->data);
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Thêm thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route($this->route['create'])->with('error', 'Thêm thất bại');
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $this->data = BedType::find($id);
            $this->data->delete();
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route($this->route['index'])->with('error', 'Xóa thất bại');
        }
    }
}
