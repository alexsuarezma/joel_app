<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CobroController;
use App\Http\Controllers\VentaController;

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

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/register', [\Laravel\Fortify\Http\Controllers\RegisteredUserController::class, 'create'])->name('user.create')->middleware('auth');
Route::get('/user/update/{id}', [UserController::class, 'updateView'])->name('user.update')->middleware('auth');
Route::get('/user/list', [UserController::class, 'index'])->name('user.index')->middleware('auth');
Route::post('/user/register', [UserController::class, 'create'])->name('user.create.post')->middleware('auth');
Route::put('/update', [UserController::class, 'update'])->name('user.update.put')->middleware('auth');
Route::put('/user/change-password', [UserController::class, 'changePassword'])->name('user.update.password.put')->middleware('auth');


Route::get('/empleado/register', [EmpleadoController::class, 'register'])->name('empleado.create')->middleware('auth');
Route::get('/empleado/update/{id}', [EmpleadoController::class, 'updateView'])->name('empleado.update')->middleware('auth');
Route::get('/empleado/list', [EmpleadoController::class, 'index'])->name('empleado.index')->middleware('auth');
Route::post('/empleado/register', [EmpleadoController::class, 'create'])->name('empleado.create.post')->middleware('auth');
Route::put('/empleado/update', [EmpleadoController::class, 'update'])->name('empleado.update.put')->middleware('auth');

Route::get('/horario/register', [HorarioController::class, 'register'])->name('horario.create')->middleware('auth');
Route::get('/horario/update/{id}', [HorarioController::class, 'updateView'])->name('horario.update')->middleware('auth');
Route::get('/horario/list', [HorarioController::class, 'index'])->name('horario.index')->middleware('auth');
Route::post('/horario/register', [HorarioController::class, 'create'])->name('horario.create.post')->middleware('auth');
Route::put('/horario/update', [HorarioController::class, 'update'])->name('horario.update.put')->middleware('auth');
Route::delete('/horario/delete', [HorarioController::class, 'delete'])->name('horario.delete')->middleware('auth');

Route::get('/cliente/register', [ClienteController::class, 'register'])->name('cliente.create')->middleware('auth');
Route::get('/cliente/update/{id}', [ClienteController::class, 'updateView'])->name('cliente.update')->middleware('auth');
Route::get('/cliente/list', [ClienteController::class, 'index'])->name('cliente.index')->middleware('auth');
Route::post('/cliente/register', [ClienteController::class, 'create'])->name('cliente.create.post')->middleware('auth');
Route::put('/cliente/update', [ClienteController::class, 'update'])->name('cliente.update.put')->middleware('auth');

Route::get('/cobro/register', [CobroController::class, 'register'])->name('cobro.create')->middleware('auth');
Route::get('/cobro/update/{id}', [CobroController::class, 'updateView'])->name('cobro.update')->middleware('auth');
Route::get('/cobro/list', [CobroController::class, 'index'])->name('cobro.index')->middleware('auth');
Route::post('/cobro/register', [CobroController::class, 'create'])->name('cobro.create.post')->middleware('auth');
Route::put('/cobro/update', [CobroController::class, 'update'])->name('cobro.update.put')->middleware('auth');
Route::delete('/cobro/delete', [CobroController::class, 'delete'])->name('cobro.delete')->middleware('auth');

Route::get('/venta/register', [VentaController::class, 'register'])->name('venta.create')->middleware('auth');
