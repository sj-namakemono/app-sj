<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::group(['prefix' => 'delivery', 'as' => 'delivery.'], function () {
        Route::get('/', App\Livewire\Delivery\Index::class)->name('index');
        Route::get('/overview', App\Livewire\Delivery\Overview::class)->name('overview');
        Route::get('/create', App\Livewire\Delivery\Create::class)->name('create');
        Route::get('/{id}/edit', App\Livewire\Delivery\Edit::class)->name('edit');
        Route::get('/setting', App\Livewire\Delivery\Setting::class)->name('setting');
    });
});
