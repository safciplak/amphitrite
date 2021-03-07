<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CallbackController;
use App\Http\Controllers\ReportController;
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

Route::any('register', [ApiController::class, 'register']);
Route::any('purchase', [ApiController::class, 'purchase']);
Route::any('check-subscription', [ApiController::class, 'checkSubscription']);

Route::any('test', [ApiController::class, 'test']);
Route::any('callbackUrl', [CallbackController::class, 'callbackUrl']);
Route::any('list', [ReportController::class, 'list']);
