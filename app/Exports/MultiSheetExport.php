<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultiSheetExport implements WithMultipleSheets
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $fInicio;
    protected $fFin;

    public function __construct($fInicio, $fFin)
    {
       
        $this->fInicio = $fInicio;
        $this->fFin = $fFin;
        
    }

    public function sheets(): array
    {
        
        return [
            'Tickets' => new TicketExport($this->fInicio, $this->fFin),
            'Timbrados' => new timbradosExports($this->fInicio, $this->fFin),
        ];
    }
}
