<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\RoomTypeController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'Index'])->name('home');

Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/profile/upadte', [UserController::class, 'UserProfileUpdate'])->name('user.profile.update');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');
});

require __DIR__ . '/auth.php';

//Admin Group Route
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/update', [AdminController::class, 'AdminProfileUpdate'])->name('admin.profile.update');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

//Admin Group Route
Route::middleware(['auth', 'roles:admin'])->group(function () {

    // Team all Controller
    Route::controller(TeamController::class)->group(function () {
        Route::get('/team/all', 'AllTeam')->name('all.team');
        Route::get('/team/add', 'AddTeam')->name('add.team');
        Route::post('/team/store', 'StoreTeam')->name('store.team');
        Route::get('/team/edit/{id}', 'EditTeam')->name('edit.team');
        Route::post('/team/update', 'UpdateTeam')->name('update.team');
        Route::get('/team/delete/{id}', 'DeleteTeam')->name('delete.team');
    });

    // Booo area all Controller
    Route::controller(TeamController::class)->group(function () {
        Route::get('/update/bookarea', 'ViewBookarea')->name('update.bookarea');
        Route::post('/book/area/update', 'UpdateBookarea')->name('book.area.update');
    });

    // Room Type all Controller
    Route::controller(RoomTypeController::class)->group(function () {
        Route::get('/room/type/list', 'RoomTypeList')->name('room.type.list');
        Route::get('/room/type/add', 'RoomTypeAdd')->name('add.room.type');
        Route::post('/room/type/store', 'RoomTypeStore')->name('store.room.type');
        // Route::post('/book/area/update', 'UpdateBookarea')->name('book.area.update');
    });
});
