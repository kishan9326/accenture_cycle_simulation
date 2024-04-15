<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileManagementController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CategoryManagementController;
use App\Http\Controllers\DataManagementController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

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

Route::resource('/', LoginController::class);
Route::resource('login', LoginController::class);
// Route::post('forgotpassword/reset', [ForgotPasswordController::class, 'reset'])->name('forgotpassword.reset');
Route::resource('forgotpassword', ForgotPasswordController::class);
Route::post('login/logout', [LoginController::class, 'logout'])->name('login.logout');
Route::resource('user', UserController::class);
// Route::resource('category', CategoryController::class);
Route::post('question/ajax_question_update', [QuestionController::class, 'ajax_question_update']);
Route::resource('question', QuestionController::class);
Route::post('dashboard/category-management/category/update', [CategoryController::class, 'category_update'])->name('category-management.category_update');
Route::get('dashboard/category-management/category/edit', [CategoryController::class, 'category_list'])->name('category-management.category_list');
Route::resource('dashboard/category-management/category', CategoryController::class);
Route::resource('dashboard/category-management/question', QuestionController::class);
Route::get('dashboard/profile-management/export', [ProfileManagementController::class, 'export'])->name('profile-management.export');
Route::resource('dashboard/profile-management', ProfileManagementController::class);
Route::resource('dashboard/category-management', CategoryManagementController::class);
Route::resource('dashboard/data-management', DataManagementController::class);
Route::get('dashboard/leaderboard/export', [LeaderboardController::class, 'export'])->name('leaderboard.export');
Route::post('dashboard/leaderboard/export_user/{id}', [LeaderboardController::class, 'export_user'])->name('leaderboard.export_user');
Route::resource('dashboard/leaderboard', LeaderboardController::class);
Route::resource('dashboard', DashboardController::class);
