@extends('layouts.user.app-user')

@section('content')
<br><br>
<div class="container">
  <div style="margin-left: 250px;">
    <table>
        <tr style="font-size: 14px;">
            <td>RINCIAN PEMBAYARAN DAN PERHITUNGAN HAK MITRA</td>
        </tr>
    </table>
    <table>
        <tr style="font-size: 14px;">
            <td>NAMA CC</td>
            <td>:</td>
            <td>{{ $data->customer_name }}</td>
        </tr>
        <tr style="font-size: 14px;">
            <td>NO AKUN</td>
            <td>:</td>
            <td>{{ $data->account_number }}</td>
        </tr>
        <tr style="font-size: 14px;">
            <td>TAGIHAN</td>
            <td>:</td>
            <td>
                {{ $data->periode }}
                @if(!empty($data->usagee))
                    {{ '(Usage'.' '.$data->usagee.')' }}
                @endif</td>
        </tr>
    </table>
    <table border="1px;" style="font-size: 14px;">
        <tr style="text-align: center;">
            <td rowspan="2">NO</td>
            <td rowspan="2" style="width: 350px;">URAIAN</td>
            <td rowspan="2" style="width: 110px;">Periode NPK</td>
            <td style="width: 110px;">Periode</td>
        </tr>
        <tr>
            <td style="text-align: center;width: 110px;">@if(!empty($data->usagee))
                    {{ $data->usagee }}@else {{ $data->periode }}
                @endif</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <span>HAK MITRA</span><br>
                <span style="margin-left: 30px;">{{ $data->mitra_name }}</span><br>
                <span style="margin-left: 30px;">{{ $data->pks_number }}</span><br>
                <span style="margin-left: 30px;">+ <input id="ktr1" style="width: 300px;" type="text" name="keterangan1"></span><br>
            </td>
            <td style="text-align: center;"><br><br><br><br>
              @if($type=='OTC')
            {{ $data->keterangan }}
        @elseif($type=='TERMIN')
            {{ $data->keterangan }}
        @else
            <!-- bln ke {{ $data->npk_day }} dari {{ $data->npk_month }} bln -->
            {{ $data->keterangan }}
        @endif
            </td>
            <td style="text-align: right;"><br><br><br><br>
              @if($type=='OTC')
                IDR {{ number_format($value) }}
              @elseif($type=='TERMIN')
                IDR {{ number_format($value) }}
              @else
                IDR {{ number_format($value) }}
              @endif
            </td>
        </tr>
        <tr>
            <td style="text-align: center;" colspan="3">TOTAL HAK MITRA</td>
            <td style="text-align: right;">
              @if($type=='OTC')
                IDR {{ number_format($value) }}
              @elseif($type=='TERMIN')
                IDR {{ number_format($value) }}
              @else
                IDR {{ number_format($value) }}
              @endif
            </td>
        </tr>
    </table>
    <table style="font-size: 14px;">
        <tr><td>KETERANGAN :</td></tr>
        <tr><td>HAK MITRA BELUM TERMASUK PPN 10 %</td></tr>
    </table>
    <br>
    <div style="font-size: 14px;">
        <span style="margin-left: 130px;">Mengetahui</span>
        <span style="margin-left: 185px;">Jakarta, {{ $tgl }}<br><span style="margin-left: 135px;">OSM CDM</span><span style="margin-left: 180px;">MANAGER AP MANAGEMENT</span></span>
    </div>
    <br><br><br><br>
    <table style="font-size: 14px;">
        <tr>
            <td><u style="margin-right: 220px;margin-left: 120px;">ARDI IMAWAN</u><br><span style="margin-right: 200px;margin-left: 128px;">NIK. 670168</span></td>
            <td><u>IBNU RADHI</u><br><span style="margin-right: 5px;margin-left: 3px;">NIK. 730254</span></td>
        </tr>
    </table>
  </div>
  <div style="margin-left: 460px;">
    <form action="{{ url('print-npk/'.$data->id) }}" method="POST">
      {{ csrf_field() }}
      <div>
        <input type="hidden" name="type" value="{{ $type }}">
        <input type="hidden" name="value" value="{{ $value }}">
        <input type="hidden" name="created" value="{{ $data->created_at }}">
        <input type="hidden" name="ktr" id="ktr">
        <button class="btn btn-primmary"><span style="font-size: 50px;" class="fa fa-print"></span><span style="font-size: 30px; font-family: arial;"> Print Data</span></button>
      </div>
    </form>
    </div>
</div>
<br><br><br>
@endsection