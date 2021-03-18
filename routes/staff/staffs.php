<?php
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
    Route::get('/staff', [App\Http\Controllers\StaffController::class, 'index'])->name('staff.index');
    Route::get('/staff/create', [App\Http\Controllers\StaffController::class, 'create'])->name('staff.create');
    Route::post('/staff/create', [App\Http\Controllers\StaffController::class, 'store'])->name('staff.store');
    Route::delete('/staff/{staff}', [App\Http\Controllers\StaffController::class, 'destroy'])->name('staff.destroy'); //info This allows staffs to delete posts in the admin area
    Route::get('/staff/{staff}/edit', [App\Http\Controllers\StaffController::class, 'edit'])->name('staff.edit');
    Route::put('/staff/{staff}/update', [App\Http\Controllers\StaffController::class, 'update'])->name('staff.update');
    Route::put('/staff/{staff}/attach', [App\Http\Controllers\StaffController::class, 'attach'])->name('staff.position.attach');
    Route::put('/staff/{staff}/detach', [App\Http\Controllers\StaffController::class, 'detach'])->name('staff.position.detach');

    Route::get('/staff/update/{staff}/updatePL', [App\Http\Controllers\StaffController::class, 'updatePL'])->name('staff.PL');
    Route::get('/staff/{staff}/profile', [App\Http\Controllers\StaffController::class, 'show'])->name('staff.profile');

    Route::get('/hotels/holidays', [App\Http\Controllers\HolidaysController::class, 'holidays'])->name('holiday.index');

    Route::get('/staff/{staff}/holiday/create', [App\Http\Controllers\StaffController::class, 'create'])->name('staffs.createHoliday');
    Route::post('/staff/{staff}/holiday/store', [App\Http\Controllers\StaffController::class, 'storeHoliday'])->name('staffs.storeHoliday');
    Route::delete('/staff/{holiday}/holiday', [App\Http\Controllers\HolidaysController::class, 'destroy'])->name('holidays.destroy'); //info This allows users to delete Holidays in the admin area

    Route::get('/staff/wages', [App\Http\Controllers\StaffController::class, 'wages'])->name('staff.wages');
    Route::put('/staff/{staff}/wages/update', [App\Http\Controllers\StaffController::class, 'wagesup'])->name('staff.wages.update');

});
