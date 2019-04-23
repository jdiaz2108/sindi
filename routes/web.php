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

Route::get('/home', 'HomeController@index')->name('home');



Route::get('/foo', function () {
	$user = App\User::find(1)->firstOrFail();
        \Mail::send('email.recoveryPass', compact('user'), function ($message) {
        $message->from('jdiaz2108@hotmail.com', 'StarmundoColombia');
        $message->to('jdiaz2108@hotmail.com')->subject('Contacto StarmundoColombia');
    });
});

Route::view('/foo2', 'vendor.notifications.email');

//In - Todas las Solicitudes Ajax, estos componentes son los solicitados por Vue
Route::get('/Data/getCity/{id}', 'VueController@getCity');
Route::get('/Data/allDepartament', 'VueController@allDepartaments');
Route::get('/Data/allAcademicLevel', 'VueController@allAcademicLevel');
Route::get('/Data/allCivilStatus', 'VueController@tiposCivilStatus');
Route::get('/Data/allProfession', 'VueController@tiposProfession');
Route::get('/Data/getProfession/{id}', 'VueController@getProfession');
Route::get('/Data/allPositions', 'VueController@allPositions');
Route::get('/Data/getPosition/{id}', 'VueController@getPosition');
Route::get('/Data/getDepend/{id}', 'VueController@getDepend');
Route::get('/Data/AllAfp', 'VueController@AllAfp');
Route::get('/Data/AllCcf', 'VueController@AllCcf');
Route::get('/Data/AllArl', 'VueController@AllArl');
Route::get('/Data/AllEps', 'VueController@AllEps');
Route::get('/Data/tiposDocumento', 'VueController@tiposDocumento');

Route::get('/Data/getEmergencyContacts/{id}', 'VueController@getEmergencyContacts');
Route::get('/Data/getChildrens/{id}', 'VueController@getChildrens');
//Fn - Todas las Solicitudes Ajax, estos componentes son los solicitados por Vue

Route::resource('/Ec', 'EmergencyContactController');

Route::resource('/Child', 'ChildrenController');

//In - Solicitud Ajax Inicio de Sesion para obtener credenciales de usuario
Route::get('/getCorreo/{id}', 'VueController@getCorreo');
//Fn - Solicitud Ajax Inicio de Sesion para obtener credenciales de usuario
Route::get('/prueba', 'UserController@updateStatus');


//In - Rutan con el Middleware para la Autenticacion
Route::group(['middleware' => ['auth']], function () {

	Route::resource('/permisos', 'PermisosController');

	Route::resource('/map', 'MapGeoController');

	Route::resource('/', 'MapGeoController');

	//In - Ruta CRUD relacionada con Empleados
	Route::resource('/Em', 'EmployeeControler');
	//Fn - Ruta CRUD relacionada con Empleados


	//In Actualización de contraseña esta habilitada para todos los Usuarios
	Route::put('/U/{id}/updatePassword', 'UserController@updatePassword');


	//Fn Actualización de contraseña esta habilitada para todos los Usuarios
	Route::get('/pysEstado', 'PysController@estado');

	Route::group(['middleware' => ['admin']], function () {

		//In - Ruta CRUD relacionada con Usuarios
		Route::resource('/U', 'UserController');
		//Fn - Ruta CRUD relacionada con Usuarios
		Route::get('/pys/{id}/create', 'PysController@create');
		Route::resource('/pys', 'PysController');
	});

	Route::get('/background', function() {
		return view('bg');
	});

	Route::get('/getReport', 'MapGeoController@getReport');

});
//Fn - Rutan con el Middleware para la Autenticacion

Auth::routes();