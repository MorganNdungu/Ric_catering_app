<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductsController;
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

Route::post('/addToCart/{item}', [CartController::class, 'addToCart'])->name('addToCart');


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

Route::group(['middleware'=>'auth'], function(){
    Route::view('/dashboard', 'dashboard');
    // Route::view('/items', 'item');
    Route::view('/users', 'user');
    // Route::view('/services', 'service');


});
// Add items to the cart
Route::post('/cart/add/{item}', [CartController::class, 'addItemToCart'])->name('cart.add');

// View the cart
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');

// Update cart item quantity
Route::put('/cart/update/{cartItem}', [CartController::class, 'updateCartItem'])->name('cart.update');

// Remove items from the cart
Route::delete('/cart/remove/{cartItem}', [CartController::class, 'removeCartItem'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

// Checkout and place an order
Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('order.place');

Route::post('/place-order', 'CheckoutController@placeOrder')->name('order.place');

Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout');
Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->name('order.place');


Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/order-confirmation', [OrderController::class, 'confirmation'])->name('order.confirmation');
