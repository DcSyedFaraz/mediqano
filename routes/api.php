<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('product/export', [ProductController::class, 'index']);

Route::post('export', [ApiController::class, 'apiexport'])->name('api.export');
Route::post('import', [ApiController::class, 'apiimport'])->name('api.import');
