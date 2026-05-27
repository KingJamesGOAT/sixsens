<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VitrinController;

// Site vitrine
Route::get('/', [VitrinController::class, 'index']);
Route::get('/{page}', [VitrinController::class, 'show']);
