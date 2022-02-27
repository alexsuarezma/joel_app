<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TipoGastoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\SectorLoteController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\ProduccionController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\EmpleadoController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportesController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

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

    Route::get('/balance/final', [ReportesController::class, 'reporteBalanceFinal'])->name('reports.balance.general.get');//->middleware('permission:rol.editar.avanzado');
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

Route::middleware('auth')->prefix('producto')->group(function () {
    
    Route::get('/register', [ProductoController::class, 'register'])->name('producto.create')->middleware('permission:producto.crear');
    Route::get('/update/{id}', [ProductoController::class, 'updateView'])->name('producto.update')->middleware('permission:producto.editar.avanzado');
    Route::get('/list', [ProductoController::class, 'index'])->name('producto.index')->middleware('permission:producto.index');
    Route::post('/register', [ProductoController::class, 'create'])->name('producto.create.post')->middleware('permission:producto.crear');
    Route::put('/update', [ProductoController::class, 'update'])->name('producto.update.put')->middleware('permission:producto.editar.avanzado');
});

Route::middleware('auth')->prefix('sector')->group(function () {
    
    Route::get('/register', [SectorLoteController::class, 'register'])->name('sector.create')->middleware('permission:sector.crear');
    Route::get('/update/{id}', [SectorLoteController::class, 'updateView'])->name('sector.update')->middleware('permission:sector.editar.avanzado');
    Route::get('/list', [SectorLoteController::class, 'index'])->name('sector.index')->middleware('permission:sector.index');
    Route::post('/register', [SectorLoteController::class, 'create'])->name('sector.create.post')->middleware('permission:sector.crear');
    Route::put('/update', [SectorLoteController::class, 'update'])->name('sector.update.put')->middleware('permission:sector.editar.avanzado');
    Route::put('/update/vigencia', [SectorLoteController::class, 'updateVigencia'])->name('sector.update.vigencia.put')->middleware('permission:sector.eliminar');
    
});

Route::middleware('auth')->prefix('lote')->group(function () {
    
    Route::get('/register', [SectorLoteController::class, 'register'])->name('lote.create')->middleware('permission:lote.crear');
    Route::get('/update/{id}', [SectorLoteController::class, 'updateView'])->name('lote.update')->middleware('permission:lote.editar.avanzado');
    Route::get('/list', [SectorLoteController::class, 'index'])->name('lote.index')->middleware('permission:lote.index');
    Route::post('/register', [SectorLoteController::class, 'create'])->name('lote.create.post')->middleware('permission:lote.crear');
    Route::put('/update', [SectorLoteController::class, 'update'])->name('lote.update.put')->middleware('permission:lote.editar.avanzado');
    Route::put('/update/vigencia', [SectorLoteController::class, 'updateVigencia'])->name('lote.update.vigencia.put')->middleware('permission:lote.eliminar');
});

Route::middleware('auth')->prefix('gasto')->group(function () {
    
    Route::get('/register', [GastoController::class, 'register'])->name('gasto.create')->middleware('permission:gasto.crear');
    Route::get('/update/{id}', [GastoController::class, 'updateView'])->name('gasto.update')->middleware('permission:gasto.editar.avanzado');
    Route::get('/list', [GastoController::class, 'index'])->name('gasto.index')->middleware('permission:gasto.index');
    Route::post('/register', [GastoController::class, 'create'])->name('gasto.create.post')->middleware('permission:gasto.crear');
    Route::put('/update', [GastoController::class, 'update'])->name('gasto.update.put')->middleware('permission:gasto.editar.avanzado');
    Route::put('/anular', [GastoController::class, 'anular'])->name('gasto.anular.put')->middleware('permission:gasto.eliminar');

    Route::post('/print/report', [GastoController::class, 'printReportToPdf'])->name('gasto.print.report.post');
    Route::get('/print/document/{id}', [GastoController::class, 'printDocumentToPdf'])->name('gasto.print.document.get');
});

