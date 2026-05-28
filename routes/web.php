<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VitrinController;

// Site vitrine
Route::get('/', [VitrinController::class, 'home']);
Route::get('/trophies', [VitrinController::class, 'trophies']);
Route::get('/label', [VitrinController::class, 'label']);
Route::get('/companies', [VitrinController::class, 'companies']);
Route::get('/contact', [VitrinController::class, 'contact']); // TODO: contact page
