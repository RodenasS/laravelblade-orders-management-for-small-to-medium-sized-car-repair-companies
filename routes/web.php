<?php

use App\Http\Controllers\AdminpanelController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyInformationController;
use App\Http\Controllers\CustomResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VinDecoderController;
use App\Models\CompanyInformation;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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
// Common resource routes:
// index - show all listings
// show - show single listing
// create - show form to create new listing
// store - store new listing
// edit - show form to edit listing
// update - update listing
// destroy - destroy listing

$companyInformation = CompanyInformation::first();
$companyName = $companyInformation->name;

// Share the company name with all views
View::share('companyName', $companyName);

// Sidebar
Route::get('/company-information', [CompanyInformationController::class, 'show'])->name('company-information');
Route::delete('/company_information/{companyInformation}/delete-logo', [CompanyInformationController::class, 'deleteLogo'])->name('company_information.delete_logo');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/calendar-data', [DashboardController::class, 'calendarData'])->name('calendar.data');
Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
Route::get('/adminpanel', [AdminpanelController::class, 'index'])->name('adminpanel');


// USERS
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/user-profile-picture', [UserController::class, 'getUserProfilePicture'])->name('user.profile-picture');
Route::post('/forgot-password', [UserController::class, 'resetPassword'])->name('users.resetPassword');
Route::get('/forgot-password', [UserController::class, 'showForgotPasswordForm'])->name('password.reset');



// Edit user's own profile
Route::get('/profile/edit', [UserController::class, 'editOwnProfile'])->name('profile.edit');

// Password reset routes
Route::get('password/reset', [CustomResetPasswordController::class, 'showResetForm'])->name('password.request');
Route::post('password/email', [CustomResetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('password/reset', [CustomResetPasswordController::class, 'reset'])->name('password.update');



Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

Route::get('company_information/{companyInformation}/edit', [CompanyInformationController::class, 'edit'])->name('company_information.edit');
Route::put('/company_information/{companyInformation}', [CompanyInformationController::class, 'update']);
// CLIENT ROUTES

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');
Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');

// VEHICLES ROUTES

Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');
Route::get('/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');
Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

// ORDER ROUTES

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
Route::post('/generate-pdf/{order}', [OrderController::class, 'generatePDF'])->name('generatePDF');

Route::get('/vin-decoder', [VinDecoderController::class, 'show']);
Route::get('/decode/{vin}', [VinDecoderController::class, 'decode']);

Route::get('/search', [SearchController::class, 'search'])->name('search');
