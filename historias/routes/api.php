<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\ContentController;
use App\Http\Controllers\Api\CreatorController;
use App\Http\Controllers\Api\DateController;
use App\Http\Controllers\Api\TitleController;
use App\Http\Controllers\Api\OptionController;
use App\Http\Controllers\Api\ContributorController;
use App\Http\Controllers\Api\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas de los generos
Route::get('/genres', [GenreController::class, 'list']);
Route::get('/genres/{id}', [GenreController::class, 'id']);
Route::post('/cgenres', [GenreController::class, 'create']);

// Rutas de los contenidos
Route::get('/contents', [ContentController::class, 'list']);
Route::get('/contents/{id}', [ContentController::class, 'id']);
Route::post('/ccontents', [ContentController::class, 'create']);

// Rutas de los creadores
Route::get('/creators', [CreatorController::class, 'list']);
Route::get('/creators/{id}', [CreatorController::class, 'id']);
Route::post('/ccreators', [CreatorController::class, 'create']);

// Rutas de las fechas
Route::get('/dates', [DateController::class, 'list']);
Route::get('/dates/{id}', [DateController::class, 'id']);
Route::post('/cdates', [DateController::class, 'create']);

// Rutas de los titulos
Route::get('/titles', [TitleController::class, 'list']);
Route::get('/titles/{id}', [TitleController::class, 'id']);
Route::post('/ctitles', [TitleController::class, 'create']);

// Rutas de las opciones
Route::get('/options', [OptionController::class, 'list']);
Route::get('/options/{id}', [OptionController::class, 'id']);
Route::post('/coptions', [OptionController::class, 'create']);

// Rutas de los contribuidores
Route::get('/contributors', [ContributorController::class, 'list']);
Route::get('/contributors/{id}', [ContributorController::class, 'id']);
Route::post('/ccontributors', [ContributorController::class, 'create']);

// Rutas de los usuarios
Route::get('/users', [UserController::class, 'list']);
Route::get('/users/{id}', [UserController::class, 'id']);
Route::post('/cusers', [UserController::class, 'create']);