<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\KuponController;
// use App\Http\Controllers\userprofileco
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// route::middleware('auth')->group(function (){

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
route::resource('category', CategoryController::class);
route::resource('items', ItemsController::class);
route::resource('transaction', TransactionController::class);
Route::resource('kupon', kuponController::class);
route::resource('profile', UserProfileController::class);
route::get('userkupon', [KuponController::class, 'userkupon'])->name('kupon.user');
route::get('history', [TransactionController::class, 'history'])->name('transaction.history');
route::post('transaction/checkout', [TransactionController::class, 'checkout'])->name('transaction.checkout');
// route::get('coba', function () {
//     return view('profile');
// });

    // });