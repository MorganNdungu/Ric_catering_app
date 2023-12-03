<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Auth\ForgotPasswordController;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
{
    $this->validate($request, ['email' => 'required|email']);

    $response = $this->broker()->sendResetLink(
        $request->only('email')
    );

    dd($response); // or use logger()->info($response);
}

    public function showLinkRequestForm()
{
    return view('auth.passwords.email');
}
protected function broker()
{
    return Password::broker('users');
}
}
