<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () { return view('welcome');});

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/votaciones', [HomeController::class, 'votaciones'])->name('votaciones');
Route::get('/estadisticas', [HomeController::class, 'estadisticas'])->name('estadisticas');
Route::get('/view-projects', [HomeController::class, 'projects'])->name('projects');
Route::get('/admin-projects', [HomeController::class, 'adminProjects'])->name('adminProjects');
Route::post('/votacion', [HomeController::class, 'votacion'])->name('votacion');
//Route::apiResource('/questions', QuestionController::class);
Route::resource('questions', QuestionController::class);
Route::apiResource('/projects', ProjectController::class);
Route::apiResource('/responses', ResponseController::class);
