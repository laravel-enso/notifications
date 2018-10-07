<?php

Route::middleware(['web', 'auth', 'core'])
    ->prefix('api/core')->as('core.')
    ->namespace('LaravelEnso\Notifications\app\Http\Controllers')
    ->group(function () {
        Route::resource('notifications', 'NotificationController', [
            'only' => ['index', 'update', 'destroy'],
        ]);

        Route::prefix('notifications')->as('notifications.')
            ->group(function () {
                Route::get('count', 'NotificationController@count')
                    ->name('count');
                Route::post('updateAll', 'NotificationController@updateAll')
                    ->name('updateAll');
                Route::post('destroyAll', 'NotificationController@destroyAll')
                    ->name('destroyAll');
            });
    });
