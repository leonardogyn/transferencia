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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('/type-user')->group(function () {
    Route::get('/list', '\Modules\TypeUser\Controllers\TypeUsersController@list')->name('listTypeUser');
    Route::post('/create', '\Modules\TypeUser\Controllers\TypeUsersController@create')->name('createTypeUser');
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

Route::prefix('/transfer-history')->group(function () {
    Route::get('/list', '\Modules\TransferHistory\Controllers\TransferHistoryController@list')->name('listTransferHistory');
    Route::post('/create', '\Modules\TransferHistory\Controllers\TransferHistoryController@create')->name('createTransferHistory');
});
