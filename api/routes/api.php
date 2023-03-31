<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MeController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::get('verify-email', [AuthController::class, 'VerifyEmail']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::put('reset-password', [AuthController::class, 'resetPassword']);
	


Route::group([

	'middleware' => 'api',
	'prefix' => 'auth'

], function ($router) {
		Route::get('me', [AuthController::class, 'me']);

		Route::post('logout', [AuthController::class, 'logout']);
		Route::post('refresh', [AuthController::class, 'refresh']);
	});

