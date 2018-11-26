<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    // First Login
    Route::middleware('profileNotCompleted')->prefix('profile')->group(function (){
        Route::get('/complete', 'ProfileController@complete')->name('profile.complete');
        Route::put('/complete/update', 'ProfileController@completeUpdate')->name('profile.completeUpdate');
    });
    // After Updating Profile with Gender.
    Route::middleware('profileCompleted')->group(function (){
        Route::resource('posts', 'PostController')->except(['create', 'edit']);
    });
});


