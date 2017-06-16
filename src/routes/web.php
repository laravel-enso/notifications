<?php

Route::group([
    'namespace'  => 'LaravelEnso\Notifications\app\Http\Controllers',
    'middleware' => ['web', 'auth', 'core'],
], function () {
    Route::group(['prefix' => 'core/notifications', 'as' => 'core.notifications.'], function () {
        Route::get('getCount', 'NotificationsController@getCount')->name('getCount');
        Route::get('getList/{offset}/{paginate}', 'NotificationsController@getList')->name('getList');
        Route::patch('markAsRead/{notification}', 'NotificationsController@markAsRead')->name('markAsRead');
        Route::patch('markAllAsRead', 'NotificationsController@markAllAsRead')->name('markAllAsRead');
        Route::patch('clearAll', 'NotificationsController@clearAll')->name('clearAll');
    });
});
