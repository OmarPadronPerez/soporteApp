<?php

namespace App\Http\Controllers;

use App\Exports\MultiSheetExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $now = Carbon::now();
        $datos = "";
        $nInicio= date_format($now, 'Y') . "-" . date_format($now, 'm') . "-01";
        $nFin=date_format($now->endOfMonth(), "Y-m-d");

        $fInicio =$request->input('fecha_inicio',$nInicio);
        $fFin = $request->input('fecha_fin',$nFin);

        //$datos=Ticket::whereBetween('created_at',[$fInicio,$fFin])->get();
        $datos = DB::table('tickets')
        ->whereBetween('tickets.created_at',[$fInicio,$fFin])
        ->leftJoin('users as creador', 'tickets.creador_id', '=', 'creador.id')
        ->leftJoin('users as resuelto', 'tickets.resuelto_id', '=', 'resuelto.id')
        ->select('tickets.*', 
                'creador.name as creador_name','creador.lastName as creador_lastName',
                'resuelto.name as resuelto_name','resuelto.lastName as resuelto_lastName')
                ->orderBy('created_at','asc')
        ->get();
        
        //return $datos;
        //return view('verReportes')->with('datos', $datos);
        return view('verReportes',compact('datos','fInicio','fFin'));
    }


    public function export(Request $request){
        /*$fInicio=$request->query('inicio');
        $fFin=$request->query('fin');
        
        $datos = DB::table('tickets')
        ->whereBetween('tickets.created_at',[$fInicio,$fFin])
        ->leftJoin('users as creador', 'tickets.creador_id', '=', 'creador.id')
        ->leftJoin('users as resuelto', 'tickets.resuelto_id', '=', 'resuelto.id')
        ->select('tickets.*', 
                'creador.name as creador_name','creador.lastName as creador_lastName',
                'resuelto.name as resuelto_name','resuelto.lastName as resuelto_lastName')
                ->orderBy('created_at','asc')
        ->get()->toArray();*/
        $fInicio = $request->inicio;
        $fFin = $request->fin;
        $nombre='incidencias '.date('d-m-Y', strtotime($fInicio)).' '.date('d-m-Y', strtotime($fFin));


        return Excel::download(new MultiSheetExport($fInicio,$fFin), $nombre.'.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
