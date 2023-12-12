<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\UserController;

class UserController extends Controller
{
    public function editRole(User $user)
{
    return view('users.edit-role', compact('user'));
}

public function updateRole(User $user)
{
    try {
        $validatedData = request()->validate([
            'role' => 'required|in:user,admin',
        ]);

        $user->update(['role' => $validatedData['role']]);

        return redirect()->route('users.index')->with('success', 'User role updated successfully.');
    } catch (ValidationException $e) {
        return redirect()->route('users.edit-role', $user->id)->withErrors($e->errors())->withInput();
    }
}

public function index()
{
    $users = User::all(); 
    return view('users.index', compact('users'));
}


}
