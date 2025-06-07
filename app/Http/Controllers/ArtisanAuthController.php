<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Artisan;

class ArtisanAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('artisan.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('artisan')->attempt($credentials, $request->filled('remember'))) {
            $artisan = Auth::guard('artisan')->user();
            
            if (!$artisan->hasVerifiedEmail()) {
                Auth::guard('artisan')->logout();
                return redirect()->route('artisan.verification.notice')
                    ->with('email', $artisan->email)
                    ->withErrors(['email' => 'メールアドレスの確認が必要です。']);
            }
            
            $request->session()->regenerate();
            return redirect()->intended('/artisan_dashboard');
        }

        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('artisan')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/artisan/login');
    }

    public function showRegistrationForm()
    {
        return view('artisan.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_no' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:artisans',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $artisan = Artisan::create([
            'name' => $request->name,
            'phone_no' => $request->phone_no,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $artisan->generateEmailVerificationToken();
        $artisan->notify(new \App\Notifications\ArtisanEmailVerification($token));

        return redirect()->route('artisan.verification.notice')
            ->with('email', $artisan->email);
    }

    public function showResetForm()
    {
        return view('artisan.auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('artisans')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => 'パスワードリセットリンクをメールで送信しました。'])
                    : back()->withErrors(['email' => 'メールアドレスが見つかりません。']);
    }

    public function showResetPasswordForm($token)
    {
        return view('artisan.auth.passwords.reset', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::broker('artisans')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (Artisan $artisan, string $password) {
                $artisan->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $artisan->save();
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('artisan.login')->with('status', 'パスワードがリセットされました。')
                    : back()->withErrors(['email' => 'パスワードリセットに失敗しました。']);
    }

    public function dashboard()
    {
        return view('artisan.dashboard');
    }
}
