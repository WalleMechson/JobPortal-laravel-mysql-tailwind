<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobApplication;
use App\Http\Controllers\MyJobApplication;
use App\Http\Controllers\MyJobController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\JobController;

use \App\Http\Controllers\Auth\ForgotPasswordController;
use \App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

Route::get("", fn() => to_route("jobs.index"));
Route::get("login", fn() => to_route("auth.create"))->name("login");

Route::resource('jobs', JobController::class)->only(["index", "show"]);
Route::resource('auth', AuthController::class)->only(['create', 'store']);
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'storeUser'])->name('auth.storeUser');

Route::delete("logout", fn() => to_route("auth.delete"))->name("logout");
Route::delete("auth", [AuthController::class, "destroy"])->name("auth.destory");

Route::get('/download-cv/{filename}', [JobApplication::class, 'downloadCv'])->name('download-cv');

Route::middleware(["auth"])->group(function () {
    Route::resource("job.applications", JobApplication::class)->only(["create", "store"]);
    Route::resource('my_job_applications', MyJobApplication::class)->only(['index', 'destroy']);
    Route::resource('employer', EmployerController::class)->only(["create", "store"]);
    Route::middleware("employer")->resource("my-jobs", MyJobController::class);
});