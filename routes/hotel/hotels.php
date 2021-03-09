<?php

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

Auth::routes();
Route::middleware('auth')->group(function(){
    Route::get('/hotels/{hotel}/staff',[App\Http\Controllers\HotelController::class, 'staff'])->name('hotel.staff.index');
    Route::get('/hotels/endofday', [App\Http\Controllers\DailySalesController::class, 'create'])->name('endofday.create');
    Route::post('/hotels/endofday/save', [App\Http\Controllers\DailySalesController::class, 'store'])->name('endofday.store');
    Route::put('/hotels/endofday/update', [App\Http\Controllers\DailySalesController::class, 'update'])->name('endofday.update');
    Route::get('/hotels/endofday/{id}/edit', [App\Http\Controllers\DailySalesController::class, 'edit'])->name('endofday.edit');

});


Route::middleware('owner')->group(function(){
Route::get('/hotels/', [App\Http\Controllers\HotelController::class, 'index'])->name('hotel.index');
Route::post('/hotels', [App\Http\Controllers\HotelController::class, 'store'])->name('hotel.store');
Route::delete('/hotels/{hotel}', [App\Http\Controllers\HotelController::class, 'destroy'])->name('hotel.destroy'); //info This allows hotels to delete hotels in the admin area
Route::get('/hotels/{hotel}/edit', [App\Http\Controllers\HotelController::class, 'edit'])->name('hotel.edit');
Route::put('/hotels/{hotel}/update', [App\Http\Controllers\HotelController::class, 'update'])->name('hotel.update');

Route::get('/hotels/{hotel}/occreport', [App\Http\Controllers\DailySalesController::class, 'occreport'])->name('hotel.occupancy');

Route::get('/hotels/{hotel}/dailysales', [App\Http\Controllers\DailySalesController::class, 'dailysales'])->name('hotel.dailysales.index');
Route::get('/hotels/{hotel}/prevsales', [App\Http\Controllers\DailySalesController::class, 'prevsales'])->name('hotel.prevsales.index');
Route::get('/hotels/{hotel}/weeklysales', [App\Http\Controllers\DailySalesController::class, 'weeklysales'])->name('hotel.prevsales.weekly');



});

Route::middleware('admin')->group(function() {
    Route::get('/hotels/trashed', [App\Http\Controllers\HotelController::class, 'trashedIndex'])->name('trashed.hotel.index');
    Route::get('/hotels/restore/{hotel}', [App\Http\Controllers\HotelController::class, 'restoreHotel'])->name('hotel.restore'); //info This allows users to restore Hotels in the admin area
    Route::get('/hotels/trashed/{hotel}', [App\Http\Controllers\HotelController::class, 'eraseHotel'])->name('hotel.erase'); //info This allows users to erase Hotels in the admin area
});
