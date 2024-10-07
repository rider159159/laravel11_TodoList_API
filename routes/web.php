<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/upload', function () {
    return view('upload');
});

Route::post('/upload', function (Request $request) {
    // 驗證上傳文件
    $request->validate([
        'file' => 'required|file|mimes:jpg,png,jpeg,gif|max:2048',
    ]);

    // 將文件保存到 storage/app/public 目錄下
    $path = $request->file('file')->store('uploads', 'public');

    return "文件上傳成功，路徑：" . asset('storage/' . $path);
});