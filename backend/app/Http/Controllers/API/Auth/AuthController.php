<?php

namespace App\Http\Controllers\API\Auth;

use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserApiRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Notifications\VerifyUserEmail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    private $data;
    public function login(LoginRequest $request)
    {
        $this->data = $request->validated();

        $user = User::where('email', $this->data['email'])->first();

        if (!$user) {
            return response()->json([
                'message' => 'Tài khoản không tồn tại.',
                'data' => []
            ], 404);
        }

        if (!Hash::check($this->data['password'], $user->password)) {
            return response()->json([
                'message' => 'Sai mật khẩu.',
                'data' => []
            ], 400);
        }

        if (!$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
            return response()->json([
                'message' => 'Vui lòng kiểm tra email để kích hoạt tài khoản.',
                'redirect' => '/please-check-email',
            ], 400);
        }

        $payLoad = [
            'sub' => $user->id,
            'iat' => time(),
            // 'exp' => time() + 60 * 60 * 24 * 7,
        ];

        $token = JWT::encode($payLoad, env('JWT_SECRET'), 'HS256');
        return response()->json([
            'message' => 'Đăng nhập thành công',
        ])->withCookie(
            cookie(
                'access_token',
                $token,
                60 * 24 * 7,
                '/',
                null,
                false,
                true,
                false,
                'lax'
            )
        );
    }

    public function logout()
    {
        return response()->json([
            'message' => 'Đăng xuất thành công'
        ])->withCookie(
            cookie()->forget('access_token')
        );
    }

    public function register(UserApiRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->data = $request->validated();
            $this->data['password'] = Hash::make($this->data['password']);
            $this->data['status'] = UserStatus::Active->value;
            $this->data['role'] = UserRole::Customer->value;

            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');

                $fileName = time() . '_' . $file->getClientOriginalName();
                $this->data['avatar'] = '/assets/images/' . $fileName;

                $file->move(public_path('assets/images'), $fileName);
            }

            $user = User::create($this->data);

            $user->sendEmailVerificationNotification();

            DB::commit();
            return response()->json([
                'message' => 'Đăng ký thành công. Vui lòng kiểm tra email để xác minh tài khoản.',
                'redirect' => '/please-check-email',
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Đăng ký thất bại.',
                'data' => [],
            ], 500);
        }
    }

    public function resend_email(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (! $user || $user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email không hợp lệ hoặc đã xác minh.'], 400);
        }
        $user->sendEmailVerificationNotification();
        return response()->json(['message' => 'Đã gửi lại email xác minh.'], 200);
    }


    public function redirectToGoogle()
    {
        $url = Socialite::driver('google')->stateless()
            ->with(['prompt' => 'select_account'])
            ->redirectUrl(route('api.v1.auth.google.callback'))->redirect()->getTargetUrl();
        return response()->json([
            'message' => 'url chuyển hướng sang google',
            'data' => [
                'url' => $url
            ]
        ]);
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()
                ->redirectUrl(route('api.v1.auth.google.callback'))
                ->user();

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
            $payLoad = [
                'sub' => $user->id,
                'iat' => time(),
                'exp' => time() + 60 * 60 * 24 * 7,
            ];

            $token = JWT::encode($payLoad, env('JWT_SECRET'), 'HS256');
            return response()->json([
                'message' => 'Đăng nhập thành công',
            ])->withCookie(
                cookie(
                    'access_token',
                    $token,
                    60 * 24 * 7,
                    '/',
                    null,
                    false,
                    true,
                    false,
                    'lax'
                )
            );
        } catch (Exception $e) {
            Log::error($e);
            return response()->json([
                'message' => 'Đăng nhập với google thất bại.',
            ], 500);
        }
    }

    public function redirectToFacebook()
    {
        $url = Socialite::driver('facebook')->stateless()
            ->redirectUrl(env('NGROK_URL') . '/api/v1/auth/facebook/callback')->redirect()->getTargetUrl();
        return response()->json([
            'message' => 'url chuyển hướng sang facebook',
            'data' => [
                'url' => $url
            ]
        ]);
    }

    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->stateless()
                ->redirectUrl(env('NGROK_URL') . '/api/v1/auth/facebook/callback')
                ->user();

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
            return redirect("http://127.0.0.1:8000/api/v1/auth/social-callback/$user->id/true");
        } catch (\Exception $e) {
            Log::error($e);
            return redirect("http://127.0.0.1:8000/api/v1/auth/social-callback/$user->id/false");
        }
    }

    public function socialCallback($id, $status)
    {
        if (!$status) {
            return response()->json([
                'message' => 'Đăng nhập với facebook thất bại.'
            ], 500);
        }
        $payLoad = [
            'sub' => $id,
            'iat' => time(),
            'exp' => time() + 60 * 60 * 24 * 7,
        ];

        $token = JWT::encode($payLoad, env('JWT_SECRET'), 'HS256');
        return response()->json([
            'message' => 'Đăng nhập thành công',
        ])->withCookie(
            cookie(
                'access_token',
                $token,
                60 * 24 * 7,
                '/',
                null,
                false,
                true,
                false,
                'lax'
            )
        );
    }
}
