<?php

use App\Models\Pagina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\MotorizadoController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\TimeSeriesController;
use App\Http\Controllers\ChangePasswordController;
use App\Models\Cita;
use App\Models\User;

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


Route::group(['middleware' => 'auth'], function () {

    Route::get('/statistics/getServiceCount/{range}', [StatisticsController::class, 'getServiceCounts']);
    Route::get('/statistics/getIncomePrediction', [StatisticsController::class, 'getIncomePrediction']);
    Route::get('/statistics/getStockturn', [StatisticsController::class, 'getStockturn']);
    Route::get('/statistics/getMixCitaRot', [StatisticsController::class, 'getMixCitaRot']);


	Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		$pagina = Pagina::where('nombre_pagina', 'dashboard')->first();
		$pagina->contador = $pagina->contador + 1;
		$pagina->save();
		$citas_completadas = Cita::where('estado', 'Completada')->count();
        $citas_pendientes = Cita::where('estado', 'Pendiente')->count();
        $citas_proceso = Cita::where('estado', 'En Proceso')->count();
        $usuarios = User::count();
		return view('dashboard', compact('pagina', 'citas_completadas', 'citas_pendientes', 'citas_proceso', 'usuarios'));
	})->name('dashboard');

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('user-management', function () {
		return view('laravel-examples/user-management');
	})->name('user-management');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

	Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

	Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

	Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

	Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
	Route::get('/login', function () {
		$pagina = Pagina::where('nombre_pagina', 'dashboard')->first();
		$pagina->contador = $pagina->contador + 1;
		$pagina->save();
		$citas_completadas = Cita::where('estado', 'Completada')->count();
        $citas_pendientes = Cita::where('estado', 'Pendiente')->count();
        $citas_proceso = Cita::where('estado', 'En Proceso')->count();
        $usuarios = User::count();
		return view('dashboard', compact('pagina', 'citas_completadas', 'citas_pendientes', 'citas_proceso', 'usuarios'));
	})->name('sign-up');

	Route::resource('usuarios', UserController::class)->names('usuarios');
	Route::get('/pdf-users', [UserController::class, 'generatePDF'])->name('usuarios.generatePDF');
	Route::resource('perfil', PerfilController::class)->names('perfil');
	Route::resource('proveedores', ProveedorController::class)->names('proveedores');
	Route::get('/pdf-proveedores', [ProveedorController::class, 'generatePDF'])->name('proveedores.generatePDF');
	Route::resource('insumos', InsumoController::class)->names('insumos');
	Route::get('/pdf-insumos', [InsumoController::class, 'generatePDF'])->name('insumos.generatePDF');
	Route::resource('motorizados', MotorizadoController::class)->names('motorizados');
	Route::get('/pdf-motorizados', [MotorizadoController::class, 'generatePDF'])->name('motorizados.generatePDF');
	Route::resource('inventarios', InventarioController::class)->names('inventarios');
	Route::get('/pdf-inventarios', [InventarioController::class, 'generatePDF'])->name('inventarios.generatePDF');
	Route::resource('servicios', ServicioController::class)->names('servicios');
	Route::get('/pdf-servicios', [ServicioController::class, 'generatePDF'])->name('servicios.generatePDF');
	Route::resource('citas', CitaController::class)->names('citas');
	Route::get('/pdf-citas', [CitaController::class, 'generatePDF'])->name('citas.generatePDF');
	Route::post('/citas/{cita}/add-insumo', [CitaController::class, 'addInsumo'])->name('citas.add-insumo');
	Route::post('/citas/{cita}/add-servicio', [CitaController::class, 'addServicio'])->name('citas.add-servicio');
	Route::delete('/citas/{cita}/delete-insumo/{insumo}', [CitaController::class, 'deleteInsumo'])->name('citas.delete-insumo');
	Route::delete('/citas/{cita}/delete-servicio/{servicio}', [CitaController::class, 'deleteServicio'])->name('citas.delete-servicio');
	Route::get('/pagos', [PagoController::class, 'index'])->name('pagos.index');
	Route::get('/pagos/{cita}/show', [PagoController::class, 'show'])->name('pagos.show');
	Route::post('/pagos/{cita}/pagos', [PagoController::class, 'qr'])->name('pagos.qr');
	Route::get('/pdf-pagos', [PagoController::class, 'generatePDF'])->name('pagos.generatePDF');
	Route::delete('/pagos/{pago}/delete', [PagoController::class, 'destroy'])->name('pagos.destroy');
	Route::get('/pdf-pagos/{pago}/', [PagoController::class, 'generateDetallePDF'])->name('pagos.generateDetallePDF');

});



Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', [SessionsController::class, 'create']);
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/login', function () {
	$pagina = Pagina::where('nombre_pagina', 'login')->first();
	$pagina->contador = $pagina->contador + 1;
	$pagina->save();
	return view('session/login-session', compact('pagina'));
})->name('login');


use App\Http\Controllers\VentaController;

Route::resource('ventas', VentaController::class);


use App\Http\Controllers\ProductoController;

Route::get('productos/generate-pdf', [ProductoController::class, 'generatePDF'])->name('productos.generatePDF');
Route::resource('productos', ProductoController::class);

use App\Http\Controllers\PromocionController;

Route::get('promociones/generate-pdf', [PromocionController::class, 'generatePDF'])->name('promociones.generatePDF');
Route::resource('promociones', PromocionController::class);


Route::get('/statistics/sales-history', [StatisticsController::class, 'getSalesHistory']);
Route::get('/statistics/inventory-movements', [StatisticsController::class, 'getInventoryMovements']);
