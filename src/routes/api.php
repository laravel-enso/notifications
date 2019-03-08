<?php

Route::middleware(['web', 'auth', 'core'])
    ->prefix('api/core')->as('core.')
    ->namespace('LaravelEnso\Notifications\app\Http\Controllers')
    ->group(function () {
        Route::resource('notifications', 'NotificationController', [
            'only' => ['index', 'destroy'],
        ]);

        Route::prefix('notifications')->as('notifications.')
            ->group(function () {
                Route::get('count', 'NotificationController@count')
                    ->name('count');
                Route::patch('read/{notification}', 'NotificationController@read')
                    ->name('read');
                Route::post('readAll', 'NotificationController@readAll')
                    ->name('readAll');
                Route::post('destroyAll', 'NotificationController@destroyAll')
                    ->name('destroyAll');
            });
    });
