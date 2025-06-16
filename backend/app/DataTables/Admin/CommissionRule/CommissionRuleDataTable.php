<?php

namespace App\DataTables\Admin\CommissionRule;

use App\DataTables\BaseDataTable;
use App\Enums\CommissionRule\CommissionRuleStatus;
use App\Traits\GetConfig;
use App\Models\CommissionRule;

class CommissionRuleDataTable extends BaseDataTable
{

    use GetConfig;
    protected $nameTable = 'commissionRuleTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct()
    {
        parent::__construct();

        $this->repository = CommissionRule::class;
    }

    public function setView(): void
    {
        $this->view = [
            'min_amount' => 'admin.commission_rules.datatable.min_amount',
            'max_amount' => 'admin.commission_rules.datatable.max_amount',
            'commission_percent' => 'admin.commission_rules.datatable.commission_percent',
            'note' => 'admin.commission_rules.datatable.note',
            'is_active' => 'admin.commission_rules.datatable.is_active',
            'action' => 'admin.commission_rules.datatable.action',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2, 3 ,4];

        $this->columnSearchSelect = [
            [
                'column' => 4,
                'data' => CommissionRuleStatus::asSelectArray(),
            ]
        ];
    }

    public function query()
    {
        return $this->repository::orderBy('commission_percent', 'desc');
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.commission_rules', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'min_amount' => $this->view['min_amount'],
            'max_amount' => $this->view['max_amount'],
            'note' => $this->view['note'],
            'commission_percent' => $this->view['commission_percent'],
            'is_active' => $this->view['is_active'],
        ];
    }

    protected function setCustomAddColumns(): void
    {
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }

    protected function setCustomRawColumns(): void
    {
        $this->customRawColumns = ['min_amount', 'max_amount', 'commission_percent', 'note', 'is_active', 'action'];
    }

    public function setCustomFilterColumns(): void {}
}
