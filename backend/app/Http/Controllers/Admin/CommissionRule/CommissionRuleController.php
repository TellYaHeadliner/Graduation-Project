<?php

namespace App\Http\Controllers\Admin\CommissionRule;

use App\DataTables\Admin\CommissionRule\CommissionRuleDataTable;
use App\Enums\CommissionRule\CommissionRuleStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CommissionRule\CommissionRuleRequest;
use App\Models\CommissionRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommissionRuleController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView(): array
    {
        return [
            'index' => 'admin.commission_rules.index',
            'create' => 'admin.commission_rules.create',
            'edit' => 'admin.commission_rules.edit'
        ];
    }

    public function getRoute(): array
    {
        return [
            'index' => 'admin.commission_rule.index',
            'create' => 'admin.commission_rule.create',
            'edit' => 'admin.commission_rule.edit',
            'delete' => 'admin.commission_rule.delete'
        ];
    }

    public function index(CommissionRuleDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách Quy tắc hoa hồng'))
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách Quy tắc hoa hồng'),
                route($this->route['index'])
            )->add('Thêm Quy tắc mới')
        ]);
    }

    public function store(CommissionRuleRequest $request)
    {
        $this->data = $request->validated();
        DB::beginTransaction();
        try {
            $this->data['is_active'] = $this->data['is_active'] ?? CommissionRuleStatus::Inactive->value;

            if (CommissionRule::where([
                ['min_amount', $this->data['min_amount']],
                ['max_amount', $this->data['max_amount']],
            ])->exists()) {
                return redirect()->route($this->route['create'])->with('error', 'Đã tồn tại quy tắc cho khoảng tiền này!');
            }

            CommissionRule::create($this->data);
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Thêm thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route($this->route['create'])->with('error', 'Thêm thất bại');
        }
    }

    public function edit($id)
    {
        $commission_rule = CommissionRule::find($id);
        return view($this->view['edit'], [
            'breadcrumbs' => $this->crums->add(('Danh sách loại giường'), route($this->route['index']))->add('Sửa Loại giường'),
            'commission_rule' => $commission_rule,
        ]);
    }

    public function update(CommissionRuleRequest $request)
    {
        $this->data = $request->validated();
        DB::beginTransaction();
        try {
            $this->data['is_active'] = $this->data['is_active'] ?? CommissionRuleStatus::Inactive->value;

            $commissionRule = CommissionRule::findOrFail($this->data['id']);
            if ($commissionRule->min_amount != $this->data['min_amount'] || $commissionRule->max_amount != $this->data['max_amount']) {
                if (CommissionRule::where([
                    ['min_amount', $this->data['min_amount']],
                    ['max_amount', $this->data['max_amount']],
                ])->exists()) {
                    return redirect()->route($this->route['edit'], $this->data['id'])->with('error', 'Đã tồn tại quy tắc cho khoảng tiền này!');
                }
            }
            $commissionRule->update($this->data);
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Cập nhập thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route($this->route['edit'], $this->data['id'])->with('error', 'Cập nhập thất bại');
        }
    }
    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $this->data = CommissionRule::find($id);
            $this->data->delete();
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route($this->route['index'])->with('error', 'Xóa thất bại');
        }
    }
}
