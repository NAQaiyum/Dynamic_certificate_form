<?php

use Illuminate\Support\Facades\Route;

$adminNamespace     = 'App\Http\Controllers\Admin';
$frontendNamespace  = 'App\Http\Controllers\Frontend';
Auth::routes();
Route::namespace($adminNamespace)->middleware(['auth'])->group(function () {
    Route::get('/home', 'DashboardController@index')->name('dashboard');
});
Route::namespace($adminNamespace)->middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/home', 'DashboardController@index')->name('index');
    Route::get('/logout', 'UserController@logout')->name('Auth::logout');

    Route::name('my::')->prefix('my/')->group(function () {
        Route::get('profile', 'UserController@Profile')->name('profile');
        Route::get('profile/edit', 'UserController@ProfileEdit')->name('profile_edit');
        Route::post('profile/update', 'UserController@ProfileUpdate')->name('profile_update');
        Route::get('notification', 'UserController@Notification')->name('notification');
    });
    Route::name('invoice::')->prefix('invoice')->group(function () {
        Route::get('', 'InvoiceController@index')->name('list');
        Route::get('form', 'InvoiceController@getForm')->name('form');
        Route::post('save', 'InvoiceController@save')->name('save');
    });
    Route::name('ckeditor::')->prefix('ckeditor')->group(function () {
        Route::any('upload', 'CkController@upload')->name('upload');
    });
});
Route::namespace($frontendNamespace)->name('frontend::')->group(function () {
    Route::get('', 'HomeController@index')->name('home');
    Route::name('invoice.')->prefix('invoice')->group(function () {
        Route::post('save', 'HomeController@save')->name('save');
        Route::get('details', 'HomeController@details')->name('details');
        Route::get('print', 'HomeController@print')->name('print');
        // Route::post('saveqr', 'HomeController@saveqr')->name('frontend::invoice.saveqr');

    });
});

Route::get('artisan/call', function () {

    // \Artisan::call('migrate');
    \Artisan::call('config:cache');
    dd("Migration done!");

});

// Route::get('/code-qr', function () {

//     // \Artisan::call('migrate');
//     return view('qrcode');

// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
