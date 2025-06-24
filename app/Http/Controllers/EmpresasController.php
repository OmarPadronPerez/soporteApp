<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpresasController extends Controller
{
    public function index(Request $request)
    {
        $orden = $request->input('orden', 'asc');

        $datos = DB::table('empresas')
            ->select('id', 'nombre', 'activo')
            ->orderBy('nombre',  $orden)
            //->paginate(10);
            ->get();
        //return view('verEmpresas')->with('datos', $datos);
        return View('verEmpresas', compact('datos'));
    }

    public function nuevaEmpresa(Request $request)
    {
        return view('nuevaEmpresa');
    }

    public function store(Request $request)
    {
        $activo = $request->has('activo') ? 1 : 0;

        $datos = [
            'nombre' => $request->nombre,
            'activo' => $activo,
            'usuario'=> $request->usuario,
            'contrasena'=> $request->contrasena,
            'base_de_datos'=> $request->base_de_datos,
        ];        
        $guardado = Empresas::create($datos);

        if (!$guardado) {
            return redirect()->back()->with('falla', 'falla al guardar');
        } else {
            return redirect('empresas');
        }
    }


    public function update(Request $request)
    {
    
        $activo = $request->has('activo') ? 1 : 0;

        $datos = [
            'activo' => $activo,
            'usuario'=> $request->usuario,
            'contrasena'=> $request->contrasena,
            'base_de_datos'=> $request->base_de_datos,
        ];      
         

        $guardado = Empresas::where('id', $request->id)
            ->update($datos);
        
        return redirect('empresas');
    }

    public function verEmpresa(Request $request)
    {
        $datos = DB::table('empresas')
            ->where('id', $request->id)
            ->get();

        return view('empresa', compact('datos'));
    }
}
