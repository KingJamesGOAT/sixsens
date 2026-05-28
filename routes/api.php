<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\Api\ApiRewardsController;

Route::get('/trophies/{year?}', [ApiRewardsController::class, 'winner']);
Route::get('/labels/{year?}', [ApiRewardsController::class, 'labelledCompanies']);
