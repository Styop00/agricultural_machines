<?php

declare(strict_types=1);

use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\CareerApplicationController;
use App\Http\Controllers\Api\CarImageController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\InformationRequestController;
use App\Http\Controllers\Api\MachineModelController;
use App\Http\Controllers\Api\ManufacturerController;
use App\Http\Controllers\Api\TeamMemberController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\WorkingTimeController;
use Illuminate\Support\Facades\Route;

Route::post('career-applications', CareerApplicationController::class);
Route::post('information-requests', InformationRequestController::class);

Route::apiResource('companies', CompanyController::class);
Route::apiResource('working-times', WorkingTimeController::class);
Route::apiResource('manufacturers', ManufacturerController::class);
Route::apiResource('machine-models', MachineModelController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('cars', CarController::class);
Route::apiResource('car-images', CarImageController::class);
Route::apiResource('testimonials', TestimonialController::class)->only(['index', 'show']);
Route::apiResource('team-members', TeamMemberController::class)->only(['index', 'show']);
