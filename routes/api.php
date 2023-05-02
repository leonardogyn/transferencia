<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/type-user')->group(function () {
    Route::get('/list', '\Modules\TypeUser\Controllers\TypeUsersController@list')->name('listTypeUser');
    Route::post('/create', '\Modules\TypeUser\Controllers\TypeUsersController@create')->name('createTypeUser');
});

Route::prefix('/type-transfer')->group(function () {
    Route::get('/list', '\Modules\TypeTransfer\Controllers\TypeTransferController@list')->name('listTypeTransfer');
    Route::post('/create', '\Modules\TypeTransfer\Controllers\TypeTransferController@create')->name('createTypeTransfer');
});

Route::prefix('/user')->group(function () {
    Route::get('/list', '\Modules\User\Controllers\UserController@list')->name('listUser');
    Route::post('/create', '\Modules\User\Controllers\UserController@create')->name('createUser');
});

Route::prefix('/account')->group(function () {
    Route::get('/list', '\Modules\Account\Controllers\AccountController@list')->name('listAccount');
    Route::post('/create', '\Modules\Account\Controllers\AccountController@create')->name('createAccount');
});

Route::prefix('/transfer')->group(function () {
    Route::get('/list', '\Modules\Transfer\Controllers\TransferController@list')->name('listTransfer');
    Route::post('/create', '\Modules\Transfer\Controllers\TransferController@create')->name('createTransfer');
});
