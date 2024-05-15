<?php
require_once '../autoload.php';
require_once '../lib/route.php';
require_once '../cors-config.php';

use lib\Route;
use App\Controllers\PriceController;
use app\Controllers\ProductController;

Route::get('/productos', [ProductController::class, 'index']);
Route::post('/productos/create', [ProductController::class, 'store']);
Route::put('/productos', [ProductController::class, 'update']);
Route::delete('/productos', [ProductController::class, 'destroy']);
Route::get('/productos/usd', [PriceController::class, 'moneyConverter']);
Route::dispatch();
