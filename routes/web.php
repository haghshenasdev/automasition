<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('admin');
});

Route::get('/private-dl',function (){
    $path = request()->get('path');
    return Storage::disk('private')->download(
        $path,basename($path),[
            'Content-Length' => Storage::disk('private')->size($path)
        ]
    );
})->middleware('auth');

Route::get('/login',function (){
    return redirect('admin');
})->name('login');

Route::get('/register',function (){
    return redirect('admin');
})->name('register');
