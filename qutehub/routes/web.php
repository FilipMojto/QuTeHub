<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\AssessmentDetailsPanelController;
use App\Http\Controllers\LoginPanelController;
use App\Http\Controllers\RegisterPanelController;

Route::get('/', function () {
    return view('homepage');

});


Route::resource('homepage', HomepageController::class);

Route::get('/home', function () {
    return view('homepage');
});

Route::resource('assessment-details', AssessmentDetailsPanelController::class);

Route::get('/assessment-details', function () {
    return view('assessment_details_panel');
});

Route::get('my-assessments', function() {
    return view('my_assessment_list_section');
});


Route::get('login', [LoginPanelController::class, 'show_login_panel']);

Route::get('register', [RegisterPanelController::class, 'show_register_panel']);
Route::post('register', [RegisterPanelController::class, 'store'])->name('register.store');



