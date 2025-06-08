<?php

namespace App\Http\Controllers\Admin\Season;

use App\DataTables\Admin\Season\SeasonDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Season\SeasonRequest;
use App\Models\Season;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeasonController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView()
    {
        return [
            'index' => 'admin.season.index',
            'create' => 'admin.season.create',
            'edit' => 'admin.season.edit'
        ];
    }
    public function getRoute(): array
    {
        return [
            'index' => 'admin.season.index',
            'create' => 'admin.season.create',
            'edit' => 'admin.season.edit',
            'delete' => 'admin.season.delete'
        ];
    }
    public function index(SeasonDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách mùa ưu đãi'))
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách mùa ưu đãi'),
                route($this->route['index'])
            )->add('Thêm mùa ưu đãi')
        ]);
    }

    public function edit($id)
    {
        $season = Season::find($id);
        return view($this->view['edit'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách mùa ưu đãi'),
                route($this->route['index'])
            )->add('Cập nhập mùa ưu đãi'),
            'season' => $season
        ]);
    }

    public function store(SeasonRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();
            $this->data['status'] = $this->data['status'] ?? 0;
            Season::create($this->data);
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Thêm thành công');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route($this->route['create'])->with('error', 'Thêm thất bại');
        }
    }

    public function update(SeasonRequest $request)
    {
        
        DB::beginTransaction();
        try {
            $this->data = $request->validated();
            $this->data['status'] = $this->data['status'] ?? 0;
            $season = Season::find($this->data['id']);
            if($season->end_date < date('Y-m-d')){
                $this->data['status'] = 0;
                $season->update($this->data);
                DB::commit();
                return redirect()->route($this->route['edit'],[$this->data['id']])->with('error', 'Mùa ưu đãi đã hết hạn không thể kích hoạt. Vui lòng cài đặt thời gian lại!');
            }
            $season->update($this->data);
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Cập nhập thành công');
        } catch (Exception $e) {
            DB::rollback();
             return redirect()->route($this->route['edit'],[$this->data['id']])->with('error', 'Cập nhập thất bại');
        }
    }
}
