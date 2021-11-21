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

Route::post('subscribe', [App\Http\Controllers\API\SubscribersController::class, 'subscribe']);
Route::post('create_post', [App\Http\Controllers\API\PostsController::class, 'create_post']);
