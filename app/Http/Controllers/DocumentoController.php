<?php

namespace App\Http\Controllers;
use DB;

use App\Documento;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    /**
     * Muestra la lista de documentos es views.documents.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docs = DB::table("documentos")->get();
        return view('documents', ["docs" => $docs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Guarda en la base de datos un nuevo documento que está relacionado a un usuario existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = request()->nombre;
        $nombre = request()->docto;
        DB::table("documentos")->insert([
            "ID_usuario" => $id,
            "nombre_documento" => $nombre,
        ]);
        return redirect()->action("DocumentoController@index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function show(Documento $documento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function edit(Documento $documento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Documento $documento)
    {
        //
    }

    /**
     * Elimina un documento de la base de datos que está relacionado a un usuario existente.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $docto = DB::table("documentos")->where('id', $id)->delete();
        return redirect()->action("DocumentoController@index");
    }

    /**
     * Función que se llama en javascript, permite poblar la lista de usuarios en views.adddocument con los nombres de los usuarios y sus respectivas ids de la base de datos
     */

    public function getNombre(){
        $datas = DB::table('users')->where("tipo_usuario", "!=", "1")->get();
        $output = '<option value="">Seleccione un usuario</option>';
        foreach($datas as $data){
            $output .= '<option value="'.$data->id.'">'.$data->name.'</option>';
        }
        echo $output;
    }
}
