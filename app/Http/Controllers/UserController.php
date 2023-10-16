<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

class UserController extends Controller
{
    public function editRole(User $user)
{
    // You can use the $user variable to pass the user whose role you want to edit to the view
    return view('users.edit-role', compact('user'));
}
public function updateRole(User $user)
{
    $validatedData = request()->validate([
        'role' => 'required|in:user,admin', // Validate that the role is either 'user' or 'admin'
    ]);

    $user->update(['role' => $validatedData['role']]);

    return redirect()->route('users.edit-role', $user->id)->with('success', 'User role updated successfully.');
}
public function index()
{
    $users = User::all(); // Retrieve all users from the database
    return view('users.index', compact('users'));
}


}
