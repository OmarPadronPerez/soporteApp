<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TicketExport implements FromArray, WithTitle, WithHeadings,  WithStyles, WithColumnWidths
{
    protected $fInicio;
    protected $fFin;

    public function __construct($fInicio, $fFin)
    {

        $this->fInicio = $fInicio;
        $this->fFin = $fFin;
    }

    public function array(): array
    {
        $enviar = [];
        $data = DB::table('tickets')
            ->whereBetween('tickets.created_at', [$this->fInicio, $this->fFin])
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


        foreach ($data as $dato) {
            $fecha_resuelto = 'Pendiente';
            if (isset($dato->fecha_resuelto)) {
                $fecha_resuelto = date('d/m/Y H:i', strtotime($dato->fecha_resuelto));
            }

            $temp['id'] =  $dato->id;
            $temp['created_at'] = date('d/m/Y H:i', strtotime($dato->created_at));
            $temp['Usuario'] = $dato->creador_name . ' ' . $dato->creador_lastName;
            $temp['Grevedad'] = $dato->Urgencia;
            $temp['Area afectada']=$dato->afectados;
            $temp['Falla'] = $dato->Falla;
            $temp['Descripcion'] = $dato->Detalles;
            $temp['Atiende'] = $dato->resuelto_name . ' ' . $dato->resuelto_lastName;
            $temp['Acciones'] = $dato->Diagnostico;
            $temp['fecha_resuelto'] = $fecha_resuelto;

            array_push($enviar, $temp);
        }

        return $enviar;
    }

    public function title(): string
    {
        return 'Tickets';
    }

    public function headings(): array
    {
        return [
            'ID',
            'Fecha',
            'Usuario',
            'Gravedad',
            'Area afectada',
            'Tipo de Incidencia',
            'Descripción de incidencia',
            'Atendió',
            'Resolucion',
            'Finalizado'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $ultimaFila = $sheet->getHighestRow();

        $sheet->getStyle('F')->getAlignment()->setWrapText(true);
        $sheet->getStyle("A1:Z$ultimaFila")->applyFromArray([
            'alignment' => [
                'vertical' => 'center', // Opciones: 'left', 'center', 'right', 'justify'
            ],
        ]);

        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                ],
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center']
            ],

        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 4,
            'B' => 16,
            'C' => 28,
            'D' => 11,
            'E' => 20,
            'F' => 62,
            'G' => 23,
            'H' => 30,
            'I' => 23,
        ];
    }
}
