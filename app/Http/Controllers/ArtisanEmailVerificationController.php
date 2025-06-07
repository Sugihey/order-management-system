<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artisan;

class ArtisanEmailVerificationController extends Controller
{
    public function notice()
    {
        return view('artisan.auth.verify-email');
    }

    public function verify(Request $request, $token)
    {
        $artisan = Artisan::where('email_verification_token', $token)->first();

        if (!$artisan) {
            return redirect()->route('artisan.login')
                ->withErrors(['email' => '無効な認証リンクです。']);
        }

        if ($artisan->hasVerifiedEmail()) {
            return redirect()->route('artisan.login')
                ->with('status', 'メールアドレスは既に確認済みです。');
        }

        $artisan->markEmailAsVerified();

        return redirect()->route('artisan.login')
            ->with('status', 'メールアドレスが確認されました。ログインしてください。');
    }

    public function resend(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $artisan = Artisan::where('email', $request->email)->first();

        if (!$artisan) {
            return back()->withErrors(['email' => 'メールアドレスが見つかりません。']);
        }

        if ($artisan->hasVerifiedEmail()) {
            return back()->with('status', 'メールアドレスは既に確認済みです。');
        }

        $token = $artisan->generateEmailVerificationToken();
        $artisan->notify(new \App\Notifications\ArtisanEmailVerification($token));

        return back()->with('status', '確認メールを再送信しました。');
    }
}
