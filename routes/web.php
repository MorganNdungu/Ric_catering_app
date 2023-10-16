<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController; // Correct class name

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/services', function () {
    return view('services');
});

// Read - Display the list of items
Route::get('/items', [ItemController::class, 'index']);

// Create - Show the form for creating a new item
Route::get('/items/create', [ItemController::class, 'create']);
Route::post('/items', [ItemController::class, 'store']);

// Update - Show the form for editing an existing item
Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
Route::put('/items/{item}', [ItemController::class, 'update']);

// Delete - Delete an item
Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Register route
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/logout', [Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/users/{user}/edit-role', [UserController::class, 'editRole'])->name('users.edit-role');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
