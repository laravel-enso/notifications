<?php

Route::middleware(['web', 'auth', 'core'])
    ->prefix('api/core/notifications')->as('core.notifications.')
    ->namespace('LaravelEnso\Notifications\app\Http\Controllers')
    ->group(function () {
        Route::get('getCount', 'NotificationController@getCount')
            ->name('getCount');
        Route::get('getList/{offset}/{paginate}', 'NotificationController@index')
            ->name('getList');
        Route::patch('markAsRead/{notification}', 'NotificationController@markAsRead')
            ->name('markAsRead');
        Route::patch('markAllAsRead', 'NotificationController@markAllAsRead')
            ->name('markAllAsRead');
        Route::delete('clear/{notification}', 'NotificationController@clear')
            ->name('clear');
        Route::patch('clearAll', 'NotificationController@clearAll')
            ->name('clearAll');
    });
