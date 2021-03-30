<?php

use Illuminate\Support\Facades\Route;

Route::namespace('\Elaniin\Findable\Http\Controllers\CP')
    ->prefix('seo')
    ->name('findable.')
    ->group(function () {
        Route::get('/', 'GeneralSettingsController@index')
            ->name('settings');

        Route::prefix('settings')->group(function () {
            Route::resource('general', 'GeneralSettingsController')->only([
                'index', 'store',
            ]);

            Route::resource('webmaster', 'WebmasterSettingsController')->only([
                'index', 'store',
            ]);
        });
    });
