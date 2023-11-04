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
    
        // Display a success or error message to the user based on $response.
        // For example, you can check $response for PasswordBroker constants like Password::RESET_LINK_SENT and Password::INVALID_USER.
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
