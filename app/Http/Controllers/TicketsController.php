<?php

namespace App\Http\Controllers;

use App\Models\mantenimiento;
use App\Models\Ticket;
use App\Models\Timbrados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TicketsController extends Controller
{
    public function verTickets(Request $request)
    {
        $orden = $request->input('orden', 'asc');
        $mensaje = null;

        if (Session::get('administrador')) {
            $datos = DB::table('tickets')
                ->where('tickets.fecha_resuelto', NULL)
                ->leftJoin('users as creador', 'tickets.creador_id', '=', 'creador.id')
                ->leftJoin('users as resuelto', 'tickets.resuelto_id', '=', 'resuelto.id')
                ->select(
                    'tickets.*',
                    'creador.name as creador_name',
                    'creador.lastName as creador_lastName',
                    'resuelto.name as resuelto_name',
                    'resuelto.lastName as resuelto_lastName'
                )
                ->orderBy('tickets.created_at', $orden)
                ->paginate(10);
        } else {
            $datos = DB::table('tickets')
                ->leftJoin('users as creador', 'tickets.creador_id', '=', 'creador.id')
                ->leftJoin('users as resuelto', 'tickets.resuelto_id', '=', 'resuelto.id')
                ->select(
                    'tickets.*',
                    'creador.name as creador_name',
                    'creador.lastName as creador_lastName',
                    'creador.area as creador_area',
                    'resuelto.name as resuelto_name',
                    'resuelto.lastName as resuelto_lastName'
                )
                ->whereNull('tickets.fecha_resuelto')
                ->where(function ($query) {
                    $query->where('tickets.Creador_id', '=', Session::get('id'))
                        ->orWhere('tickets.Creador_id', '=', 1)
                        ->orWhere('tickets.afectados', '=', 'General')
                        ->orWhereColumn('tickets.afectados', '=', 'creador.area');
                })
                ->orderBy('tickets.created_at', $orden)
                ->paginate(10);
            /*$datos = DB::table('tickets')
                ->where('tickets.fecha_resuelto', NULL)
                ->leftJoin('users as creador', 'tickets.creador_id', '=', 'creador.id')
                ->leftJoin('users as resuelto', 'tickets.resuelto_id', '=', 'resuelto.id')
                ->select(
                    'tickets.*',
                    'creador.name as creador_name',
                    'creador.lastName as creador_lastName',
                    'creador.area as creador_area',
                    'resuelto.name as resuelto_name',
                    'resuelto.lastName as resuelto_lastName'
                )
                ->where(function ($query) {
                    $query->where('tickets.Creador_id', '=', Session::get('id'))
                        ->orWhere('tickets.Creador_id', '=', 1)
                        ->orWhere('tickets.afectados', '=', 'RRHH');
                })
                ->orderBy('created_at', $orden)
                ->paginate(10);*/
        }
        //return ($datos);
        return View('verTickets', compact('datos', 'mensaje'));
        //return View('verTickets')->with('datos', $datos);
    }
    public function verTicketsid($id)
    {
        $datos = DB::table('tickets')
            ->where('tickets.id', $id)
            ->leftJoin('users as creador', 'tickets.creador_id', '=', 'creador.id')
            ->leftJoin('users as resuelto', 'tickets.resuelto_id', '=', 'resuelto.id')
            ->select(
                'tickets.*',
                'creador.name as creador_name',
                'creador.lastName as creador_lastName',
                'creador.area as creador_area',
                'resuelto.name as resuelto_name',
                'resuelto.lastName as resuelto_lastName'
            )
            ->orderBy('created_at', 'asc')
            ->get();

        //return $datos;
        $timbrado = null;

        if ($datos[0]->Falla == "TIMBRADO") {
            $timbrado = DB::table('timbrados')
                ->join('empresas', 'timbrados.empresa', '=', 'empresas.id')
                ->where('timbrados.id', $id)
                ->select('timbrados.*', 'empresas.nombre as empresa_nombre')
                ->get();
        }
        //return $timbrado;
        //if (Session::get('area') == 'SOPORTE') { //si es administrador lleva a editar

        if (Session::get('administrador')) {
            return view('responder', compact('datos', 'timbrado'));
        } else { //si es usuario estandar te redirige a solo ver
            return view('completo', compact('datos', 'timbrado'));
        }
    }


    public function crearTicket()
    {
        $empresas = DB::table('empresas')
            ->select('id', 'nombre')
            ->where('activo', '1')
            ->orderBy('nombre', 'asc')
            ->get();

        if (Session::get('administrador')) {
            $datos = DB::table('users')
                ->select('id', 'name', 'lastName', 'lastName2')
                ->where('activo', '1')
                ->orderBy('name', 'asc')
                ->get();

            //return $datos;
            return view('crearTicket', compact('datos', 'empresas'));
        } else {
            return view('crearTicket', compact('empresas'));
        }
    }

    public function historialTicket(Request $request)
    {

        $orden = $request->input('orden', 'DESC');
        $columnas = [
            'users.name',
            'users.lastName',
            'tickets.id',
            'tickets.created_at',
            'tickets.fecha_resuelto',
            'tickets.Falla',
            'tickets.Detalles',
            'tickets.Urgencia',
            'tickets.afectados'
        ];
        $fechaActual = new \DateTime();
        $fechaMes = now()->subDays(15);
        if (Session::get('administrador')) {
            $datos = DB::table('tickets')
                ->select($columnas)
                ->where('tickets.fecha_resuelto', '!=', NULL)
                //->whereBetween('tickets.created_at', [$fechaMes, $fechaActual])
                ->join('users', 'tickets.Creador_id', '=', 'users.id')
                ->orderBy('tickets.created_at', $orden)
                ->paginate(10);
            //->get();
        } else {
            $datos = DB::table('tickets')
                ->select($columnas)
                ->where(function ($query) {
                    $query->where('tickets.Creador_id', '=', Session::get('id'))
                        ->orWhere('tickets.Creador_id', '=', 1);
                })
                ->where('tickets.fecha_resuelto', '!=', NULL)
                ->whereBetween('tickets.created_at', [$fechaMes, $fechaActual])
                ->join('users', 'tickets.Creador_id', '=', 'users.id')
                ->orderBy('tickets.created_at', $orden)
                ->paginate(10);
            //->get();
        }
        //return ($datos);
        return view('historial', compact('datos'));
    }

    public function store(Request $request)
    {
        $datos = $request->all();
        if (!isset($datos['Falla2'])) {
            $datos['Falla2'] = 'Otra cosa';
        }
        $enviar = [];
        $pasa = false;
        $tipo_cancelado = '';

        //return $datos;

        if (Session::get('administrador')) {
            $datos['Creador_id'] = $datos['usuario2'];
        } else {
            $datos['Creador_id'] = Session::get('id');
        }
        $enviar['Creador_id'] = $datos['Creador_id'];
        //prepara los datos para exportarlos,si es timbrado lo acomoda y exporta
        if ($datos['Falla2'] != 'Timbrado/cancelacion') {
            $enviar['Falla'] = $datos['Falla1'] . '/' . $datos['Falla2'];
            $enviar['Detalles'] = $datos['Detalles'];

            if (isset($datos["file"])) { //si existe un archivo lo carga

                $file = $request->file('file');
                $fecha = date_format(new \DateTime(), "Y_m_d");
                $nombre = $datos['Creador_id'] . "_" . $fecha . "_" . uniqid() . "." . $file->getClientOriginalExtension();
                $destinationPath = 'storage/archivos/' . $datos['Creador_id'] . "/";
                $file->move($destinationPath, $nombre);
                $enviar['Archivo'] = $nombre;
                //$datos["Archivo"] = $nombre;
            }
            $data = Ticket::create($enviar);
            if ($data->id) {
                $pasa = true;
            }
        } else {
            $empleados = '';
            $servicio = '';

            if (isset($datos['cb_empleados_todos'])) {
                $empleados = 'TODOS';
            } else {
                $empleados = $datos['formEmpleados'];
            }

            if (isset($datos['servicio_timbrado'])) {
                $servicio .= 'Timbrado ';
            }
            if (isset($datos['servicio_Cancelacion'])) {
                if (strlen($servicio) > 0) {
                    $servicio .= '/ ';
                }
                $servicio .= 'Cancelación';
            }
            if (!isset($datos['Comentarios'])) {
                $datos['Comentarios'] = "";
            }
            if (isset($datos['tipo_cancelado'])) {
                $tipo_cancelado = $datos['tipo_cancelado'];
            }

            $enviar['Falla'] = 'TIMBRADO';
            //return  $datos;
            $enviar['Detalles'] =
                'Empresa: ' . $datos['Empresa'] . ', ' .
                'Ejercicio: ' . $datos['Ejercicio'] . ', ' .
                'servicio: ' . $servicio . ', ' .
                'Tipo de cancelado: ' . $tipo_cancelado . ', ' .
                'Tipo de periodo: ' . $datos['tipo_periodo'] . ', ' .
                'Periodo: ' . $datos['Periodo'] . ', ' .
                'Empleados: ' . $empleados . ', ' .
                'Comentarios: ' . $datos['Comentarios'];

            $data = Ticket::create($enviar);
            if ($data->id) {
                $enviarT['id'] = $data->id;
                $enviarT['empresa'] = $datos['Empresa'];
                $enviarT['servicio'] = $servicio;
                $enviarT['tipo_cancelado'] = $tipo_cancelado;
                $enviarT['ejercicio'] = $datos['Ejercicio'];
                $enviarT['tipoPeriodo'] = $datos['tipo_periodo'];
                $enviarT['periodo'] = $datos['Periodo'];
                $enviarT['empleados'] = $empleados;
                $enviarT['comentarios'] = $datos['Comentarios'];

                $data = Timbrados::create($enviarT);
                if ($data->id) {
                    $pasa = true;
                }
            }
        }
        if ($pasa) {
            return redirect('/nuevo/mailTicketNuevo/' . $data->id);
        } else {
            $mensaje = [
                'titulo' => 'Error',
                'mensaje' => 'Error al guardar el ticket',
                'estado' => 'falla'
            ];
            return redirect()->back()
                ->with('mensaje', $mensaje);
        }
    }

    public function actualizar(Request $request)
    {
        $datos = $request->all();
        //return $datos;
        $now = new \DateTime();
        $actualizar = [];
        if ($datos['Estado'] == 'Concluido') { //si esta marcado como  concluido
            $actualizar = [
                'resuelto_id' => Session::get('id'),
                'Diagnostico' => $datos['Diagnostico'],
                'urgencia' => $datos['prioridad'],
                'afectados' => $datos['afectados'],
                'fecha_resuelto' => $now,
                'updated_at' => $now
            ];
        } else { //si no esta concluido
            $actualizar = [
                'Diagnostico' => $datos['Diagnostico'],
                'urgencia' => $datos['prioridad'],
                'afectados' => $datos['afectados'],
                'updated_at' => $now,
                'resuelto_id' => Session::get('id')
            ];
        }

        //dd($datos);
        $base = DB::table('tickets')
            ->where('id', $datos['id'])
            ->update($actualizar);
        //si es un timbrado
        if ($datos['falla'] == 'TIMBRADO' && $datos['Estado'] == 'Concluido') {

            DB::table('timbrados')
                ->where('id', $datos['id'])
                ->update([
                    'Fallas' => $datos['Diagnostico'],
                    'fecha_resuelto' => $now,
                    'updated_at' => $now
                ]);
        }

        if (isset($base)) {
            if ($datos['Estado'] == 'Concluido') {
                return redirect('/nuevo/mailTicketCerrado/' . $datos['id']);
            } else {
                return redirect('/nuevo/mailTicketActualizado/' . $datos['id']);
            }
        } else {
            $mensaje = [
                'titulo' => 'Error',
                'mensaje' => 'Hubo un error al guardar el ticket',
                'estado' => 'falla'
            ];
            return redirect('tickets')->with('mensaje', $mensaje);
        }
    }

    public function verTicketCompleto($id)
    {
        $datos = DB::table('tickets')
            ->where('tickets.id', $id)
            ->leftJoin('users as creador', 'tickets.creador_id', '=', 'creador.id')
            ->leftJoin('users as resuelto', 'tickets.resuelto_id', '=', 'resuelto.id')
            ->select(
                'tickets.*',
                'creador.name as creador_name',
                'creador.lastName as creador_lastName',
                'resuelto.name as resuelto_name',
                'resuelto.lastName as resuelto_lastName'
            )
            ->orderBy('created_at', 'asc')
            ->get()->toArray();

        $timbrado = null;
        if ($datos[0]->Falla == "TIMBRADO") {
            $timbrado = DB::table('timbrados')
                ->join('empresas', 'timbrados.empresa', '=', 'empresas.id')
                ->where('timbrados.id', $id)
                ->select('timbrados.*', 'empresas.nombre as empresa_nombre')
                ->get();

            if (!isset($datos[0]->Diagnostico) && isset($datos[0]->fecha_resuelto)) {
                $timbrado[0]->fallas = 'Timbrado sin fallas';
                $datos[0]->Diagnostico = 'Timbrado sin fallas';
            }
        }
        if (!isset($datos[0]->Diagnostico) && isset($datos[0]->fecha_resuelto)) {
            $datos[0]->Diagnostico = 'Resuelto sin fallas';
        }
        //return $timbrado;
        return view('completo', compact('datos', 'timbrado'));
    }

    public function descagarArchivo($id, $file)
    {
        $ruta = public_path('storage\\archivos\\' . $id . "\\" . $file);
        //return $ruta;
        return response()->download($ruta);
    }
}
