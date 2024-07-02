<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\AssessmentDetailsPanelController;


Route::get('/', function () {
    return view('welcome');
});


Route::resource('homepage', HomepageController::class);

Route::get('/home', function () {
    return view('homepage');
});

Route::resource('assessment-details', AssessmentDetailsPanelController::class);

Route::get('/assessment-details', function () {
    return view('assessment_details_panel');
});


