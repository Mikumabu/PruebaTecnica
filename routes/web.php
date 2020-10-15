<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', "HomeController@getHome")->name("welcome");

Auth::routes();
//Rutas que solo puede acceder un usuario logueado y, combinado con los blade, solo puede ser administrador
Route::group(['middleware' => 'auth'], function(){
    Route::get('/admin', function(){
        return view("admin");
    })->name("admin");
    // Rutas referentes al usuario
    ///Ruta del index de usuarios
    Route::get('/users', 'HomeController@getUsers')->name('user');
    //Ruta de CRUD
    Route::get('/users/adduser', function(){
        return view("adduser");
    })->name('adduser');
    Route::get('/users/deleteuser/{id}', "HomeController@deleteUser")->name('deleteuser');
    Route::get('/users/{id}/edituser', "HomeController@editUser")->name('edituser');
    Route::post("/ingresarFormulario", "HomeController@addUser")->name("ingresarFormulario");
    Route::post("/users", "HomeController@updateUser")->name("editarFormulario");
    
    //Rutas referentes a la documentacion
    
    Route::get("/docs", "DocumentoController@index")->name("docs");
    //CRUD de documentos
    Route::get("/docs/adddoc", function(){
        return view("adddocument");
    })->name("adddoc");
    Route::post("ingresarDocumento", "DocumentoController@store")->name("ingresarDocumento");
    Route::get('/docs/GetNombre', 'DocumentoController@getNombre')->name('GetNombre');
    Route::get('/docs/deletedoc/{id}', "DocumentoController@destroy")->name('deletedoc');
});


