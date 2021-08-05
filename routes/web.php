<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostitController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [IndexController::class, 'index']);
Route::get('/register', [IndexController::class, 'register']);
Route::get('/login', [IndexController::class, 'login']);
Route::get('/logout', [IndexController::class, 'logout']);
Route::get('/viewPostits', [PostitController::class, 'viewPostits']);

Route::post('editPostit', [PostitController::class, 'editPostit']);
Route::post('registerUser', [UserController::class, 'registerUser']);
Route::post('loginUser', [UserController::class, 'loginUser']);
Route::post('addPostit', [PostitController::class, 'addPostit']);
Route::post('deletePostit', [PostitController::class, 'deletePostit']);

Route::resource('users', UserController::class);

Route::group(['middleware' => 'customAuth'], function(){
    //
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes(
    );
});
