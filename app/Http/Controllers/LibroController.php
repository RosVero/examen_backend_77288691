<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use DB;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libros = Libro::all();
        return $libros;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $libro = new Libro();
        $libro->titulo = $request->titulo;
        $libro->autor_id = $request->autor_id;
        $libro->lote = $request->lote;
        $libro->description = $request->description;

        $libro->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $libro =  Libro::find($id);
        return $libro;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $libro = Libro::findOrFail($request->id);
        $libro->titulo = $request->titulo;
        $libro->autor_id = $request->autor_id;
        $libro->lote = $request->lote;
        $libro->description = $request->description;
        $libro->save();

        return $libro;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $libro = Libro::destroy($request->id);
        return $libro;
    }

        /**
     *Listado de libros con autor de manera literal
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function libros_autor()
    {
        $libros = DB::table('libros')->join('autors', 'libros.autor_id', '=', 'autors.id')->select(DB::raw('libros.id as id, libros.titulo as titulo, autors.name as autor, libros.lote as lote, libros.description as description'))->get();

        return $libros;
    }

    public function libros_sin_prestamo()
    {
        $libros = DB::table('prestamos')->join('libros', 'prestamos.libro_id', '=', 'libros.id')->select(DB::raw('libros.id as id, libros.titulo as titulo, libros.lote as lote, libros.description as description'))->where('prestamos.estado', '!=', 'En Prestamo')->get();

        return $libros;
    }

}
