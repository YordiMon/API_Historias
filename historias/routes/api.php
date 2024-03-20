<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\ContentController;
use App\Http\Controllers\Api\DateController;
use App\Http\Controllers\Api\TitleController;
use App\Http\Controllers\Api\ContributorController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\SaveController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\DraftController;

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

// Ruta del Login
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Rutas de los generos
Route::get('/genres', [GenreController::class, 'list']);
Route::get('/lgenres/{id}', [GenreController::class, 'id']);
Route::POST('/cgenres', [GenreController::class, 'create']);
Route::POST('/ugenres/{id}', [GenreController::class, 'update']);

// Rutas de los contenidos
Route::get('/contents', [ContentController::class, 'list']);
Route::get('/contents/{id}', [ContentController::class, 'id']);
Route::post('/ccontents', [ContentController::class, 'create']);
Route::post('/ucontents', [ContentController::class, 'update']);

// Rutas de los creadores
/*
Route::get('/creators', [CreatorController::class, 'list']);
Route::get('/creators/{id}', [CreatorController::class, 'id']);
Route::post('/ccreators', [CreatorController::class, 'create']);
Route::post('/ucreators', [CreatorController::class, 'update']);
*/
// Rutas de las fechas
Route::get('/dates', [DateController::class, 'list']);
Route::get('/dates/{id}', [DateController::class, 'id']);
Route::post('/cdates', [DateController::class, 'create']);
Route::post('/udates', [DateController::class, 'update']);

// Rutas de los titulos
Route::get('/titles', [TitleController::class, 'list']);
Route::get('/titles/{id}', [TitleController::class, 'id']);
Route::post('/ctitles', [TitleController::class, 'create']);
Route::post('/utitles', [TitleController::class, 'update']);

// Rutas de las opciones
/*
Route::get('/options', [OptionController::class, 'list']);
Route::get('/options/{id}', [OptionController::class, 'id']);
Route::post('/coptions', [OptionController::class, 'create']);
Route::post('/uoptions', [OptionController::class, 'update']);
*/

// Rutas de los contribuidores
Route::get('/contributors', [ContributorController::class, 'list']);
Route::get('/contributors/{id}', [ContributorController::class, 'id']);
Route::post('/ccontributors', [ContributorController::class, 'create']);
Route::post('/ucontributors', [ContributorController::class, 'update']);

// Rutas de los usuarios
Route::get('/users', [UserController::class, 'list']);
Route::get('/user/{id}', [UserController::class, 'id']);
Route::post('/cusers', [UserController::class, 'create']);
Route::post('/cusers', [UserController::class, 'create']);
Route::post('/uuser/{id}', [UserController::class, 'update']);

Route::get('/nuser/{id}', [UserController::class, 'SearchUserByName']);

Route::get('/thistory/{title}', [HistoryController::class, 'searchByTitle']);
Route::get('/ghistory/{genre}', [HistoryController::class, 'searchByGenre']);
Route::get('/histories', [HistoryController::class, 'list']);
Route::get('/history/{id}', [HistoryController::class, 'id']);
Route::get('/uhistory/{id}', [HistoryController::class, 'historiesByUser']);
Route::get('/ushistory/{id}', [HistoryController::class, 'historiesByUserSaved']);
Route::get('/udhistory/{id}', [HistoryController::class, 'historiesByUserDrafts']);

Route::get('comments/{historyId}', [CommentController::class, 'index']);
Route::post('/createcomment', [CommentController::class, 'create']);

Route::post('/like', [LikeController::class, 'like']);
Route::post('/save', [SaveController::class, 'save']);

Route::get('/branch/{id}', [BranchController::class, 'getBranchesByHistoryId']);
Route::post('/cbranch', [BranchController::class, 'create']);

Route::post('/chistory', [HistoryController::class, 'store']);
Route::post('/cdhistory', [HistoryController::class, 'storeDrafts']);
Route::post('/dfdah-history', [HistoryController::class, 'deleteFromDraftsAndHistories']);

Route::post('/ddraft/{id}', [DraftController::class, 'deleteDraft']);
