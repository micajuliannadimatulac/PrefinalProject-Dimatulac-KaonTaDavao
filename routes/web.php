<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EateryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\ReviewerController;
use Illuminate\Support\Facades\Route;

// Public homepage.
Route::get('/', HomeController::class)->name('home');

// All seven eatery resource routes.
Route::resource('eateries', EateryController::class);

// Post a review for a specific eatery.
Route::post('/eateries/{eatery}/reviews', [
    ReviewController::class,
    'store',
])->name('eateries.reviews.store');

// Delete an existing review.
Route::delete('/reviews/{review}', [
    ReviewController::class,
    'destroy',
])->name('reviews.destroy');

// Browse districts and their eateries.
Route::get('/districts', [
    DistrictController::class,
    'index',
])->name('districts.index');

Route::get('/districts/{district}', [
    DistrictController::class,
    'show',
])->name('districts.show');

// View all reviews written by a reviewer.
Route::get('/reviewers/{user}', [
    ReviewerController::class,
    'show',
])->name('reviewers.show');
