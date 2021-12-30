<?php

namespace App\Exports;

use App\Npk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use DateTime;

use Maatwebsite\Excel\Concerns\WithMapping;

class NpkExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    * @var NPK $npk
    */
    public function collection()
    {
        return Npk::all();
    }
    public function headings(): array
    {
        return [
            'ID',
            'MONTH',
            'MITRA_NAME',
            'PKS_NUMBER',
            'CUSTOMER_NAME',
            'ACCOUNT_NUMBER',
            'SEGMEN',
            'MANAGER_NAME',
            'NIK',
            'JANGKA_WAKTU_KONTRAK',
            'AWAL_KONTRAK',
            'AKHIR_KONTRAK',
            'NILAI_KONTRAK',
            'PERIODE',
            'CURR_TYPE',
            'NILAI_NPK',
            'TANGGAL_NPK',
            'MRC',
            'Nilai Excess Usage'
            'OTC_KE',
            'OTC1',
            'OTC2',
            'OTC3',
            'OTC4',
            'TERMIN_KE',
            'TERMIN1',
            'TERMIN2',
            'TERMIN3',
            'TERMIN4',
            'TERMIN5',
            'NPK_KE',
            'NPK_DAY',
            'NPK_MONTH',
            'SLG',
            'USAGEE',
            'KETERANGAN',
            'KETERANGAN_DOWNLOAD_OTC',
            'KETERANGAN_DOWNLOAD_MRC',
            'KETERANGAN_DOWNLOAD_TERMIN',
            'QTY',
            'JUMLAH_HARI',
            'JUMLAH_BULAN',
            'CREATED_AT',
            'UPDATED_AT',
            'TANGGAL_CETAK',
            'Selesai',
            'Status',
            'CREATED_BY',
        ];
    }

    public function map($npk): array
    {
        $tgl1 = new DateTime(date('Y-m-d',strtotime($npk->created_at)));
        $tgl2 = new DateTime(date('Y-m-d',strtotime($npk->tanggal_cetak)));
        $d = $tgl2->diff($tgl1)->days + 1;
        return[
            $npk->id,
            $npk->month,
            $npk->mitra_name,
            $npk->pks_number,
            $npk->customer_name,
            $npk->account_number,
            $npk->segmen,
            $npk->manager_name,
            $npk->nik,
            $npk->jangka_waktu_kontrak,
            date('d/m/Y',strtotime($npk->awal_kontrak)),
            date('d/m/Y',strtotime($npk->akhir_kontrak)),
            number_format($npk->nilai_kontrak),
            $npk->periode,
            $npk->curr_type,
            number_format($npk->nilai_npk),
            $npk->tanggal_npk,
            number_format($npk->mrc),
            number_format($npk->nilai_excess_usage),
            $npk->otc_ke,
            number_format($npk->otc1),
            number_format($npk->otc2),
            number_format($npk->otc3),
            number_format($npk->otc4),
            $npk->termin_ke,
            number_format($npk->termin1),
            number_format($npk->termin2),
            number_format($npk->termin3),
            number_format($npk->termin4),
            number_format($npk->termin5),
            $npk->npk_ke,
            $npk->npk_day,
            $npk->npk_month,
            number_format($npk->slg),
            $npk->usagee,
            $npk->keterangan,
            $npk->keterangan_download_otc,
            $npk->keterangan_download_mrc,
            $npk->keterangan_download_termin,
            $npk->qty,
            $npk->jumlah_hari,
            $npk->jumlah_bulan,
            date('d/m/Y',strtotime($npk->created_at)),
            date('d/m/Y',strtotime($npk->updated_at)),
            date('d/m/Y',strtotime($npk->tanggal_cetak)),
            $d." hari",
            $npk->status,
            $npk->created_by,
        ];  
    }
}