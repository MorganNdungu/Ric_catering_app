<?php

use App\Models\Item;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CakesController;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SnackController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BirthdayPackageController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController; 

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

// Forgot Password Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Password Reset Routes
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset']);

Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');
Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
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

Auth::routes();

Route::get('/Dashboard', [DashboardController::class, 'Dashboard'])->name('Dashboard');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    
    Route::view('/dashboard', 'dashboard');
    Route::resource('users', UserController::class);
    Route::get('/users/{user}/edit-role', [UserController::class, 'editRole'])->name('users.edit-role');
    Route::put('/users/{user}/update-role', [UserController::class, 'updateRole'])->name('users.update-role');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/cart', [CartController::class, 'viewcart'])->name('cart.view');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('profile.change-password.form');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    
    Route::get('/profile/change-email', [ProfileController::class, 'showChangeEmailForm'])->name('profile.change-email.form');
    Route::post('/profile/change-email', [ProfileController::class, 'changeEmail'])->name('profile.change-email');
    Route::post('/profile/update-phone', [ProfileController::class, 'updatePhone'])->name('profile.update-phone');
    Route::get('/profile/edit-phone', [ProfileController::class, 'editPhoneForm'])->name('profile.edit-phone.form');
    

    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/birthday-packages/{packageId}/book', [BookingController::class, 'store'])->name('birthday_packages.book');
    Route::get('/booking-confirmation', [BookingController::class, 'showConfirmation'])->name('bookings.confirmation');
    Route::post('/book-venue', [BookingController::class, 'bookVenue'])->name('book-venue');


    Route::get('/profile/orders', [ProfileController::class, 'showOrders'])->name('profile.orders');

});

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset']);

Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/add/{item}', [CartController::class, 'addItemToCart'])->name('cart.add');
Route::put('/cart/update/{cartItem}', [CartController::class, 'updateCartItem'])->name('cart.update');
Route::delete('/cart/remove/{cartItem}', [CartController::class, 'removeCartItem'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->name('order.place');

Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout');
Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->name('order.place');
Route::post('/mpesa/confirm', [CheckoutController::class, 'confirmMpesaPIN'])->name('mpesa.confirm');

Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/order-confirmation', [OrderController::class, 'confirmation'])->name('order.confirmation');

Route::resource('cakes', CakesController::class);
Route::get('/cakes/{cake}/confirm-delete', [CakesController::class, 'confirmDelete'])->name('cakes.confirm-delete');

Route::get('/snacks', [SnackController::class, 'index'])->name('snacks.index');
Route::get('/snacks/create', [SnackController::class, 'create'])->name('snacks.create');
Route::post('/snacks', [SnackController::class, 'store'])->name('snacks.store');
Route::get('/snacks/{snack}', [SnackController::class, 'show'])->name('snacks.show');
Route::get('/snacks/{snack}/edit', [SnackController::class, 'edit'])->name('snacks.edit');
Route::put('/snacks/{snack}', [SnackController::class, 'update'])->name('snacks.update');
Route::delete('/snacks/{snack}/soft-delete', [SnackController::class, 'softDelete'])->name('snacks.soft-delete');
Route::delete('/snacks/{snack}', [SnackController::class, 'destroy'])->name('snacks.destroy');
Route::get('/snacks/{snack}/order', [SnackController::class, 'order'])->name('snacks.order');

Route::get('/birthday_packages', [BirthdayPackageController::class, 'index'])->name('birthday_packages.index');
Route::get('/birthday_packages/create', [BirthdayPackageController::class, 'create'])->name('birthday_packages.create');
Route::post('/birthday_packages', [BirthdayPackageController::class, 'store'])->name('birthday_packages.store');
Route::get('/birthday_packages/{birthday_package}', [BirthdayPackageController::class, 'show'])->name('birthday_packages.show');
Route::get('/birthday_packages/{birthday_package}/edit', [BirthdayPackageController::class, 'edit'])->name('birthday_packages.edit')->where('birthday_package', '[0-9]+');
Route::put('/birthday_packages/{birthday_package}', [BirthdayPackageController::class, 'update'])->name('birthday_packages.update');
Route::delete('/birthday_packages/{birthday_package}', [BirthdayPackageController::class, 'destroy'])->name('birthday_packages.destroy');
Route::delete('/birthday_packages/{birthday_package}/soft-delete', [BirthdayPackageController::class, 'softDelete'])->name('birthday_packages.soft-delete');
Route::get('/birthday-packages/add-book/{id}', [BirthdayPackageController::class, 'addBook'])->name('birthday_packages.add-book');
Route::get('birthday-packages/{id}/book', [BirthdayPackageController::class, 'showBookingForm'])->name('birthday_packages.show_booking_form');

Route::get('/mpesa/stk/{transaction_id}', [CheckoutController::class, 'mpesaPin'])->name('mpesa.stk');
Route::post('/get-token', [MpesaController::class, 'getAccessToken']);
