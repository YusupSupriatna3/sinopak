@extends('layouts.user.app-user')

@section('content')
<br><br>
<div class="container" style="background-color: #ffb822;">
	<div class="container text-dark text-center"><strong style="font-size: 25px;">SURAT PEMBAYARAN</strong></div>
	<form action="{{ route('surat-pembayaran') }}" method="post">
		@csrf
		<!-- <div class="form-row"> -->
			<div class="form-group">
				<label for="contoh1">CUSTOMER NAME</label>
				<input type="text" name="customer_name" class="form-control" id="contoh1" placeholder="CUSTOMER NAME">
			</div>
			<div class="form-group">
				<label for="contoh1">ACCOUNT</label>
				<input type="text" name="account" class="form-control acc" id="contoh1" placeholder="ACCOUNT" onchange="getSegmen(this)">
				<span id="load"></span>
			</div>
			<div class="form-group">
				<label for="contoh2">MANAGER NAME</label>
			    <input type="text" id="manager_name" name="mgr_name" class="form-control" placeholder="MANAGER NAME">
			</div>
			<div class="form-group">
				<label for="contoh1">NIK</label>
				<input type="text" id="nik" name="nik" class="form-control" id="contoh1" placeholder="NIK">
			</div>
			<div class="form-group">
				<label for="contoh1">SEGMEN</label>
				<input type="text" id="segmen" name="segmen" class="form-control" id="contoh1" placeholder="SEGMEN">
			</div>
			<div class="form-group">
				<label for="contoh2">PERIODE AWAL</label>
				<select name="periode_awal" placeholder="PERIODE AWAL" class="form-control periode">
					<?php 
						$dari = date("Y-m-d",strtotime("2008-01-01"));// tanggal mulai
			            $sampai = date("Y-m-d");// tanggal akhir
			            while (strtotime($sampai) >= strtotime($dari)) {
			                echo '<option value="'.date("Ym",strtotime($sampai)).'">'.date("Ym",strtotime($sampai)).'</option>'; 
			                $sampai = date ("Y-m-d", strtotime("-1 month", strtotime($sampai)));//looping tambah 1 date
			            }
					?>
			    </select>
			</div>
			<div class="form-group">
				<label for="contoh2">PERIODE AKHIR</label>
				<select name="periode_akhir" placeholder="PERIODE AKHIR" class="form-control periode">
					<?php 
						$dari = date("Y-m-d",strtotime("2008-01-01"));// tanggal mulai
			            $sampai = date("Y-m-d");// tanggal akhir
			            while (strtotime($sampai) >= strtotime($dari)) {
			                echo '<option value="'.date("Ym",strtotime($sampai)).'">'.date("Ym",strtotime($sampai)).'</option>'; 
			                $sampai = date ("Y-m-d", strtotime("-1 month", strtotime($sampai)));//looping tambah 1 date
			            }
					?>
			    </select>
			</div>
			<div class="form-group">
				<label for="contoh2">TYPE</label>
				<select name="type" placeholder="TYPE" class="form-control">
			      	<option value=""></option>
			      	<option value="npk">NPK</option>
			      	<!-- <option value="mkt">Marketing Fee</option> -->
			      	<option value="li">Late Input</option>
			      	<option value="fnc">Finance</option>
			    </select>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<center><button type="submit" name="cetak-pembayaran-pdf" style="background-color: #02275d;" class="btn btn-primary col-md-6 text-light"><i class="fa fa-file-pdf-o"></i> Print To PDF</button></center>
				</div>
				<div class="form-group col-md-6">
					<center><button type="submit" name="cetak-pembayaran-excel" style="background-color: #02275d;" class="btn btn-primary col-md-6 text-light"><i class="fa fa-file-excel-o"></i> Print To EXCEL</button></center>
				</div>
			</div>
		<!-- </div> -->
	</form>
</div>
<br><br><br>
@endsection