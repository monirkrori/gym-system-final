<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Member\AttendanceLogController;
use App\Http\Controllers\Api\Member\BookingController;
use App\Http\Controllers\Api\Member\GetTrainerController;
use App\Http\Controllers\Api\Member\GetTrainingSessionController;
use App\Http\Controllers\Api\Member\MealPlanController;
use App\Http\Controllers\Api\Member\RatingController;
use App\Http\Controllers\Api\Member\SubscribeController;
use App\Http\Controllers\Api\Trainer\TrainerAttendanceController;
use App\Http\Controllers\Api\Trainer\TrainingSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// User route
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('resend-verification-email', [AuthController::class, 'resendVerificationEmail'])->middleware('auth:sanctum');

    // Forgot password routes
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('reset-password', [ForgotPasswordController::class, 'reset']);
});

/*
|--------------------------------------------------------------------------
| Member Routes
|--------------------------------------------------------------------------
*/
Route::prefix('member')->middleware('auth:sanctum')->group(function () {
    // Training session routes
    Route::get('sessions', [GetTrainingSessionController::class, 'listSessions']);
    Route::get('sessions/{id}', [GetTrainingSessionController::class, 'show']);

    // Subscription routes
    Route::post('subscribe-plan', [SubscribeController::class, 'subscribeToMembership']);
    Route::post('subscribe-package', [SubscribeController::class, 'subscribeToPackage']);

    // Booking routes
    Route::prefix('booking')->group(function () {
        Route::post('book', [BookingController::class, 'bookSession']);
        Route::post('cancel', [BookingController::class, 'cancelSession']);
        Route::get('history', [BookingController::class, 'getBookingHistory']);
        Route::get('usage-report', [BookingController::class, 'getUsageReport']);
    });

    // Rating routes
    Route::prefix('ratings')->group(function () {
        Route::post('/', [RatingController::class, 'store']);
        Route::put('{id}', [RatingController::class, 'update']);
        Route::get('{rateable_id}', [RatingController::class, 'show']);
        Route::post('{ratingId}/reply', [RatingController::class, 'reply']);
    });

    // Attendance routes
    Route::post('attendance', [AttendanceLogController::class, 'store']);

    // Meal plan routes
    Route::prefix('meal-plan')->group(function () {
        Route::post('subscribe', [MealPlanController::class, 'subscribeMealPlan']);
        Route::get('{id}', [MealPlanController::class, 'show']);
    });
});

// Get trainers route (not protected by auth)
Route::get('trainers-list', [GetTrainerController::class, 'listTrainer']);

/*
|--------------------------------------------------------------------------
| Trainer Routes
|--------------------------------------------------------------------------
*/
Route::prefix('trainer')->middleware('auth:sanctum')->group(function () {
    // Training session routes
    Route::apiResource('sessions', TrainingSessionController::class);

    // Attendance routes
    Route::prefix('sessions')->group(function () {
        Route::get('/', [TrainerAttendanceController::class, 'getSessions']);
        Route::get('{sessionId}/attendance', [TrainerAttendanceController::class, 'getAttendance']);
        Route::get('{sessionId}/report', [TrainerAttendanceController::class, 'getAttendanceReport']);
    });
});
