<?php

Route::group(['namespace' => 'LaravelEnso\Notifications\Http\Controllers', 'middleware' => ['web', 'auth', 'core']], function () {
    Route::group(['prefix' => 'core/notifications', 'as' => 'core.notifications.'], function () {
        Route::get('getCount', 'NotificationsController@getCount')->name('getCount');
        Route::get('getList', 'NotificationsController@getList')->name('getList');
        Route::patch('markAsRead', 'NotificationsController@markAsRead')->name('markAsRead');
        Route::patch('clearAll', 'NotificationsController@clearAll')->name('clearAll');
    });
});
