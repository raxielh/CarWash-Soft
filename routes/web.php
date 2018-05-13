<?php

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
    return redirect('/login');
});

Auth::routes();

Route::get('/register', function () {
    return redirect('/login');
});

Route::get('/home', 'HomeController@index');

Route::resource('roles', 'RolesController');

Route::resource('usuariosRols', 'UsuariosRolController');

Route::resource('usuarios', 'UsuariosController');

Route::resource('estados', 'EstadosController');

Route::resource('tipoConceptos', 'TipoConceptosController');

Route::resource('conceptos', 'ConceptosController');

Route::resource('permisos', 'PermisosController');

Route::resource('valoresConceptos', 'ValoresConceptoController');

Route::resource('tipoIdentificacions', 'TipoIdentificacionController');

Route::resource('personas', 'PersonasController');

Route::resource('combos', 'CombosController');

Route::resource('vehiculos', 'VehiculosController');

Route::resource('galeriaVehiculos', 'GaleriaVehiculosController');

Route::resource('galeriaVehiculos', 'GaleriaVehiculosController');

Route::resource('equipos', 'EquiposController');

Route::resource('estadoFacturas', 'EstadoFacturaController');

Route::resource('estadoComandas', 'EstadoComandaController');

Route::resource('descuentos', 'DescuentoController'); 

Route::resource('proveedores', 'ProveedoresController');

Route::resource('combos', 'CombosController');

Route::resource('comandas', 'ComandaController');
Route::get('comandas_h/','ComandaController@historial');
Route::get('comandas_h_s/{comanda}','ComandaController@show2');

Route::get('comandas/concepto_valor/{comanda}',["as" => "concepto_valor", "uses" => "ComandaController@valor_concepto"] );
Route::get('comandas/valor_concepto_descuento/{comanda}',["as" => "valor_concepto_descuento", "uses" => "ComandaController@valor_concepto_descuento"] );

Route::get('comandas/facturar/{comanda}',["as" => "facturar", "uses" => "ComandaController@facturar"] );

Route::resource('lavados', 'LavadoController');

Route::resource('comandaDetalles', 'ComandaDetalleController');

Route::resource('equipoPersonas', 'EquipoPersonasController');

Route::resource('marcas', 'MarcaController');

Route::resource('lineas', 'LineaController');
Route::get('lineas_marca/{marca}','LineaController@marca');

Route::resource('remisions', 'RemisionController');

Route::resource('configuracions', 'ConfiguracionController');

Route::resource('administrativos', 'AdministrativoController');