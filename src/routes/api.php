<?php

Route::middleware(['web', 'auth', 'core'])
    ->prefix('api/core/notifications')
    ->as('core.notifications.')
    ->namespace('LaravelEnso\Notifications\app\Http\Controllers')
    ->group(function () {
        Route::get('', 'Index')->name('index');
        Route::delete('{notification}', 'Destroy')->name('destroy');
        Route::get('count', 'Count')->name('count');
        Route::patch('read/{notification}', 'Read')->name('read');
        Route::post('readAll', 'ReadAll')->name('readAll');
        Route::post('destroyAll', 'DestroyAll')->name('destroyAll');
    });
