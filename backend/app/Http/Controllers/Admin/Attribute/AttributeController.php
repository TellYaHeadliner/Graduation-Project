<?php

namespace App\Http\Controllers\Admin\Attribute;

use App\DataTables\Admin\Attribute\AttributeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Attribute\AttributeRequest;
use App\Models\Attribute;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView()
    {
        return [
            'index' => 'admin.attribute.index',
            'create' => 'admin.attribute.create',
            'edit' => 'admin.attribute.edit'
        ];
    }
    public function getRoute(): array
    {
        return [
            'index' => 'admin.attribute.index',
            'create' => 'admin.attribute.create',
            'edit' => 'admin.attribute.edit',
            'delete' => 'admin.attribute.delete'
        ];
    }
    public function index(AttributeDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách thuộc tính'))
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách thuộc tính'),
                route($this->route['index'])
            )->add('Thêm thuộc tính')
        ]);
    }
    public function edit($id)
    {
        $attribute = Attribute::find($id);
        return view($this->view['edit'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách thuộc tính'),
                route($this->route['index'])
            )->add('Cập nhập thuộc tính'),
            'attribute' => $attribute
        ]);
    }
    public function store(AttributeRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();
            $this->data['is_active'] = $this->data['is_active'] ?? 0;
            Attribute::create($this->data);
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Thêm thành công');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route($this->route['create'])->with('error', 'Thêm thất bại');
        }
    }
    public function update(AttributeRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();
            $this->data['is_active'] = $this->data['is_active'] ?? 0;
            
            $attribute = Attribute::find($this->data['id']);
            $attribute->update($this->data);
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Thêm thành công');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route($this->route['create'])->with('error', 'Thêm thất bại');
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $this->data = Attribute::find($id);
            $this->data->delete();
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route($this->route['index'])->with('error', 'Xóa thất bại');
        }
    }
}
