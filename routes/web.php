<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php

Route::resource('/prompts', PromptController::class)
     ->middleware('auth');
