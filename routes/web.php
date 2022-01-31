<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TipoGastoController;

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

Route::middleware('auth')->prefix('user')->group(function () {
    
    Route::put('/update/password', [UserController::class, 'updatePasswordUser'])->name('update.password.verification');
    Route::put('/information/profile', [UserController::class, 'updateInformationProfile'])->name('user.profile.information.update');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {

    
    Route::get('/user/register', [\Laravel\Fortify\Http\Controllers\RegisteredUserController::class, 'create'])->name('user.create')->middleware('permission:usuario.crear');
    Route::get('/user/update/{id}', [UserController::class, 'updateInformationUserView'])->name('user.update')->middleware('permission:usuario.editar.avanzado');

    // Route::get('/user/update/{id}', [UserController::class, 'updateView'])->name('user.update');
    Route::get('/user/list', [UserController::class, 'index'])->name('user.index')->middleware('permission:usuario.index');
    Route::post('/user/register', [UserController::class, 'create'])->name('user.create.post')->middleware('permission:usuario.crear');
    
    Route::put('/update', [UserController::class, 'update'])->name('user.update.put')->middleware('permission:usuario.editar.avanzado');
    Route::put('/user/change-password', [UserController::class, 'changePassword'])->name('user.update.password.put')->middleware('permission:usuario.editar.avanzado');
    Route::put('/user/desactive/account', [UserController::class, 'desactiveAccount'])->name('user.desactive.account')->middleware('permission:usuario.desactivar.activar');
    Route::put('/users/password/', [UserController::class, 'updatePasswordsUsers'])->name('user.passwords.update')->middleware('permission:usuario.editar.avanzado');
    Route::put('/user/information', [UserController::class, 'updateInformationUser'])->name('user.information.update')->middleware('permission:usuario.editar.avanzado');

    Route::get('/role/create', [RoleController::class, 'createView'])->name('role.create.get')->middleware('permission:rol.crear');
    Route::get('/role/update/{id}', [RoleController::class, 'updateView'])->name('role.update.get')->middleware('permission:rol.editar.avanzado');
    Route::get('/role/list', [RoleController::class, 'index'])->name('role.index')->middleware('permission:rol.index');
    Route::post('/role/register', [RoleController::class, 'create'])->name('role.create.post')->middleware('permission:rol.crear');
    Route::put('/role/update', [RoleController::class, 'update'])->name('role.update.put')->middleware('permission:rol.editar.avanzado');
    Route::post('/role/assign/', [RoleController::class, 'assignRoleToUser'])->name('role.assign.create')->middleware('permission:rol.asignar');
    Route::post('/role/revoke/', [RoleController::class, 'revokeRoleToUser'])->name('role.revoke.delete')->middleware('permission:rol.revocar');
    Route::delete('/role/delete/', [RoleController::class, 'delete'])->name('role.delete')->middleware('permission:rol.eliminar');
});

Route::middleware('auth')->prefix('cliente')->group(function () {
    
    Route::get('/register', [ClienteController::class, 'register'])->name('cliente.create')->middleware('permission:cliente.crear');
    Route::get('/update/{id}', [ClienteController::class, 'updateView'])->name('cliente.update')->middleware('permission:cliente.editar.avanzado');
    Route::get('/list', [ClienteController::class, 'index'])->name('cliente.index')->middleware('permission:cliente.index');
    Route::post('/register', [ClienteController::class, 'create'])->name('cliente.create.post')->middleware('permission:cliente.crear');
    Route::put('/update', [ClienteController::class, 'update'])->name('cliente.update.put')->middleware('permission:cliente.editar.avanzado');
});

Route::middleware('auth')->prefix('tipo/gasto')->group(function () {
    
    Route::get('/register', [TipoGastoController::class, 'register'])->name('tipo.gasto.create')->middleware('permission:tipo.gasto.crear');
    Route::get('/update/{id}', [TipoGastoController::class, 'updateView'])->name('tipo.gasto.update')->middleware('permission:tipo.gasto.editar.avanzado');
    Route::get('/list', [TipoGastoController::class, 'index'])->name('tipo.gasto.index')->middleware('permission:tipo.gasto.index');
    Route::post('/register', [TipoGastoController::class, 'create'])->name('tipo.gasto.create.post')->middleware('permission:tipo.gasto.crear');
    Route::put('/update', [TipoGastoController::class, 'update'])->name('tipo.gasto.update.put')->middleware('permission:tipo.gasto.editar.avanzado');
});

Route::get('/try', function(){

    \Spatie\Permission\Models\Permission::create([ 'name' => 'cliente.index' ]);
    \Spatie\Permission\Models\Permission::create([ 'name' => 'cliente.crear' ]);
    \Spatie\Permission\Models\Permission::create([ 'name' => 'cliente.editar.basico' ]);
    \Spatie\Permission\Models\Permission::create([ 'name' => 'cliente.editar.avanzado' ]);
    \Spatie\Permission\Models\Permission::create([ 'name' => 'cliente.eliminar' ]);

    \Spatie\Permission\Models\Permission::create([ 'name' => 'tipo.gasto.index' ]);
    \Spatie\Permission\Models\Permission::create([ 'name' => 'tipo.gasto.crear' ]);
    \Spatie\Permission\Models\Permission::create([ 'name' => 'tipo.gasto.editar.basico' ]);
    \Spatie\Permission\Models\Permission::create([ 'name' => 'tipo.gasto.editar.avanzado' ]);
    \Spatie\Permission\Models\Permission::create([ 'name' => 'tipo.gasto.eliminar' ]);
});


// Route::get('/empleado/register', [EmpleadoController::class, 'register'])->name('empleado.create')->middleware('auth');
// Route::get('/empleado/update/{id}', [EmpleadoController::class, 'updateView'])->name('empleado.update')->middleware('auth');
// Route::get('/empleado/list', [EmpleadoController::class, 'index'])->name('empleado.index')->middleware('auth');
// Route::post('/empleado/register', [EmpleadoController::class, 'create'])->name('empleado.create.post')->middleware('auth');
// Route::put('/empleado/update', [EmpleadoController::class, 'update'])->name('empleado.update.put')->middleware('auth');

// Route::get('/horario/register', [HorarioController::class, 'register'])->name('horario.create')->middleware('auth');
// Route::get('/horario/update/{id}', [HorarioController::class, 'updateView'])->name('horario.update')->middleware('auth');
// Route::get('/horario/list', [HorarioController::class, 'index'])->name('horario.index')->middleware('auth');
// Route::post('/horario/register', [HorarioController::class, 'create'])->name('horario.create.post')->middleware('auth');
// Route::put('/horario/update', [HorarioController::class, 'update'])->name('horario.update.put')->middleware('auth');
// Route::delete('/horario/delete', [HorarioController::class, 'delete'])->name('horario.delete')->middleware('auth');

// Route::get('/cobro/register', [CobroController::class, 'register'])->name('cobro.create')->middleware('auth');
// Route::get('/cobro/update/{id}', [CobroController::class, 'updateView'])->name('cobro.update')->middleware('auth');
// Route::get('/cobro/list', [CobroController::class, 'index'])->name('cobro.index')->middleware('auth');
// Route::post('/cobro/register', [CobroController::class, 'create'])->name('cobro.create.post')->middleware('auth');
// Route::put('/cobro/update', [CobroController::class, 'update'])->name('cobro.update.put')->middleware('auth');
// Route::delete('/cobro/delete', [CobroController::class, 'delete'])->name('cobro.delete')->middleware('auth');

// Route::get('/venta/register', [VentaController::class, 'register'])->name('venta.create')->middleware('auth');
