<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;



//Route::get('/hellobakr', function () {
//    return 'Hello  ya bakr  ';
//});

Route::get('/register', [UserController::class, 'showRegister'])->name('showRegister');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/showLogin', [UserController::class, 'showLogin'])->name('login.form');
Route::post('/userLogin', [UserController::class, 'login'])->name('userLogin');

Route::get('/userLogout', [UserController::class, 'logout'])->name('userLogout');
Route::get('', [HomeController::class, 'index']);


Route::prefix('student')->group(function () {
    Route::get("index", [\App\Http\Controllers\StudentController::class, 'index'])->name('student.index');
    Route::get("toExam", [\App\Http\Controllers\StudentController::class, 'toExam'])->name("toExam");
    Route::get("settings", [\App\Http\Controllers\StudentController::class, 'toSettings'])->name("settings");
});
