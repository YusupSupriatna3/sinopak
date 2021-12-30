@extends('layouts.user.app-user')

@section('content')
<br><br>
<div class="container" style="background-color: #ffb822;">
	<div class="container text-dark text-center"><strong style="font-size: 25px;">CEK PEMBAYARAN</strong></div>
	<form action="{{ route('cek-pembayaran') }}" method="post">
		@csrf
		<!-- <div class="form-row"> -->
			<div class="form-group">
				<label for="contoh1">ACCOUNT</label>
				<input type="text" name="account" class="form-control" id="contoh1" placeholder="ACCOUNT" value="@if(isset($account)){{ $account }}@endif">
			</div>
			<div class="form-group">
				<label for="contoh2">PERIODE AWAL</label>
				<select name="periode_awal" placeholder="PERIODE AWAL" class="form-control periode">
			      @foreach($periode as $per)
			      	<option value="{{ $per->nper }}" @if(isset($periode_awal)) @if($periode_awal==$per->nper) {{ 'selected' }} @endif @endif>{{ $per->nper }}</option>
			      @endforeach
			    </select>
			</div>
			<div class="form-group">
				<label for="contoh2">PERIODE AKHIR</label>
				<select name="periode_akhir" placeholder="PERIODE AKHIR" class="form-control periode">
			      @foreach($periode as $per)
			      	<option value="{{ $per->nper }}" @if(isset($periode_akhir)) @if($periode_akhir==$per->nper) {{ 'selected' }} @endif @endif))>{{ $per->nper }}</option>
			      @endforeach
			    </select>
			</div>
			<div class="form-group">
				<label for="contoh2">&nbsp</label>
				<button type="submit" name="search-pembayaran" style="background-color: #02275d;bottom: 20px;" class="btn btn-primary col-md-12 text-light"><i class="fa fa-search"></i> Search</button>
			</div>
		<!-- </div> -->
	</form>
</div>
<br><br>
@if(isset($data))
<div class="container table-responsive text-light" style="background: #02275d;border-radius: 15px;">
		<div class="container text-light text-center"><strong style="font-size: 25px;">DATA PEMBAYARAN</strong></div>
		<table id="example" class="table table-striped table-bordered text-light text-center" style="width:100%">
	        <thead>
	            <tr>
	            	<th>ACCOUNT_NUMBER</th>
	            	<th>ACCOUNT_NAME</th>
	                <th>PERIODE</th>
	                <th>TGL_FLG</th>
	                <th>TOTAL_CASH</th>
	                <th>TOTAL_NON_CASH</th>
	            </tr>
	        </thead>
	        <tbody>
	        	@php $no=1; @endphp
	        	@foreach($data as $datas)
		            <tr>
		                <td nowrap>{{ $datas->idnumber }}</td>
		                <td nowrap>{{ $datas->account_name }}</td>
		                <td nowrap>{{ $datas->nper }}</td>
		                <td nowrap>{{ $datas->cl_post_date }}</td>
		                <td nowrap>{{ number_format($datas->total_cash) }}</td>
		                <td nowrap>{{ number_format($datas->total_non_cash) }}</td>
		            </tr>
	            @endforeach
	        </tbody>
	    </table>
	</div>
	<br><br><br>
@endif
@endsection