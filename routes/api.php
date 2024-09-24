<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/todos', [TodoController::class, 'index']); // 獲得所有代辦事項
Route::put('/todos/status', [TodoController::class, 'updateStatus']); // 修改完成狀態
Route::put('/todos', [TodoController::class, 'update']); // 編輯標題與描述
Route::post('/todos', [TodoController::class, 'store']);
