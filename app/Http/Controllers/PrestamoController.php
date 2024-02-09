<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamos;
use Carbon\Carbon;
use DB;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestamos = Prestamos::all();
        return $prestamos;
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
        $prestamo = new Prestamos();
        $prestamo->libro_id = $request->libro_id;
        $prestamo->cliente_id = $request->cliente_id;
        $prestamo->fecha_prestamo = $request->fecha_prestamo;
        $prestamo->dias_prestamo = $request->dias_prestamo;
        $prestamo->estado = $request->estado;

        $prestamo->save();
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
        $prestamo =  Prestamos::find($id);
        return $prestamo;
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
        $prestamo = Prestamos::findOrFail($request->id);
        $prestamo->libro_id = $request->libro_id;
        $prestamo->cliente_id = $request->cliente_id;
        $prestamo->fecha_prestamo = $request->fecha_prestamo;
        $prestamo->dias_prestamo = $request->dias_prestamo;
        $prestamo->estado = $request->estado;

        $prestamo->save();

        return $prestamo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $prestamo = Prestamos::destroy($request->id);
        return $prestamo;
    }

    /**
     * Metodo para reporte 1
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function libros_vencidos()
    {
        $hoy = Carbon::today();

        $prestamos = DB::table('prestamos')->join('clientes', 'prestamos.cliente_id', '=', 'clientes.id')->join('libros', 'prestamos.libro_id', '=', 'libros.id')->select(DB::raw('clientes.name as cliente, libros.titulo as libro, prestamos.fecha_prestamo, prestamos.dias_prestamo, DATE_ADD(prestamos.fecha_prestamo, INTERVAL prestamos.dias_prestamo DAY) as vencimiento, DATEDIFF(CURRENT_DATE, DATE_ADD(prestamos.fecha_prestamo, INTERVAL prestamos.dias_prestamo DAY)) as demora'))->whereDate(DB::raw('DATE_ADD(prestamos.fecha_prestamo, INTERVAL prestamos.dias_prestamo DAY)'), '<', $hoy)->where('prestamos.estado','=', 'En Prestamo')->get();

        return $prestamos;
        
     }

             /**
     * Devuelve lista de prestamos con clientes y autores
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function prestamos_libro_autor()
    {
        $prestamos = DB::table('prestamos')->join('clientes', 'prestamos.cliente_id', '=', 'clientes.id')->join('libros','prestamos.libro_id', '=', 'libros.id')->select(DB::raw('prestamos.id as id, clientes.name as cliente, libros.titulo as libro, prestamos.fecha_prestamo as fecha_prestamo, prestamos.dias_prestamo as dias_prestamo, prestamos.estado as estado'))->orderBy('prestamos.fecha_prestamo', 'desc')->get();

        return $prestamos;
    }

    /**
     * Devuelve los prestamos en un determinado rango de fechas
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function prestamos_rango(Request $request)
    {
        $inicio = date($request->inicio);
        $fin = date($request->fin);

        // $inicio = date('2021-05-01');
        // $fin = date('2022-05-01');

        $prestamos = DB::table('prestamos')->join('clientes', 'prestamos.cliente_id', '=', 'clientes.id')->join('libros','prestamos.libro_id', '=', 'libros.id')->select(DB::raw('prestamos.id as id, clientes.name as cliente, libros.titulo as libro, prestamos.fecha_prestamo as fecha_prestamo, prestamos.dias_prestamo as dias_prestamo, prestamos.estado as estado'))->whereBetween('prestamos.fecha_prestamo', [$inicio, $fin])->orderBy('prestamos.fecha_prestamo', 'desc')->get();

        return $prestamos;
    }
}
