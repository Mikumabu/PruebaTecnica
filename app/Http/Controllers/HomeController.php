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

    public function getHome(){
        $id = Auth::user()->id;
        $docs = DB::table('documentos')->where('ID_usuario', $id)->get();
        return view('welcome', ["docs" => $docs]);
    }

    public function getUsers(){
        $users = DB::table("users")->where("tipo_usuario", "!=", "1")->get();
        return view('users', ["users" => $users]);
    }

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

    public function deleteUser($id){
        $user = DB::table("users")->where('id', $id)->delete();
        return redirect()->action("HomeController@getUsers");
    }

    public function editUser($id){
        $user = DB::table("users")->where('id', $id)->first();
        return view("edituser", ["user" => $user]);
    }

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
