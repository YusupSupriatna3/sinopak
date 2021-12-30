@extends('layouts.user.app-user')

@section('content')
<br><br>
	<div class="container table-responsive text-light" style="background: #02275d;border-radius: 15px;">
		<div class="container text-light text-center"><strong style="font-size: 25px;">DATA KONTRAK LAYANAN</strong></div>
		<table id="example" class="table table-striped table-bordered text-light text-center" style="width:100%">
	        <thead>
                <tr>
                    <th>No</th>
                    <th>Kontrak Layanan</th>
                    <th>Jumlah NPK</th>
                </tr>
            </thead>
            <tbody>
                @php $no=1; @endphp
                @foreach($data as $datas)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $datas->pks_number }}</td>
                        <td>{{ number_format($datas->jumlah_npk) }}</td>
                    </tr>
                @endforeach
            </tbody>
	    </table>
	</div>
	<br><br><br>
@endsection