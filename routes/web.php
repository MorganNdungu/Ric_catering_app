<?php
use App\Models\Item;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CakesController;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SnackController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BirthdayPackageController;
use App\Http\Controllers\ItemController; 

Auth::routes();

Route::get('/', function () {
    $featuredItems = Item::take(3)->get();

    return view('welcome', compact('featuredItems'));
})->name('welcome');

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
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');

// Create - Show the form for creating a new item
Route::get('/items/create', [ItemController::class, 'create']);
Route::post('/items', [ItemController::class, 'store']);

// Update - Show the form for editing an existing item
Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');

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

// Route::get('/users', [UserController::class, 'index'])->name('users.index');
// Route::get('/users/{users}/edit-role', [UserController::class, 'editRole'])->name('users.edit-role');


Auth::routes();

Route::get('/Dashboard', [DashboardController::class, 'Dashboard'])->name('Dashboard');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'], function(){
    Route::view('/dashboard', 'dashboard');
    // Route::view('/items', 'item');
    // Route::view('/users', 'user');
    // Route::view('/services', 'service');
    Route::resource('users',UserController::class);
    Route::get('/users/{user}/edit-role', [UserController::class, 'editRole'])->name('users.edit-role');
    Route::put('/users/{user}/update-role', [UserController::class, 'updateRole'])->name('users.update-role');
    Route::get('/cart', [CartController::class, 'viewcart'])->name('cart.view');





});

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

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
// Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('order.place');

Route::post('/place-order', 'CheckoutController@placeOrder')->name('order.place');

Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout');
Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->name('order.place');
Route::post('/mpesa/confirm', [CheckoutController::class, 'confirmMpesaPIN'])->name('mpesa.confirm');


Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/order-confirmation', [OrderController::class, 'confirmation'])->name('order.confirmation');

Route::resource('cakes', CakesController::class);
Route::get('/cakes', [CakesController::class, 'index'])->name('cakes.index');
Route::post('cakes', [CakesController::class, 'store'])->name('cakes.store');
Route::get('/cakes/create', [CakesController::class, 'create'])->name('cakes.create');
Route::get('/cakes/{cakeId}/order', [CakesController::class, 'order'])->name('cakes.order');
Route::put('/cakes/{cake}', [CakesController::class, 'update'])->name('cakes.update');
Route::get('/cakes/{cake}/confirm-delete', [CakesController::class, 'confirmDelete'])->name('cakes.confirm-delete');
Route::delete('/cakes/{cake}', [CakesController::class, 'destroy'])->name('cakes.destroy');


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



Route::get('/mpesa/stk/{transaction_id}', [CheckoutController::class, 'mpesaPin'])->name('mpesa.stk');
Route::get('/pay',[MpesaController::class, 'stk']);