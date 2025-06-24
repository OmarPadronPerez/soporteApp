<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;



class UsuarioController extends Controller
{
    public function index()
    {
        return view('nuevoUsuario');
    }

    public function verUsuarios(Request $request)
    {
        $orden = $request->input('orden', 'name');
        $info = [
            'id',
            'name',
            'lastName',
            'lastName2',
            'area',
            'activo',
            'updated_at',
            'administrador',
            'extencion',
            'correo'
        ];

        if (Session::get('administrador')) {
            $datos = DB::table('users')
                ->select($info)
                ->orderBy($orden, 'asc')
                ->paginate(20); //->get();
        } else {
            $datos = DB::table('users')
                ->select($info)
                ->where('activo', 1)
                ->orderBy($orden, 'asc')
                ->paginate(20); //->get();
        }

        //return $datos;

        return view('usuarios')->with('datos', $datos);
    }

    public function store(Request $request)
    {
        $mensaje = [];
        $datos = $request->all();
        $datos["password"] = $datos["pass_servidor"];
        $base = DB::table('users')
            ->select('id', 'name', 'lastName')
            ->where('id', $datos['id'])
            ->orWhere('correo', $datos['correo'])
            ->orWhere('user_vpn', $datos['user_vpn'])
            ->orWhere('user_servidor', $datos['user_servidor'])
            ->get();
        if ($base->isNotEmpty()) {
            $texto = 'se encontraron similitudes con: ';
            foreach ($base as $usr) {
                $texto = $texto . $usr->id . ' ' . $usr->name .' '.$usr->lastName;
            }
            $mensaje = [
                'titulo' => 'Error al guardar',
                'mensaje' => $texto,
                'estado' => 'falla'
            ];
            return back()->with('mensaje', $mensaje)->withInput();
        } else {
            User::create($datos);
            return redirect('usuarios');
        }
    }

    public function actUsuario($id)
    {
        $datos = DB::table('users')
            ->where('id', $id)
            ->get();
        $datos[0]->id = $id;

        return view('actUsuario')->with('datos', $datos);
    }

    public function gUsuario(Request $request)
    {
        $datos = $request->all();
        $now = new \DateTime();
        if (!isset($datos['administrador'])) {
            $datos['administrador'] = 0;
        }
        $actualizar = array(
            'administrador' => $datos['administrador'],
            'pass_vpn' => $datos['pass_vpn'],
            'pass_pc' => $datos['pass_pc'],
            'pass_correo' => $datos['pass_correo'],
            'extencion' => $datos['extencion'],
            'user_servidor'=>$datos['user_servidor'],
            'pass_servidor' => $datos['pass_servidor'],
            'password' => Hash::make($datos['pass_servidor']),
            'name'=>$datos['name'],
            'lastName'=>$datos['lastName'],
            'lastName2'=>$datos['lastName2'],
            'activo' => $datos['activo'],
            'user_vpn'=>$datos['user_vpn'],
            'area'=>$datos['area'],
            'updated_at' => $now
        );

        DB::table('users')
            ->where('id', $datos['id'])
            ->update($actualizar);

        //return $sql;
        return redirect('usuarios');
    }

    public function exportarApdf($id)
    {
        $datos = DB::table('users')
            ->where('id', $id)
            ->get()->toArray();

        $datoArray = [
            'id' => $datos[0]->id,
            'area' => $datos[0]->area,
            'name' => $datos[0]->name,
            'lastName' => $datos[0]->lastName,
            'lastName2' => $datos[0]->lastName2,
            'pass_pc' => $datos[0]->pass_pc,
            'pass_aps' => $datos[0]->pass_aps,
            'correo' => $datos[0]->correo,
            'pass_correo' => $datos[0]->pass_correo,
            'user_vpn' => $datos[0]->user_vpn,
            'pass_vpn' => $datos[0]->pass_vpn,
            'user_servidor' => $datos[0]->user_servidor,
            'pass_servidor' => $datos[0]->pass_servidor,
            'extencion' => $datos[0]->extencion
        ];
        $nombre = $id . "_" . $datoArray['lastName'] . "_" . $datoArray['lastName2'] . ".pdf";


        $pdf = Pdf::loadView('usuarioPDF', $datoArray);

        //return view('usuarioPDF')->with($datoArray);
        return $pdf->download($nombre);
    }
    function mi_informacion()
    {
        $datos = DB::table('users')
            ->where('id', '=', Session::get('id'))
            ->get();

        return view('usuarioCompleto')->with('datos', $datos);
    }
}
