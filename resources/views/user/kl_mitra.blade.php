@extends('layouts.user.app-user')

@section('content')
<br><br>
	<div class="container table-responsive text-light" style="background: #02275d;border-radius: 15px;">
		<div class="container text-light text-center"><strong style="font-size: 25px;">DATA KONTRAK LAYANAN</strong></div>
		<table id="example" class="table table-striped table-bordered text-light text-center" style="width:100%">
	        <thead>
                <tr>
                    <td>No</td>
                    <td>Kontrak Layanan</td>
                    <td>Nilai Kontrak</td>
                    <td>Sudah Berbayar</td>
                    <td>Belum Berbayar</td>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($datas as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->pks_number }}</td>
                        <td align="right">{{ number_format($data->nilai_kontrak) }}</td>
                        <td align="right">{{ number_format($data->nilai_npk) }}</td>
                        <td align="right">{{ number_format($data->nilai_kontrak - $data->nilai_npk) }}</td>
                    </tr>
                @endforeach
            </tbody>
	    </table>
	</div>
	<br><br><br>
@endsection