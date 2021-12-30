<?php

namespace App\Exports;

use App\NpkMkt;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class NpkMktExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return NpkMkt::all();
    }
    public function headings(): array
    {
        return [
            'ID',
            'MONTH',
            'MITRA_NAME',
            'PKS_NUMBER',
            'PERIODE',
            'NILAI_NPK',
            'KETERANGAN',
            'CREATED_AT',
            'UPDATED_AT',
        ];
    }
}
