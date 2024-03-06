<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StripePaymentController;


// Customer Routes
Route::get('/',[MainController::class,'index']);
Route::get('/cart',[MainController::class,'cart']);
Route::get('/checkout',[MainController::class,'checkout']);
Route::get('/shop',[MainController::class,'shop']);
Route::get('/single/{id}',[MainController::class,'singleProduct']);
Route::get('/register',[MainController::class,'register']);
Route::post('/registerUser',[MainController::class,'registerUser']);
Route::get('/login',[MainController::class,'login']);
Route::post('/loginUser',[MainController::class,'loginUser']);
Route::get('/logout',[MainController::class,'logout']);
Route::post('/addToCart',[MainController::class,'addToCart']);
Route::post('/updateCart',[MainController::class,'updateCart']);
Route::get('/deleteCartItem/{id}',[MainController::class,'deleteCartItem']);
Route::get('/profile',[MainController::class,'profile']);
Route::post('/updateUser',[MainController::class,'updateUser']);
Route::get('/myOrders',[MainController::class,'myOrders']);

// Admin Routes
Route::get('/admin/dashboard',[AdminController::class,'index']);
Route::get('/adminproduct',[AdminController::class,'products']);
Route::post('/addNewProduct',[AdminController::class,'addNewProduct']);
Route::post('/updateProduct',[AdminController::class,'updateProduct']);
Route::get('/deleteproduct/{id}',[AdminController::class,'deleteproduct']);
Route::get('/adminProfile',[AdminController::class,'adminProfile']);
Route::get('/ourCustomer',[AdminController::class,'ourCustomer']);
Route::get('/changeUserStatus/{status}/{id}',[AdminController::class,'changeUserStatus']);
Route::get('/ourOrders',[AdminController::class,'orders']);
Route::get('/changeOrderStatus/{status}/{id}',[AdminController::class,'changeOrderStatus']);

// mail
Route::get('/send-mail',[MailController::class,'testingmail']);


// google login
Route::get('/googleLogin',[MainController::class,'googleLogin']);


Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});
