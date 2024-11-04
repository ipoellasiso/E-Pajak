<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboarduserController;
use App\Http\Controllers\PajakguController;
use App\Http\Controllers\PajaklsController;
use App\Http\Controllers\TarikdataController;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', function () {
//     return view('Template.Layout');
// });

Route::get('/login1', [AuthController::class, 'index'])->name('login');
Route::post('/cek_login', [AuthController::class, 'cek_login']);
Route::get('/logout', [AuthController::class, 'logout']);

// ======= DASHBOARD =======
Route::get('/home', [DashboardController::class, 'index']);
Route::get('/homeuser', [DashboarduserController::class, 'index']);

// ======= DATA TARIK PAJAK SIPD RI =======
Route::get('/tarikpajaksipdri', [TarikdataController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::get('/tarikpajaksipdrigu', [TarikdataController::class, 'indexgu'])->middleware('auth:web','checkRole:Admin');
Route::post('/simpanjson', [TarikdataController::class, 'save_json'])->middleware('auth:web','checkRole:Admin');
Route::post('/simpanjsongu', [TarikdataController::class, 'save_jsongu'])->middleware('auth:web','checkRole:Admin');

// ======= DATA PAJAKLS =======
Route::get('/tampilpajakls', [PajaklsController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::post('/pajakls1/store', [PajaklsController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::get('/pajakls1/edit/{id}', [PajaklsController::class, 'edit'])->middleware('auth:web','checkRole:Admin');
Route::post('/pajakls1/update/{id}', [PajaklsController::class, 'update'])->middleware('auth:web','checkRole:Admin');
Route::delete('/pajakls1/destroy/{id}', [PajaklsController::class, 'destroy'])->middleware('auth:web','checkRole:Admin');
Route::post('/pajakls1/terima/{id}', [PajaklsController::class, 'terima'])->middleware('auth:web','checkRole:Admin');
Route::post('/pajakls1/tolak/{id}', [PajaklsController::class, 'tolak'])->middleware('auth:web','checkRole:Admin');
Route::get('/tampilpajaklssipd1', [PajaklsController::class, 'pilihpajaklssipd'])->middleware('auth:web','checkRole:Admin');
Route::get('/pajaklssipd1/edit/{id}', [PajaklsController::class, 'editpajaklssipd'])->middleware('auth:web','checkRole:Admin');
Route::get('/pajakls1/akunpajak', [PajaklsController::class, 'getDataakunpajak'])->middleware('auth:web','checkRole:Admin');
Route::get('/pajakls1/jenispajak', [PajaklsController::class, 'getDatajenispajak'])->middleware('auth:web','checkRole:Admin');
Route::get('/pajakls1/tolakls/{id}', [PajaklsController::class, 'tolakls'])->middleware('auth:web','checkRole:Admin');
Route::post('/pajakls1/tolaklsupdate/{id}', [PajaklsController::class, 'tolaklsupdate'])->middleware('auth:web','checkRole:Admin');
Route::get('/pajakls1/terimals/{id}', [PajaklsController::class, 'terimals'])->middleware('auth:web','checkRole:Admin');
Route::post('/pajakls1/terimalsupdate/{id}', [PajaklsController::class, 'terimalsupdate'])->middleware('auth:web','checkRole:Admin');
Route::get('/pajakls1/lihat/{id}', [PajaklsController::class, 'lihat'])->middleware('auth:web','checkRole:Admin');
Route::get('/pajakls1/totalnilai', [PajaklsController::class, 'totalpajakls'])->middleware('auth:web','checkRole:Admin');

// ======= DATA PAJAKGU =======
Route::get('/tampilpajakgu', [PajakguController::class, 'index'])->middleware('auth:web','checkRole:User,Admin');
Route::post('/pajakgu/store', [PajakguController::class, 'store'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/pajakgu/edit/{id}', [PajakguController::class, 'edit'])->middleware('auth:web','checkRole:User,Admin');
Route::post('/pajakgu/update/{id}', [PajakguController::class, 'update'])->middleware('auth:web','checkRole:User,Admin');
Route::delete('/pajakgu/destroy/{id}', [PajakguController::class, 'destroy'])->middleware('auth:web','checkRole:User,Admin');
Route::post('/pajakgu/terima/{id}', [PajakguController::class, 'terima'])->middleware('auth:web','checkRole:User,Admin');
Route::post('/pajakgu/tolak/{id}', [PajakguController::class, 'tolak'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/tampilpajakgusipd', [PajakguController::class, 'pilihpajakgusipd'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/pajakgusipd/edit/{id}', [PajakguController::class, 'editpajakgusipd'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/pajakgu/akunpajak', [PajakguController::class, 'getDataakunpajak'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/pajakgu/jenispajak', [PajakguController::class, 'getDatajenispajak'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/pajakgu/tolakgu/{id}', [PajakguController::class, 'tolakgu'])->middleware('auth:web','checkRole:User,Admin');
Route::post('/pajakgu/tolakguupdate/{id}', [PajakguController::class, 'tolakguupdate'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/pajakgu/terimagu/{id}', [PajakguController::class, 'terimagu'])->middleware('auth:web','checkRole:User,Admin');
Route::post('/pajakgu/terimaguupdate/{id}', [PajakguController::class, 'terimaguupdate'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/pajakgu/lihat/{id}', [PajakguController::class, 'lihat'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/pajakgu/totalnilai', [PajakguController::class, 'totalpajakgu'])->middleware('auth:web','checkRole:User,Admin');

