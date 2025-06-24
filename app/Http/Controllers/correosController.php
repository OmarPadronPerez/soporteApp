<?php

namespace App\Http\Controllers;

use App\Mail\enProceso;
use App\Mail\ticketnuevo;
use App\Mail\ticketcerrado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use function Laravel\Prompts\select;

class correosController extends Controller
{
    public function nuevoTicket($id)
    {
        //se obtienen los datos del ticket
        $datos = DB::table('tickets')
            ->leftJoin('users as creador', 'tickets.creador_id', '=', 'creador.id')
            ->leftJoin('users as resuelto', 'tickets.resuelto_id', '=', 'resuelto.id')
            ->select(
                'tickets.*',
                'creador.name as creador_name',
                'creador.lastName as creador_lastName',
                'resuelto.name as resuelto_name',
                'resuelto.lastName as resuelto_lastName',
                'creador.correo as creador_correo'
            )
            ->where('tickets.id', $id)
            ->get()->toArray();

        $enviar = DB::table('users')
            ->select('correo')
            ->where('area', 'SOPORTE')
            ->where('activo', 1)
            ->get()->toArray();

        $enviararray = [];
        for ($i = 0; $i < count($enviar); $i++) {
            array_push($enviararray, $enviar[$i]->correo);
        }
        if (isset($datos[0]->creador_correo)) {
            array_push($enviararray, $datos[0]->creador_correo);
        }

        try {
            Mail::to($enviararray)
                ->send(new ticketnuevo($datos[0]));
        } catch (\Throwable $th) {
            //throw $th;
        };

        if ($datos) {
            $mensaje = [
                'estado' => 'realizado',
                'titulo' => 'Ticket cerrado',
                'mensaje' => 'el ticket fue creado con exito'
            ];
            return redirect('tickets')->with('mensaje', $mensaje);
        } else {
            $mensaje = [
                'estado' => 'falla',
                'titulo' => 'Ticket NO guardado',
                'mensaje' => 'Hubo una falla al guardar tu ticket, ponte en contacto con soporte tecnico'
            ];
            return redirect('tickets')->with('mensaje', $mensaje);
        }
    }
    public function actualizarTicket($id)
    {
        $datos = DB::table('tickets')
            ->leftJoin('users as creador', 'tickets.creador_id', '=', 'creador.id')
            ->leftJoin('users as resuelto', 'tickets.resuelto_id', '=', 'resuelto.id')
            ->select(
                'tickets.*',
                'creador.name as creador_name',
                'creador.lastName as creador_lastName',
                'resuelto.name as resuelto_name',
                'resuelto.lastName as resuelto_lastName',
                'creador.correo as creador_correo'
            )
            ->where('tickets.id', $id)
            ->get()->toArray();
        try {
            Mail::to($datos[0]->creador_correo)
                ->send(new enProceso($datos[0]));
        } catch (\Throwable $th) {
            //throw $th;

        }
        
        return redirect('tickets/' . $id);
    }

    public function cerradoTicket($id)
    {
        //se obtienen los datos del ticket
        $datos = DB::table('tickets')
            ->leftJoin('users as creador', 'tickets.creador_id', '=', 'creador.id')
            ->leftJoin('users as resuelto', 'tickets.resuelto_id', '=', 'resuelto.id')
            ->select(
                'tickets.*',
                'creador.name as creador_name',
                'creador.lastName as creador_lastName',
                'resuelto.name as resuelto_name',
                'resuelto.lastName as resuelto_lastName',
                'creador.correo as creador_correo'
            )
            ->where('tickets.id', $id)
            ->get();

        $datos = $datos[0];
        //return $datos;
        $receptor = [$datos->creador_correo];
        //dd($datos);
        try {
            Mail::to($receptor)
                ->send(new ticketcerrado($datos));
        } catch (\Throwable $th) {
            //throw $th;
        }

        if ($datos) {
            $mensaje = [
                'estado' => 'realizado',
                'titulo' => 'Ticket cerrado',
                'mensaje' => 'el ticket ' . $id . ' fue cerrado con exito'
            ];
        } else {
            $mensaje = [
                'estado' => 'falla',
                'titulo' => 'Ticket NO guardado',
                'mensaje' => 'Hubo una falla al guardar tu ticket, ponte en contacto con soporte tecnico'
            ];
        }
        return redirect('historial')->with('mensaje', $mensaje);
    }
}
