<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserApiRequest;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class UserController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function userInfo(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        return response()->json([
            'message' => 'Thông tin người dùng đang đăng nhập.',
            'data' => [
                'user' => $user
            ]
        ]);
    }

    public function update(UserApiRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            $user = User::find($request->user_id);

            if(isset($data['password_new']) && !empty($data['password_new'])){
                $data['password'] = Hash::make($data['password_new']);
            }
            unset($data['password_new']);

            $user->update($data);
            DB::commit();
            return response()->json([
                'message' => 'Cập nhập thành công.',
                'data' => [],
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Cập nhập thất bại.',
                'data' => [],
            ], 500);
        }
    }
    public function forgot_password(Request $request)
    {
        DB::beginTransaction();
        try {
            
            $user = User::where('email',$request->email)->first();

            if(!$user){
                return response()->json([
                'message' => 'Không tìm thấy tài khoản này.',
                'data' => [],
            ], 500);
            }

           // $password_new = Str::random(8);
            $password_new = '123456';

            $user->update([
                'password' => Hash::make($password_new),
            ]);

            Mail::to($user->email)->send(new ForgotPasswordMail($password_new,$user));

            DB::commit();
            return response()->json([
                'message' => 'Gửi mật khẩu mới qua email thành công.',
                'data' => [],
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Cập nhập thất bại.',
                'data' => [],
            ], 500);
        }
    }
}
