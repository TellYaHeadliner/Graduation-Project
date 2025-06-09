<?php

namespace App\Http\Controllers\Admin\Notification;

use App\DataTables\Admin\Notification\NotificationDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notification\NotificationRequest;
use App\Models\Notification;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView(): array
    {
        return [
            'index' => 'admin.notification.index',
            'create' => 'admin.notification.create',
            'edit' => 'admin.notification.edit'
        ];
    }

    public function getRoute(): array
    {
        return [
            'index' => 'admin.notification.index',
            'create' => 'admin.notification.create',
            'edit' => 'admin.notification.edit',
            'delete' => 'admin.notification.delete'
        ];
    }

    public function index(NotificationDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách thông báo'))
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách thông báo'),
                route($this->route['index'])
            )->add('Thêm thông báo'),
        ]);
    }
    public function edit($id)
    {
        $notification = Notification::find($id);
        return view($this->view['edit'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách thông báo'),
                route($this->route['index'])
            )->add('Cập nhập thông báo'),
            'notification' => $notification,
        ]);
    }
    public function update(NotificationRequest $request)
    {
        $this->data = $request->validated();
        try {
            DB::beginTransaction();
            $notification = Notification::findOrFail($this->data['id']);
            unset($this->data['id']);
            $notification->update($this->data);
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Cập nhập thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route($this->route['edit'], $this->data['id'])->with('error', 'Cập nhập thất bại');
        }
    }
    public function store(NotificationRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();
            $pivotData = [];
            $this->data['sent_at'] = date('y-m-d');

            if (!isset($this->data['user_id'])) {
                $users =  User::All();
                foreach ($users as $item) {
                    $pivotData[$item['id']] = [
                        'is_read' => false,
                        'read_at' => null
                    ];
                };
            } else {
                $users = $this->data['user_id'];
                foreach ($users as $id) {
                    $pivotData[$id] = [
                        'is_read' => false,
                        'read_at' => null
                    ];
                };
                unset($this->data['user_id']);
            }

            $notification = Notification::create($this->data);
            $notification->users()->attach($pivotData);

            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Thêm thành công');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->route($this->route['create'])->with('error', 'Thêm thất bại');
        }
    }

    public function delete($id, $user_id = null)
    {
        try {
            DB::beginTransaction();
            $this->data = Notification::find($id);
            if (!$user_id) {
                $this->data->users()->detach();
                $this->data->delete();
            } else {
                $this->data->users()->detach($user_id);
            }
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Xóa thành công');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route($this->route['index'])->with('error', 'Xóa thất bại');
        }
    }
}
