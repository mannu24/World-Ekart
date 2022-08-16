<?php

namespace App\Http\Controllers ;
use Illuminate\Support\Facades\Route;
use Auth ;

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


Route::get('/become-a-vendor', [HomeController::class, 'become_a_vendor'])->name('become-a-vendor');
Route::get('/track-order', [HomeController::class, 'order_tracking'])->name('track-order');
