<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    /**
     * Obtiene los documentos que pertenecen al usuario logueado en la pagina principal
     */
    public function getHome(){
        $id = Auth::user()->id;
        $docs = DB::table('documentos')->where('ID_usuario', $id)->get();
        return view('welcome', ["docs" => $docs]);
    }
    /**
     * Obtiene los usuarios que no sean del tipo 1, es decir administrador
     */
    public function getUsers(){
        $users = DB::table("users")->where("tipo_usuario", "!=", "1")->get();
        return view('users', ["users" => $users]);
    }
    /**
     * Añade el usuario que se agrega mediante el form presente en views.adduser
     */
    public function addUser(Request $request){
        $nombre = request()->nombre;
        $correo = request()->correo;
        $password = \Hash::make($request->password);
        DB::table("users")->insert([
            "name" => $nombre,
            "email" => $correo,
            "password" => $password,
            "tipo_usuario" => "0"
        ]);
        return redirect()->action("HomeController@getUsers");
    }
    /**
     * Borra a un usuario de la base de datos
     */
    public function deleteUser($id){
        $user = DB::table("users")->where('id', $id)->delete();
        return redirect()->action("HomeController@getUsers");
    }
    /**
     * Selecciona a un usuario dentro de las tablas y envía a la vista views.edituser
     */
    public function editUser($id){
        $user = DB::table("users")->where('id', $id)->first();
        return view("edituser", ["user" => $user]);
    }
    /**
     * Toma la información del form de views.edituser y actualiza la tabla users de la base de datos luego redirige a la pagina de usuarios
     */
    public function updateUser(Request $request){
        $id = request()->id;
        $nombre = request()->nombre;
        $correo = request()->correo;
        $password = \Hash::make($request->password);
        $user = DB::table("users")->where('id', $id)->update([
            "name" => $nombre,
            "email" => $correo,
            "password" => $password,
        ]);
        return redirect()->action("HomeController@getUsers");
    }
}
