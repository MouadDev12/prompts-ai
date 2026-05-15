<?php

use App\Http\Controllers\PromptController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Routes CRUD des prompts (sans middleware auth pour l'instant — à activer quand l'authentification sera configurée)
Route::resource('prompts', PromptController::class);
