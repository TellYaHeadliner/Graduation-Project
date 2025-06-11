<?php

namespace App\Http\Controllers\Admin\User;

use App\DataTables\Admin\User\UserDataTable;
use App\Enums\User\UserGender;
use App\Enums\User\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView(): array
    {
        return [
            'index' => 'admin.user.index',
            'create' => 'admin.user.create',
            'edit' => 'admin.user.edit'
        ];
    }

    public function getRoute(): array
    {
        return [
            'index' => 'admin.user.index',
            'create' => 'admin.user.create',
            'edit' => 'admin.user.edit',
            'delete' => 'admin.user.delete'
        ];
    }

    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách người dùng'))
        ]);
    }

    public function create()
    {
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách người dùng'),
                route($this->route['index'])
            )->add('Thêm người dùng'),
            'gender' => UserGender::asSelectArray(),
            'role' => UserRole::asSelectArray()
        ]);
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view($this->view['edit'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách người dùng'),
                route($this->route['index'])
            )->add('Cập nhập thông tin người dùng'),
            'user' => $user,
            'gender' => UserGender::asSelectArray(),
            'role' => UserRole::asSelectArray()
        ]);
    }

    public function update(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();
            if (isset($this->data['password']) && $this->data['password']) {
                $this->data['password'] = Hash::make($this->data['password']);
            }
            else{
                unset($this->data['password']);
            }

            $this->data['status'] = $this->data['status'] ?? 2;

            $user = User::find($this->data['id']);

            if($user->role->value != $this->data['role']){
                return redirect()->route($this->route['edit'], [$this->data['id']])->with('error', 'Lhông thể thay đổi vai trò chính mình');
            }

            $user->update($this->data);

            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Cập nhập thành công');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route($this->route['edit'], [$this->data['id']])->with('error', 'Cập nhập thất bại');
        }
    }
    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();
            $this->data['password'] = Hash::make($this->data['password']);
            $this->data['status'] = $this->data['status'] ?? 2;
            User::create($this->data);
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
            $this->data = User::find($id);
            $this->data->delete();
            DB::commit();
            return redirect()->route($this->route['index'])->with('success', 'Xóa thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route($this->route['index'])->with('error', 'Xóa thất bại');
        }
    }
}
