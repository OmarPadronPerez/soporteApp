<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class timbradosExports implements FromArray, WithTitle, WithHeadings, WithStyles, WithColumnWidths
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
        $data = DB::table('timbrados')
            ->whereBetween('created_at', [$this->fInicio, $this->fFin])
            ->orderBy('created_at', 'asc')
            ->get()->toArray();


        foreach ($data as $dato) {
            $temp = [];
            $fecha_resuelto = 'Pendiente';
            if (isset($dato->fecha_resuelto)) {
                $fecha_resuelto = date('d/m/Y H:i', strtotime($dato->fecha_resuelto));
            }

            $temp['id'] =  $dato->id;
            $temp['created_at'] = date('d/m/Y H:i', strtotime($dato->created_at));
            $temp['servicio'] =  $dato->servicio;
            $temp['empresa'] =  $dato->empresa;
            $temp['ejercicio'] =  $dato->ejercicio;
            $temp['tipoPeriodo'] =  $dato->tipoPeriodo;
            $temp['periodo'] =  $dato->periodo;
            $temp['empleados'] =  $dato->empleados;
            $temp['comentarios'] =  $dato->comentarios;
            $temp['fecha_resuelto'] = $fecha_resuelto;
            $temp['Fallas'] =  $dato->Fallas;
            array_push($enviar, $temp);
        }

        return $enviar;
    }

    public function title(): string
    {
        return 'Timbrados';
    }

    public function headings(): array
    {
        return [
            'ID',
            'Fecha',
            'Servicios',
            'Empresa',
            'Ejercicio',
            'Tipo de Periodo',
            'Periodo',
            'Empleados',
            'Comentarios',
            'Finalizado',
            'Fallas'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $ultimaFila = $sheet->getHighestRow();

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
            'C' => 24,
            'D' => 15,
            'E' => 10,
            'F' => 16,
            'G' => 8,
            'H' => 19,
            'I' => 23,
            'J' => 16,
            'K' => 35,

        ];
    }
}
