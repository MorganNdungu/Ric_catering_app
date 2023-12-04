<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ProfileController;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('profile.show');
        // You can create a Blade view file at resources/views/profile/show.blade.php
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The provided current password is incorrect.'])->withInput();
        }

        $user->update([
            'password' => Hash::make($request->input('new_password')),
        ]);

        return redirect()->route('profile.show')->with('success', 'Password changed successfully!');
    }


public function showChangePasswordForm()
{
    return view('profile.change-password');
}


    

    /**
     * Update the user's profile details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // Add other validation rules for profile details
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update profile details
        auth()->user()->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            // Add other profile details
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {
            $profilePic = $request->file('profile_pic');
            $fileName = time() . '.' . $profilePic->getClientOriginalExtension();
            $profilePic->storeAs('profile_pics', $fileName, 'public');
            
            auth()->user()->update(['profile_pic' => $fileName]);
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
        // You can create a Blade view file at resources/views/profile/show.blade.php to display the updated profile
    }
    public function showChangeEmailForm()
    {
        return view('profile.change-email');
    }

    public function changeEmail(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'required|string',
        ]);

        if (!Hash::check($request->input('password'), $user->password)) {
            return redirect()->back()->withErrors(['password' => 'The provided password is incorrect.'])->withInput();
        }

        $user->update(['email' => $request->input('email')]);

        return redirect()->route('profile.show')->with('success', 'Email changed successfully!');
    }
}
