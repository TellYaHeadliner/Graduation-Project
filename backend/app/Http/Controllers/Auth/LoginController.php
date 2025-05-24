<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $data;
    public function getView()
    {
        return [
            'index' => 'auth.login',
        ];
    }

    public function index()
    {
        return view($this->view['index']);
    }

    public function login(LoginRequest $request)
    {
        $this->data = $request->validated();

        if (Auth::attempt(['email' => $this->data['email'], 'password' => $this->data['password']])) {
            $request->session()->regenerate(); 
            return redirect()->intended('/'); 
        } else {
            return back()->with('error','Thông tin đăng nhập không đúng')->withInput();
        }      
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login.index');
    }
}
