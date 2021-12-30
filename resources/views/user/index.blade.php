@extends('layouts.user.app-user')

@section('content')
<br><br>
	<div class="container">
		<nav class="nav nav-pills">
			<a style="background-color: #02275d;border-radius: 15px 50px 30px 5px;" class="nav-link active text-light" href="{{ url('home') }}"><strong>AP Management</strong></a>
			<a style="background-color: #EBECF1;border-radius: 15px 50px 30px 5px;" class="nav-link text-secondary" href="{{ url('marketing') }}"><strong>Marketing Fee</strong></a>
			<a style="background-color: #EBECF1;border-radius: 15px 50px 30px 5px;" class="nav-link text-secondary" href="{{ url('spnpk') }}"><strong>Surat Pembayaran</strong></a>
		</nav>
	</div>
	<br>
	<div class="container" style="background-color: #ffb822;">
		<form action="{{ route('search-dashboard-periode') }}" method="post" class="needs-validation" novalidate>
			@csrf
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="contoh1">Periode Awal</label>
					<input type="text" name="periode_awal" class="form-control input-dateee" id="contoh1" placeholder="Periode Awal" value="@if(isset($tamp['p_awal'])){{ $tamp['p_awal'] }}@endif" required>
					<div class="invalid-feedback" style="font-size: 15px;">Isikan Periode Awal.</div>
				</div>
				<div class="form-group col-md-4">
					<label for="contoh2">Periode Akhir</label>
					<input type="text" name="periode_akhir" class="form-control input-dateee" id="contoh2" placeholder="Periode Akhir" value="@if(isset($tamp['p_akhir'])){{ $tamp['p_akhir'] }}@endif" required>
					<div class="invalid-feedback" style="font-size: 15px;">Isikan Periode Akhir.</div>
				</div>
				<div class="form-group col-md-4">
					<label for="contoh2">&nbsp</label>
					<button type="submit" name="search-ap" style="background-color: #02275d;" class="btn btn-primary col-md-12 text-light"><i class="fa fa-search"></i> Seach</button>
				</div>
			</div>
		</form>
	</div>
	<br>
	<div class="container container-fluid">
		<div class="row">
			<div class="col-md-3">
				<div class="card text-white text-center border-danger" style="border-radius: 15px 50px 30px;background-color: #000077;">
					<div class="card-header">
						<strong style="font-size: 20px;">Mitra</strong>
					</div>
				 
					<div class="card-body">
						<strong style="font-size: 20px;">{{ $tamp['mitra'] }}</strong>
					</div>
				 
					<div class="card-footer">
						@if(isset($tamp['prd_awal']) && isset($tamp['prd_akhir']))
						{{ $tamp['prd_awal'] }} - {{ $tamp['prd_akhir'] }}
						@else
						-
						@endif
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card text-white text-center border-danger" style="border-radius: 15px 50px 30px;background-color: #ff4800;">
					<div class="card-header">
						<strong style="font-size: 20px;">Kontrak Layanan</strong>
					</div>
				 
					<div class="card-body">
						<strong style="font-size: 20px;">{{ $tamp['kl'] }}</strong>
					</div>
				 
					<div class="card-footer">
						@if(isset($tamp['prd_awal']) && isset($tamp['prd_akhir']))
						{{ $tamp['prd_awal'] }} - {{ $tamp['prd_akhir'] }}
						@else
						-
						@endif
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card text-white text-center border-danger" style="border-radius: 15px 50px 30px;background-color: #3c096c;">
					<div class="card-header">
						<strong style="font-size: 20px;">NPK</strong>
					</div>
				 
					<div class="card-body">
						<strong style="font-size: 20px;">{{ $tamp['npk'] }}</strong>
					</div>
				 
					<div class="card-footer">
						@if(isset($tamp['prd_awal']) && isset($tamp['prd_akhir']))
						{{ $tamp['prd_awal'] }} - {{ $tamp['prd_akhir'] }}
						@else
						-
						@endif
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card text-white  text-center border-danger" style="border-radius: 15px 50px 30px;background-color: #0c5a23;">
					<div class="card-header">
						<strong style="font-size: 20px;">Nilai NPK</strong>
					</div>
				 
					<div class="card-body">
						<strong style="font-size: 20px;">{{ 'Rp. '.number_format($tamp['nilai_npk']) }}</strong>
					</div>
				 
					<div class="card-footer">
						@if(isset($tamp['prd_awal']) && isset($tamp['prd_akhir']))
						{{ $tamp['prd_awal'] }} - {{ $tamp['prd_akhir'] }}
						@else
						-
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="container container-fluid">
		<div class="row">
			<div class="col-md-3">
				<div class="card text-white text-center border-danger" style="border-radius: 15px 50px 30px;background-color: #10002b;">
					<div class="card-header">
						<strong style="font-size: 20px;">Nilai Kontrak Berjalan</strong>
					</div>
				 
					<div class="card-body">
						<strong style="font-size: 20px;">{{ 'Rp. '.number_format($tamp['jumlah_kontrak']) }}</strong>
					</div>
				 
					<div class="card-footer">
						@if(isset($tamp['prd_awal']) && isset($tamp['prd_akhir']))
						{{ $tamp['prd_awal'] }} - {{ $tamp['prd_akhir'] }}
						@else
						-
						@endif
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card text-white text-center border-danger" style="border-radius: 15px 50px 30px;background-color: #10002b;">
					<div class="card-header">
						<strong style="font-size: 20px;">Nilai Kontrak Selesai</strong>
					</div>
				 
					<div class="card-body">
						<strong style="font-size: 20px;">{{ 'Rp. '.number_format($tamp['jml_kontrak']) }}</strong>
					</div>
				 
					<div class="card-footer">
						@if(isset($tamp['prd_awal']) && isset($tamp['prd_akhir']))
						{{ $tamp['prd_awal'] }} - {{ $tamp['prd_akhir'] }}
						@else
						-
						@endif
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card text-white text-center border-danger" style="border-radius: 15px 50px 30px;background-color: #9d0208;">
					<div class="card-header">
						<strong style="font-size: 20px;">Belum Bayar</strong>
					</div>
				 
					<div class="card-body">
						<strong style="font-size: 20px;">{{ 'Rp. '.number_format($tamp['jumlah_kontrak']-$tamp['nilai_npk']) }}</strong>
					</div>
				 
					<div class="card-footer">
						@if(isset($tamp['prd_awal']) && isset($tamp['prd_akhir']))
						{{ $tamp['prd_awal'] }} - {{ $tamp['prd_akhir'] }}
						@else
						-
						@endif
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card text-white  text-center border-danger" style="border-radius: 15px 50px 30px;background-color: #0c5a23;">
					<div class="card-header">
						<strong style="font-size: 15px;">Nilai NPK + Excess Usage</strong>
					</div>
				 
					<div class="card-body">
						<strong style="font-size: 20px;">{{ 'Rp. '.number_format($tamp['n_npk']) }}</strong>
					</div>
				 
					<div class="card-footer">
						@if(isset($tamp['prd_awal']) && isset($tamp['prd_akhir']))
						{{ $tamp['prd_awal'] }} - {{ $tamp['prd_akhir'] }}
						@else
						-
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	<br><br>
	<div class="container table-responsive text-light" style="background: #02275d;border-radius: 15px;">
	    <div class="card-deck">
		  	<div class="card" style="background: #02275d;">
		    	<div class="card-body">
		      		<h5 class="card-title">Data Kontrak</h5>
		      		<table id="" class="table table-striped table-bordered text-light text-center" style="width:100%">
				        <thead>
				            <tr>
				                <th>No</th>
				                <th>Keterangan</th>
				                <th>Total</th>
				            </tr>
				        </thead>
				        <tbody>
				            <tr>
				                <td>1</td>
				                <td>Kontrak Selesai</td>
				                <td>{{ $tamp['selesai'] }}</td>
				            </tr>
				            <tr>
				                <td>2</td>
				                <td>Kontrak Belum Selesai</td>
				                <td>{{ $tamp['Belum_Selesai'] }}</td>
				            </tr>
				        </tbody>
				        <tfoot>
				            <tr>
				                <th colspan="2">Total</th>
				                <th>{{ $tamp['kl'] }}</th>
				            </tr>
				        </tfoot>
				    </table>
		    	</div>
		  	</div>
		    <div class="card" style="background: #02275d;">
		    	<div class="card-body">
		      		<h5 class="card-title">Rata - Rata Perbulan</h5>
		      		<table id="" class="table table-striped table-bordered text-light text-center" style="width:100%">
				        <thead>
				            <tr>
				                <th>No</th>
				                <th>Keterangan</th>
				                <th>Rata - Rata</th>
				            </tr>
				        </thead>
				        <tbody>
				            <tr>
				                <td>1</td>
				                <td>NPK</td>
				                <td>{{ floor($tamp['npk']/12) }}</td>
				            </tr>
				            <tr>
				                <td>2</td>
				                <td>Nilai NPK</td>
				                <td>{{ 'Rp. '.number_format($tamp['nilai_npk']/12) }}</td>
				            </tr>
				        </tbody>
				    </table>
		    	</div>
		  	</div>
		  </div>
		</div>
	</div>
	<br><br>
	<div class="container table-responsive text-light" style="background: #02275d;border-radius: 15px;">
		<div class="container text-light text-center"><strong style="font-size: 25px;">Data Mitra</strong></div>
		<table id="example" class="table table-striped table-bordered text-light text-center" style="width:100%">
	        <thead>
	            <tr>
	                <th>No</th>
	                <th>Nama Mitra</th>
	                <th>Jumlah Kontrak</th>
	            </tr>
	        </thead>
	        <tbody>
	        	@php $no=1; @endphp
	        	@foreach($data as $datas)
		            <tr>
		                <td>{{ $no++ }}</td>
		                <td><a class="text-light" href="kl-mitra/{{ $datas->mitra_name }}/{{ $tamp['periode_awal'] }}/{{ $tamp['periode_akhir'] }}">{{ $datas->mitra_name }}</a></td>
		                <td>{{ $datas->jumlah_kl }}</td>
		            </tr>
	            @endforeach
	        </tbody>
	        <tfoot>
	            <tr>
	                <th colspan="2">Total</th>
	                <th>{{ $tamp['kl'] }}</th>
	            </tr>
	        </tfoot>
	    </table>
	</div>
	<br><br><br>
@endsection