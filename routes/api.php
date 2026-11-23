<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CocheController;
use App\Http\Controllers\RevisionController;

Route::apiResource(('clientes'), ClientController::class);
Route::apiResource(('coches'), CocheController::class);
Route::apiResource(('revisiones'), RevisionController::class);