<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\UserController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Roles
Route::resource('roles', App\Http\Controllers\RolesController::class);


Route::get('/distributors', [DistributorController::class, 'index'])->name('distributor.index');
Route::get('/distributors_add', [DistributorController::class, 'addDistributor'])->name('distributor.create');


Route::get("user_roles",[UserController::class,'user_roles'])->name("user_roles");
    Route::post("user_roles/store",[UserController::class,'store_user_roles'])->name("user_roles.store");
    Route::post("user_roles/edit",[UserController::class,'user_roles_edit'])->name("user_roles.edit");
    Route::get("user_roles/delete/{id}",[UserController::class,'user_roles_delete'])->name("user_roles.delete");
    Route::get("userrole_permissions/{id}",[UserController::class,'userrole_permissions'])->name("userrole_permissions");
    Route::post("store_userrole_permissions",[UserController::class,"store_userrole_permissions"])->name("store_userrole_permissions");