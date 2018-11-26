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
        // Posts Resource
        Route::resource('posts', 'PostController')->except(['create', 'edit']);
        // Comments
        Route::post('post/{post}/comment', 'CommentController@store')->name('comment.store');
    });
});


