<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginPanelController;
use App\Http\Controllers\RegisterPanelController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\QuizEditorPanelController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', [HomepageController::class, 'view_homepage'])->name('home.view');

// Route::get('/login', [LoginPanelController::class, 'view_login_panel'])->name('login');

Route::get('/login', [LoginPanelController::class, 'view_login_panel'])->name('login.view');
Route::post('/login', [LoginPanelController::class, 'login'])->name('login.get');
Route::get('/logout', [LoginPanelController::class, 'logout'])->name('login.logout');


Route::view('/register', 'RegisterPanel')->name('register.view');
Route::post('/register', [RegisterPanelController::class, 'register'])->name('register.store');


Route::get('/quiz-specification', [QuizEditorPanelController::class, 'view_specification_panel'])->name('quiz.view');
Route::post('/quiz', [QuizEditorPanelController::class, 'store'])->name('quiz.store');

