<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PlanController;



Route::get('/test', function () {
   return view("test");
});
Route::get('/dash', [App\Http\Controllers\PlanController::class, 'showForUsers'])->name('home');

Route::get('/contact', [ContactController::class, 'showForm'])->name('contact');

// إرسال البيانات بعد تعبئة الفورم
Route::post('/store', [ContactController::class, 'store'])->name('store');


Route::post('/admin/notifications/mark-as-read', function () {
    auth('admin')->user()->unreadNotifications->markAsRead();
    return response()->json(['status' => 'success']);
})->name('admin.notifications.read');



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
