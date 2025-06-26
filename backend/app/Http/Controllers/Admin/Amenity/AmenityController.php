<?php

namespace App\Http\Controllers\Admin\Amenity;

use App\DataTables\Admin\Amenity\AmenityDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Amenity\AmenityRequest;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AmenityController extends Controller
{

    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView(): array
    {
        return [
            'index' => 'admin.amenity.index',
            'create' => 'admin.amenity.create',
            'edit' => 'admin.amenity.edit'
        ];
    }

    public function getRoute(): array
    {
        return [
            'index' => 'admin.amenity.index',
            'create' => 'admin.amenity.create',
            'edit' => 'admin.amenity.edit',
            'delete' => 'admin.amenity.delete'
        ];
    }

    public function index(AmenityDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách Tiện ích'))
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách tiện ích'),
                route($this->route['index'])
            )->add('Thêm tiện ích')
        ]);
    }

    public function store(AmenityRequest $request)
    {
        $this->data = $request->validated();
        if (Amenity::where('name', '=', $this->data['name'])->exists()) {
            return redirect()->route($this->route['create'])->with('error', 'Tiện ích đã tồn tại');
        }
        DB::beginTransaction();
        try {
            
            Amenity::create($this->data);
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Thêm thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route($this->route['create'])->with('error', 'Thêm thất bại');
        }
    }

    public function edit($id)
    {
        $amenity = Amenity::where('id', $id)
            ->whereHas('parent')
            ->first();
        if (empty($amenity))
            $amenity = Amenity::find($id);
        return view($this->view['edit'], [
            'breadcrumbs' => $this->crums->add(('Danh sách tiện ích'), route($this->route['index']))->add('Sửa tiện ích'),
            'amenity' => $amenity,
        ]);
    }

    public function update(AmenityRequest $request)
    {
        $this->data = $request->validated();
        try {
            DB::beginTransaction();
            $amenity = Amenity::findOrFail($this->data['id']);
            unset($this->data['id']);
            if ($amenity['name'] !== $this->data['name']) {
                if (Amenity::where('name', '=', $this->data['name'])->exists()) {
                    return redirect()->route($this->route['edit'],$this->data['id'])->with('error', 'Tiện ích đã tồn tại');
                }
            }
            $amenity->update($this->data);
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Cập nhập thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route($this->route['edit'],[$this->data['id']])->with('error', 'Cập nhập thất bại');
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $this->data = Amenity::find($id);
            $this->data->delete();
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route($this->route['index'])->with('error', 'Xóa thất bại');
        }
    }
}
