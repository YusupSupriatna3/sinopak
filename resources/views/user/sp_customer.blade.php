@extends('layouts.user.app-user')

@section('content')
<br><br>
	<div class="container table-responsive text-light" style="background: #02275d;border-radius: 15px;">
		<div class="container text-light text-center"><strong style="font-size: 25px;">DATA SURAT PEMBAYARAN</strong></div>
		<table id="example" class="table table-striped table-bordered text-light text-center" style="width:100%">
	        <thead>
                <tr>
                    <td>No</td>
                    <td>Nomor Akun</td>
                    <td>Nama Customer</td>
                    <td>Periode Awal</td>
                    <td>Periode Akhir</td>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($datas as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->account_number }}</td>
                        <td align="center">{{ $data->customer_name }}</td>
                        <td align="center">{{ $data->periode_awal }}</td>
                        <td align="center">{{ $data->periode_akhir }}</td>
                    </tr>
                @endforeach
            </tbody>
	    </table>
	</div>
	<br><br><br>
@endsection