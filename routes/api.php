<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('product', [ProductController::class, 'getAProduct']);
Route::post('set-price', [ProductController::class, 'setProductPrice']);
//Route::prefix('mail/')->group(function() {
//    Route::post('welcome', \App\Http\Controllers\MailController::class, 'sendWelcomeEmail');
//});
