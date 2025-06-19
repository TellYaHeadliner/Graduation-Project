<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function userInfo(Request $request){
        $user = User::where('id',$request->user_id)->first();
        return response()->json([
            'message' => 'Thông tin người dùng đang đăng nhập.',
            'data' => [
                'user' => $user
            ]
        ]);
    }
}
