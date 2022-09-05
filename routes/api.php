<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\Admin\UserController as AdminUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    "prefix" => "auth",
    'as' => 'api.auth.'
], function () {
    Route::post('register', [AuthController::class, 'register'])
        ->name('register');

    Route::post('login', [AuthController::class, 'login'])
        ->name('login');

    Route::middleware('auth:sanctum')
        ->post('logout', [AuthController::class, 'logout'])
        ->name('logout');
});

// User
Route::get('user/{user:user_name}', [UserController::class, 'show'])
    ->name('api.user.show');

// Admin

Route::group([
    'prefix'=>'admin'
], function () {
    Route::post('/admin/users/store', [AdminUserController::class, 'store'])
        ->name('api.admin.user.store');

    Route::resource('users', AdminUserController::class);

});



