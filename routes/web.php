<?php

use App\Livewire\Form;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('form', Form::class);

Route::get('/', \App\Livewire\Forms\Form::class);

Route::get('/refresh', function () {

    Artisan::call('db:wipe');
    Artisan::call('migrate --seed');

    return response()->json([
        'message' => 'Database refreshed and seeded successfully.',
        'output' => Artisan::output(),
    ]);
});
