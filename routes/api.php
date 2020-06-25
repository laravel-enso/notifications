<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['api', 'auth', 'core'])
    ->namespace('LaravelEnso\Notifications\Http\Controllers')
    ->prefix('api/core/notifications')
    ->as('core.notifications.')
    ->group(function () {
        Route::get('', 'Index')->name('index');
        Route::delete('{notification}', 'Destroy')->name('destroy');
        Route::get('count', 'Count')->name('count');
        Route::patch('read/{notification}', 'Read')->name('read');
        Route::post('readAll', 'ReadAll')->name('readAll');
        Route::post('destroyAll', 'DestroyAll')->name('destroyAll');
    });