Route::middleware('auth')->prefix('produccion')->group(function () {
    
    Route::get('/register', [ProduccionController::class, 'register'])->name('produccion.create')->middleware('permission:produccion.crear');
    Route::get('/update/{id}', [ProduccionController::class, 'updateView'])->name('produccion.update')->middleware('permission:produccion.editar.avanzado');
    Route::get('/list', [ProduccionController::class, 'index'])->name('produccion.index')->middleware('permission:produccion.index');
    Route::post('/register', [ProduccionController::class, 'create'])->name('produccion.create.post')->middleware('permission:produccion.crear');
    Route::put('/update', [ProduccionController::class, 'update'])->name('produccion.update.put')->middleware('permission:produccion.editar.avanzado');
    Route::put('/anular', [ProduccionController::class, 'anular'])->name('produccion.anular.put')->middleware('permission:produccion.eliminar');

    Route::post('/print/report', [ProduccionController::class, 'printReportToPdf'])->name('produccion.print.report.post');
    Route::get('/print/document/{id}', [ProduccionController::class, 'printDocumentToPdf'])->name('produccion.print.document.get');
});

Route::middleware('auth')->prefix('venta')->group(function () {
    
    Route::get('/register', [VentaController::class, 'register'])->name('venta.create')->middleware('permission:venta.crear');
    Route::get('/update/{id}', [VentaController::class, 'updateView'])->name('venta.update')->middleware('permission:venta.editar.avanzado');
    Route::get('/list', [VentaController::class, 'index'])->name('venta.index')->middleware('permission:venta.index');
    Route::post('/register', [VentaController::class, 'create'])->name('venta.create.post')->middleware('permission:venta.crear');
    Route::put('/update', [VentaController::class, 'update'])->name('venta.update.put')->middleware('permission:venta.editar.avanzado');
    Route::put('/anular', [VentaController::class, 'anular'])->name('venta.anular.put')->middleware('permission:venta.eliminar');

    Route::post('/print/report', [VentaController::class, 'printReportToPdf'])->name('venta.print.report.post');
    Route::get('/print/document/{id}', [VentaController::class, 'printDocumentToPdf'])->name('venta.print.document.get');
});

Route::middleware('auth')->prefix('empleado')->group(function () {

    Route::get('/register', [EmpleadoController::class, 'register'])->name('empleado.create')->middleware('permission:empleado.crear');
    Route::get('/update/{id}', [EmpleadoController::class, 'updateView'])->name('empleado.update')->middleware('permission:empleado.editar.avanzado');
    Route::get('/list', [EmpleadoController::class, 'index'])->name('empleado.index')->middleware('permission:empleado.index');
    Route::post('/register', [EmpleadoController::class, 'create'])->name('empleado.create.post')->middleware('permission:empleado.crear');
    Route::put('/update', [EmpleadoController::class, 'update'])->name('empleado.update.put')->middleware('permission:empleado.editar.avanzado');
});



Route::get('/try', function(){

    // \Spatie\Permission\Models\Permission::create([ 'name' => 'cliente.index' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'cliente.crear' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'cliente.editar.basico' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'cliente.editar.avanzado' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'cliente.eliminar' ]);

    // \Spatie\Permission\Models\Permission::create([ 'name' => 'tipo.gasto.index' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'tipo.gasto.crear' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'tipo.gasto.editar.basico' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'tipo.gasto.editar.avanzado' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'tipo.gasto.eliminar' ]);

    // \Spatie\Permission\Models\Permission::create([ 'name' => 'producto.index' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'producto.crear' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'producto.editar.basico' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'producto.editar.avanzado' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'producto.eliminar' ]);

    // \Spatie\Permission\Models\Permission::create([ 'name' => 'sector.index' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'sector.crear' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'sector.editar.basico' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'sector.editar.avanzado' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'sector.eliminar' ]);

    // \Spatie\Permission\Models\Permission::create([ 'name' => 'lote.index' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'lote.crear' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'lote.editar.basico' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'lote.editar.avanzado' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'lote.eliminar' ]);
    
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'gasto.index' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'gasto.crear' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'gasto.editar.basico' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'gasto.editar.avanzado' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'gasto.eliminar' ]);

    // \Spatie\Permission\Models\Permission::create([ 'name' => 'produccion.index' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'produccion.crear' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'produccion.editar.basico' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'produccion.editar.avanzado' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'produccion.eliminar' ]);

    // \Spatie\Permission\Models\Permission::create([ 'name' => 'venta.index' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'venta.crear' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'venta.editar.basico' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'venta.editar.avanzado' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'venta.eliminar' ]);
    
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'empleado.index' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'empleado.crear' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'empleado.editar.basico' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'empleado.editar.avanzado' ]);
    // \Spatie\Permission\Models\Permission::create([ 'name' => 'empleado.eliminar' ]);
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
