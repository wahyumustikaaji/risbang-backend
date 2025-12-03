<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProblemStatementApiController;

Route::get('/problem-statement', [ProblemStatementApiController::class, 'index']);
