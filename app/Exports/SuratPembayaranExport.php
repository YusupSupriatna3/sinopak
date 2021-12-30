<?php

namespace App\Exports;

use App\Pembayaran;
use DateTime;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;


use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class SuratPembayaranExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    * @var Pembayaran $pembayaran
    */
    private $account,$periode_awal,$periode_akhir;

    public function __construct(string $account,string $periode_awal, string $periode_akhir)
    {
    	$this->account = $account;
    	$this->periode_awal = $periode_awal;
    	$this->periode_akhir = $periode_akhir;
    }

    public function collection()
    {
        return Pembayaran::select('cl_id','idnumber','account_name','nper','cl_hkont','cl_post_date',
            		DB::raw('sum(total_cash) as total_cash'),
            		DB::raw('sum(total_non_cash) as total_non_cash'))
            		->where('idnumber','=',$this->account)
            		->where('total_cash','!=',0)
            		->whereNotNull('cl_hkont')
            		->whereBetween('nper',[$this->periode_awal,$this->periode_akhir])
            		->groupBy('cl_id','idnumber','account_name','nper','cl_hkont','cl_post_date')
            		->orderBy('nper','ASC')->get();
    }

    public function headings(): array
    {
        return [
            'PAYMENT ID',
            'AKUN',
            'NAMA CC',
            'TAGIHAN',
            'BANK',
            'TANGGAL FLAGING',
            'JUMLAH FLAGING',
            'TOTAL NON CASH',
        ];
    }

    public function map($pembayaran): array
    {
        return [
            $pembayaran->cl_id,
            $pembayaran->idnumber,
            $pembayaran->account_name,
            date_format(date_create(substr($pembayaran->nper,0,4).'-'.substr($pembayaran->nper,4,6)),"M'y"),
            $pembayaran->cl_hkont,
            date('d/m/Y',strtotime($pembayaran->cl_post_date)),
            number_format($pembayaran->total_cash),
            number_format($pembayaran->total_non_cash),
        ];
    }
}