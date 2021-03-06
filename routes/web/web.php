<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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


Route::get('/audit', [App\Http\Controllers\AuditController::class, 'index'])->name('audit.index')->middleware('owner');

Auth::routes();
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('goodbye');

// Returns the Frontend (at present my CV)
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Returns the Backend
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');


//Setup the User Roles and set the first user as admin
Route::get('/setup', function () {
    $user = User::find(1);
    $admin = App\Models\Role::create(['name' => 'Super', 'slug' => 'super']);
    $user->roles()->attach($admin);
    $admin = App\Models\Role::create(['name' => 'Admin', 'slug' => 'admin']);
    $admin = App\Models\Role::create(['name' => 'Owner', 'slug' => 'owner']);
    $admin = App\Models\Role::create(['name' => 'Shard', 'slug' => 'shard']);
    $admin = App\Models\Role::create(['name' => 'The Mill', 'slug' => 'the-mill']);
    $position = App\Models\Position::create(['name' => 'General Manager', 'slug' => 'general-manager', 'icon' => '<i class="fas fa-chess-king"></i>']);
    $position = App\Models\Position::create(['name' => 'Assistant Manager', 'slug' => 'assistant-manager', 'icon' => '<i class="fas fa-chess-queen"></i>']);
    $position = App\Models\Position::create(['name' => 'Restaurant Manager', 'slug' => 'restaurant-manager', 'icon' => '<i class="fas fa-chess-rook"></i>']);
    $position = App\Models\Position::create(['name' => 'Head Housekeeper', 'slug' => 'head-housekeeper', 'icon' => '<i class="fas fa-chess-bishop"></i>']);
    $position = App\Models\Position::create(['name' => 'Front of House', 'slug' => 'front-of-house', 'icon' => '<i class="fas fa-running"></i>']);
    $position = App\Models\Position::create(['name' => 'Housekeeper', 'slug' => 'housekeeper', 'icon' => '<i class="fas fa-chess-pawn"></i>']);
    $position = App\Models\Position::create(['name' => 'Stock Taker', 'slug' => 'stock-taker', 'icon' => '<i class="fas fa-user-edit"></i>']);
    $position = App\Models\Position::create(['name' => 'Supervisor', 'slug' => 'supervisor', 'icon' => '<i class="fas fa-chess-knight"></i>']);
    $position = App\Models\Position::create(['name' => 'Chef', 'slug' => 'chef', 'icon' => '<i class="fas fa-utensils"></i>']);
    $position = App\Models\Position::create(['name' => 'Pot Wash', 'slug' => 'pot-wash', 'icon' => '<i class="fas fa-tint"></i>']);
    $placement = App\Models\Placement::create(['name' => 'Off', 'slug' => 'off', 'short' => 'OFF', 'colour' => 'White']);
    $placement = App\Models\Placement::create(['name' => 'Holiday', 'slug' => 'holiday', 'short' => 'HOL', 'colour' => 'White']);
    $placement = App\Models\Placement::create(['name' => 'Sick', 'slug' => 'sick', 'short' => 'SIC', 'colour' => 'White']);
    $placement = App\Models\Placement::create(['name' => 'Reception', 'slug' => 'reception', 'short' => 'REC', 'colour' => 'Yellow']);
    $placement = App\Models\Placement::create(['name' => 'Front Of House', 'slug' => 'front-of-house', 'short' => 'FOH', 'colour' => 'Cyan']);
    $placement = App\Models\Placement::create(['name' => 'Housekeeping', 'slug' => 'housekeeping', 'short' => 'HK', 'colour' => 'Green']);
    $placement = App\Models\Placement::create(['name' => 'Kitchen', 'slug' => 'kitchen', 'short' => 'KIT', 'colour' => 'Red']);
    $placement = App\Models\Placement::create(['name' => 'Stock Taker', 'slug' => 'stock-taker', 'short' => 'STK', 'colour' => 'Black']);

    echo "Setup has been completed.";
    return view('admin.index');
});

Route::get('/setuppositions', function () {
    $position = App\Models\Position::create(['name' => 'General Manager', 'slug' => 'general-manager', 'icon' => '<i class="fas fa-chess-king"></i>']);
    $position = App\Models\Position::create(['name' => 'Assistant Manager', 'slug' => 'assistant-manager', 'icon' => '<i class="fas fa-chess-queen"></i>']);
    $position = App\Models\Position::create(['name' => 'Restaurant Manager', 'slug' => 'restaurant-manager', 'icon' => '<i class="fas fa-chess-rook"></i>']);
    $position = App\Models\Position::create(['name' => 'Head Housekeeper', 'slug' => 'head-housekeeper', 'icon' => '<i class="fas fa-chess-bishop"></i>']);
    $position = App\Models\Position::create(['name' => 'Front of House', 'slug' => 'front-of-house', 'icon' => '<i class="fas fa-running"></i>']);
    $position = App\Models\Position::create(['name' => 'Housekeeper', 'slug' => 'housekeeper', 'icon' => '<i class="fas fa-chess-pawn"></i>']);
    $position = App\Models\Position::create(['name' => 'Stock Taker', 'slug' => 'stock-taker', 'icon' => '<i class="fas fa-user-edit"></i>']);
    $position = App\Models\Position::create(['name' => 'Supervisor', 'slug' => 'supervisor', 'icon' => '<i class="fas fa-chess-knight"></i>']);
    $position = App\Models\Position::create(['name' => 'Chef', 'slug' => 'chef', 'icon' => '<i class="fas fa-utensils"></i>']);
    $position = App\Models\Position::create(['name' => 'Pot Wash', 'slug' => 'pot-wash', 'icon' => '<i class="fas fa-tint"></i>']);
    echo "Setup has been completed.";
    return view('admin.index');
});

Route::get('/setuppplacements', function () {
    $placement = App\Models\Placement::create(['name' => 'Off', 'slug' => 'off', 'short' => 'OFF', 'colour' => 'White']);
    $placement = App\Models\Placement::create(['name' => 'Holiday', 'slug' => 'holiday', 'short' => 'HOL', 'colour' => 'White']);
    $placement = App\Models\Placement::create(['name' => 'Sick', 'slug' => 'sick', 'short' => 'SIC', 'colour' => 'White']);
    $placement = App\Models\Placement::create(['name' => 'Reception', 'slug' => 'reception', 'short' => 'REC', 'colour' => 'Yellow']);
    $placement = App\Models\Placement::create(['name' => 'Front Of House', 'slug' => 'front-of-house', 'short' => 'FOH', 'colour' => 'Cyan']);
    $placement = App\Models\Placement::create(['name' => 'Housekeeping', 'slug' => 'housekeeping', 'short' => 'HK', 'colour' => 'Green']);
    $placement = App\Models\Placement::create(['name' => 'Kitchen', 'slug' => 'kitchen', 'short' => 'KIT', 'colour' => 'Red']);
    $placement = App\Models\Placement::create(['name' => 'Stock Taker', 'slug' => 'stock-taker', 'short' => 'STK', 'colour' => 'Black']);
    echo "Setup has been completed.";
    return view('admin.index');
});
