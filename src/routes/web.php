<?php

Route::middleware(['web', 'auth', 'core'])
    ->namespace('LaravelEnso\Notifications\app\Http\Controllers')
    ->group(function () {
        Route::prefix('core/notifications')->as('core.notifications.')
            ->group(function () {
                Route::get('getCount', 'NotificationController@getCount')
                    ->name('getCount');
                Route::get('getList/{offset}/{paginate}', 'NotificationController@getList')
                    ->name('getList');
                Route::patch('markAsRead/{notification}', 'NotificationController@markAsRead')
                    ->name('markAsRead');
                Route::patch('markAllAsRead', 'NotificationController@markAllAsRead')
                    ->name('markAllAsRead');
                Route::patch('clearAll', 'NotificationController@clearAll')
                    ->name('clearAll');
            });
    });
