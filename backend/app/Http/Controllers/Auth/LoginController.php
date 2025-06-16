<?php

namespace App\Http\Controllers\Auth;

use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

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
        Auth::logout();
        return view($this->view['index']);
    }

    public function login(LoginRequest $request)
    {
        $this->data = $request->validated();

        if (Auth::attempt(['email' => $this->data['email'], 'password' => $this->data['password']])) {
            $request->session()->regenerate();
            if (Auth()->user()->status === UserStatus::Deactivated) {
                return back()->with('error', 'Tài khoản của bạn hiện đang khóa!')->withInput();
            }
            if (Auth()->user()->role === UserRole::Admin) {
                return redirect()->intended(route('admin.dashboard'));
            } else {
                return redirect()->intended(route('hotel.dashboard', ['hotel_id' => Auth()->user()->id]));
            }
        } else {
            return back()->with('error', 'Thông tin đăng nhập không đúng')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login.index');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->with(['prompt' => 'select_account'])->redirectUrl(route('login.google.callback'))->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Kiểm tra xem user đã có trong hệ thống chưa
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Nếu chưa có thì tạo mới user
                $user = User::create([
                    'fullname' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'avatar' => $googleUser->getAvatar(),
                    'provider' => 'google',
                    'provider_id' => $googleUser->getId(),
                    'password' => bcrypt(uniqid()), // Password random
                    'role' => UserRole::Customer, // hoặc giá trị mặc định cho khách hàng
                    'status' => UserStatus::Active
                ]);
            }

            Auth::login($user);
            if (Auth()->user()->role === UserRole::Admin) {
                return redirect()->intended(route('admin.dashboard'));
            } else {
                return redirect()->intended(route('hotel.dashboard', ['hotel_id' => Auth()->user()->id]));
            }
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->route('login.index')->with('error', 'Đăng nhập bằng Google thất bại!');
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->stateless()->user();

            // Kiểm tra user đã tồn tại chưa (dựa trên email)
            $user = User::where('email', $facebookUser->getEmail())->first();

            if (!$user) {
                // Tạo mới user nếu chưa có
                $user = User::create([
                    'fullname' => $facebookUser->getName(),
                    'email' => $facebookUser->getEmail(),
                    'avatar' => $facebookUser->getAvatar(),
                    'provider' => 'facebook',
                    'provider_id' => $facebookUser->getId(),
                    'password' => bcrypt(uniqid()),
                    'role' => UserRole::Customer,
                    'status' => UserStatus::Active
                ]);
            }
            return redirect("http://127.0.0.1:8000/login/social-callback/$user->id");
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->route('login.index')->with('error', 'Đăng nhập bằng Facebook thất bại!');
        }
    }

    public function socialCallback($id)
    {
        $user = User::where('id', $id)->first();
        Auth::login($user);
        if (Auth()->user()->role === UserRole::Admin) {
            return redirect()->intended(route('admin.dashboard'));
        } else {
            return redirect()->intended(route('hotel.dashboard', ['hotel_id' => Auth()->user()->id]));
        }
    }
}
