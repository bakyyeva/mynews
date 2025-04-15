<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    public function showPasswordReset()
    {
        return view('auth.reset-password');
    }

    public function showPasswordResetConfirm(Request $request)
    {
        $token = $request->token;

        $tokenExist = DB::table("password_reset_tokens")->where('token', $token)->first();

        if (!$tokenExist)
            abort(404);

        return view('auth.reset-password', compact('token'));
    }

    public function sendPasswordReset(Request $request)
    {
        $email = $request->email;
        $find = User::query()->where('email', $email)->firstOrFail();

        $tokenFind = DB::table("password_reset_tokens")->where('email', $email)->first();

        if ($tokenFind) {
            $token = $tokenFind->token;
        } else {
            $token = Str::random(60);
            DB::table("password_reset_tokens")->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => now()
            ]);
        }

        if ($tokenFind && now()->diffInHours($tokenFind->created_at) < 5) {
            $this->rsAlert('success', 'Başarılı', 'Daha önce doğrulama maili gönderilmiştir.');

            return redirect()->route('login');
        }

        Mail::to($find->email)->send(new ResetPasswordMail($find, $token));
        $this->rsAlert('success', 'Başarılı', 'Parola Sıfırlama Mailiniz gönderilmiştir.');
        return redirect()->route('login');
    }

    public function passwordReset(PasswordResetRequest $request, string $token)
    {
        $tokenQuery = DB::table("password_reset_tokens")->where('token', $token);
        $tokenExist = $tokenQuery->first();

        if (!$tokenExist)
            abort(404);

        //         $userExist = DB::table("password_reset_tokens")->where('email', $tokenExist->email)->first();
        $userExist = User::query()->where('email', $tokenExist->email)->first();

        if (!$userExist)
            abort(400, 'Lütfen yönetici ile iletişime geçin');

        $userExist->update(['password' => Hash::make($request->password)]);

        event(new PasswordChangedEvent($userExist));

        $tokenQuery->delete();

        $this->rsAlert('success', 'Başarılı', 'Parola sıfırlanmıştır. Giriş yapabilirsiniz.');

        return redirect()->route('login');
    }
}
