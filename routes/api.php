<?php

use App\Http\Controllers\ListItemsController;
use App\Http\Controllers\MarketListsController;
use App\Http\Controllers\SharesController;
use App\Http\Controllers\ToggleListItemController;
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

Route::prefix('auth')->group(function () {
	Route::post('signup', 'App\Http\Controllers\Api\Auth\AuthController@signup')->name('auth.signup');
	Route::post('login', 'App\Http\Controllers\Api\Auth\AuthController@login')->name('auth.login');
	Route::post('logout', 'App\Http\Controllers\Api\Auth\AuthController@logout')->middleware('auth:sanctum')->name('auth.logout');
	Route::get('user', 'App\Http\Controllers\Api\Auth\AuthController@getAuthenticatedUser')->middleware('auth:sanctum')->name('auth.user');

	Route::post('/password/email', 'App\Http\Controllers\Api\Auth\AuthController@sendPasswordResetLinkEmail')->middleware('throttle:5,1')->name('password.email');
	Route::post('/password/reset', 'App\Http\Controllers\Api\Auth\AuthController@resetPassword')->name('password.reset');
});

Route::resource('/market-lists', MarketListsController::class)->middleware('auth:sanctum');
Route::patch('market-lists/update-title/{marketList}', [MarketListsController::class, 'update'])->middleware('auth:sanctum');

Route::resource('/list-items', ListItemsController::class)->middleware('auth:sanctum');
Route::patch('/list-items/{listItem}/set-as-done', [ToggleListItemController::class, 'setAsDone'])->middleware('auth:sanctum');
Route::patch('/list-items/{listItem}/set-as-undone', [ToggleListItemController::class, 'setAsUndone'])->middleware('auth:sanctum');

Route::resource('/shares', SharesController::class)->middleware('auth:sanctum');
