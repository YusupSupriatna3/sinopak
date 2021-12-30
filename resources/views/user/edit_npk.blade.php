@extends('layouts.user.app-user')

@section('content')
<br><br>
<div class="container" style="background-color: #ffb822;">
	<div class="container text-dark text-center"><strong style="font-size: 25px;">EDIT NPK</strong></div>
	<form action="{{ route('edit-npk') }}" method="post">
		@csrf
		<!-- <div class="form-row"> -->
			<div class="form-group">
        		<label for="mitra_name">Mitra Name (<i style="color: red;" class="fa fa-asterisk"></i>)</label>
        		<input id="mitra_name" type="text" name="mitra_name" class="form-control" value="{{ $data->mitra_name }}">
      		</div>
	      	<div class="form-group">
	        	<label for="pks_number">Pks Number (<i style="color: red;" class="fa fa-asterisk"></i>)</label>
	        	<input id="pks_number" type="text" name="pks_number" class="form-control" value="{{ $data->pks_number }}">
	      	</div>
	      	<div class="form-group" id="pksList"></div>
	      	<div class="form-group">
	        	<label for="customer_name">Customer Name (<i style="color: red;" class="fa fa-asterisk"></i>)</label>
	        	<input id="customer_name" type="text" name="customer_name" class="form-control" value="{{ $data->customer_name }}">
	      	</div>
	      	<div class="form-group">
	        	<label for="account_number">Account Number (<i style="color: red;" class="fa fa-asterisk"></i>)</label>
	        	<input id="account_number" type="text" name="account_number" class="form-control" value="{{ $data->account_number }}">
	        	<div id="accountList"></div>
	      	</div>
	      	<div class="form-group">
	        	<label for="segmen">Segmen (<i style="color: red;" class="fa fa-asterisk"></i>)</label>
	        	<!-- <input id="segmen" type="text" name="segmen" class="form-control"> -->
	        	<select id="segmen" name="segmen" class="form-control periode" placeholder="SEGMEN">
	              	<option value=""></option>
	              	<option value="A" <?php if ($data->segmen=='A'): ?>
	              		selected
	              	<?php endif ?>>A</option>
	              	<option value="B" <?php if ($data->segmen=='B'): ?>
	              		selected
	              	<?php endif ?>>B</option>
	              	<option value="C" <?php if ($data->segmen=='C'): ?>
	              		selected
	              	<?php endif ?>>C</option>
	        	</select>
	      	</div>
	      	<div class="form-group">
	        	<label for="manager_name">Manager Name (<i style="color: red;" class="fa fa-asterisk"></i>)</label>
	        	<input id="manager_name" type="text" name="manager_name" class="form-control" value="{{ $data->manager_name }}">
	      	</div>
	      	<div class="form-group">
	        	<label for="nik">Nik (<i style="color: red;" class="fa fa-asterisk"></i>)</label>
	        	<input id="nik" type="text" name="nik" class="form-control" value="{{ $data->nik }}">
	      	</div>
	      	<div class="form-group">
	        	<label for="jangka_waktu_kontrak">Jangka Waktu Kontrak (<i style="color: red;" class="fa fa-asterisk"></i>)</label>
	        	<input id="jangka_waktu_kontrak" onkeyup="jangka_waktu()" type="text" name="jangka_waktu_kontrak" class="form-control" value="{{ $data->npk_month }}">
	      	</div>
	      	<div class="form-group">
	        	<label for="nilai_kontrak">Nilai Kontrak (<i style="color: red;" class="fa fa-asterisk"></i>)</label>
	        	<input id="nk" type="text" class="form-control" value="{{ 'Rp. '.number_format($data->nilai_kontrak) }}">
	        	<input id="nilai_kontrak" type="hidden" name="nilai_kontrak" class="form-control" value="{{ $data->nilai_kontrak }}">
	      	</div>
	      	<div class="form-row">
	      		<div class="form-group col-md-6">
	      			<label for="awal_kontrak">Awal Kontrak (<i style="color: red;" class="fa fa-asterisk"></i>)</label>
              		<input id="awal_kontrak" type="text" name="awal_kontrak" class="form-control input-date" value="{{ $data->awal_kontrak }}" />
	      		</div>
	      		<div class="form-group col-md-6">
	      			<label for="akhir_kontrak">Akhir Kontrak (<i style="color: red;" class="fa fa-asterisk"></i>)</label>
              		<input id="akhir_kontrak" type="text" name="akhir_kontrak" class="form-control input-date" value="{{ $data->akhir_kontrak }}" />
	      		</div>
	      	</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="periode_bulan">Periode (Bulan) (<i style="color: red;" class="fa fa-asterisk"></i>)</label>
                    <input id="periode_bulan" type="text" name="periode_bulan" class="form-control input-datee" value="{{ $data->periode }}">
				</div>
				<div class="form-group col-md-6">
					<label for="periode_bulan_usage">Periode (Bulan Usage)</label>
                    <input id="periode_bulan_usage" type="text" name="periode_bulan_usage" class="form-control input-datee" value="{{ $data->usagee }}">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group">
					<input type="radio" name="otc" value="tr1" <?php if ($data->otc_ke==1): ?>
						checked
					<?php endif ?>> <span><strong>Otc 1</strong></span>
                      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="radio" name="otc" value="tr2" <?php if ($data->otc_ke==2): ?>
						checked
					<?php endif ?>> <span><strong>Otc 2</strong></span>
                      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="radio" name="otc" value="tr3" <?php if ($data->otc_ke==3): ?>
						checked
					<?php endif ?>> <span><strong>Otc 3</strong></span>
                      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="radio" name="otc" value="tr4" <?php if ($data->otc_ke==4): ?>
						checked
					<?php endif ?>> <span><strong>Otc 4</strong></span>
                      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="radio" name="otc" value="tr5" <?php if ($data->otc_ke==5): ?>
						checked
					<?php endif ?>> <span><strong>Otc 5</strong></span>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-4" id="hide1">
					<label>Otc Ke-1</label>
					<input id="otccc1" type="text" class="form-control" value="@if($data->otc1 != '0'){{ 'Rp. '.number_format($data->otc1) }}@else 'Rp. 0'@endif">
                    <input id="otc1" type="hidden" name="otc1" class="form-control" value="@if($data->otc1 != '0'){{ $data->otc1 }}@else 0 @endif">
				</div>
				<div class="form-group  col-md-4" id="hide2">
					<label>Otc Ke-2</label>
					<input id="otccc2" type="text" class="form-control" value="@if($data->otc2 != '0'){{ 'Rp. '.number_format($data->otc2) }}@else 'Rp. 0'@endif">
                    <input id="otc2" type="hidden" name="otc2" class="form-control" value="@if($data->otc2 != '0'){{ $data->otc2 }}@else 0 @endif">
				</div>
				<div class="form-group col-md-4" id="hide3">
					<label>Otc Ke-3</label>
                    <input id="otccc3" type="text" class="form-control" value="@if($data->otc3 != '0'){{ 'Rp. '.number_format($data->otc3) }}@else 'Rp. 0'@endif">
                    <input id="otc3" type="hidden" name="otc3" class="form-control" value="@if($data->otc3 != '0'){{ $data->otc3 }}@else 0 @endif">
				</div>
				<div class="form-group col-md-4" id="hide4">
                    <label>Otc Ke-4</label>
                    <input id="otccc4" type="text" class="form-control" value="@if($data->otc4 != '0'){{ 'Rp. '.number_format($data->otc4) }}@else 'Rp. 0'@endif">
                    <input id="otc4" type="hidden" name="otc4" class="form-control" value="@if($data->otc4 != '0'){{ $data->otc4 }}@else 0 @endif">
				</div>
				<div class="form-group col-md-4" id="hide5">
                    <label>Otc Ke-5</label>
                    <input id="otccc5" type="text" class="form-control" value="@if($data->otc5 != '0'){{ 'Rp. '.number_format($data->otc5) }}@else 'Rp. 0'@endif">
                    <input id="otc5" type="hidden" name="otc5" class="form-control" value="@if($data->otc5 != '0'){{ $data->otc5 }}@else 0 @endif">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group">
					<input type="radio" name="termin" value="tr1" <?php if ($data->termin_ke==1): ?>
						checked
					<?php endif ?>> <span><strong>Termin 1</strong></span>
                      &nbsp&nbsp&nbsp<input type="radio" name="termin" value="tr2" <?php if ($data->termin_ke==2): ?>
						checked
					<?php endif ?>> <span><strong>Termin 2</strong></span>
                      &nbsp&nbsp&nbsp<input type="radio" name="termin" value="tr3" <?php if ($data->termin_ke==3): ?>
						checked
					<?php endif ?>> <span><strong>Termin 3</strong></span>
                      &nbsp&nbsp&nbsp<input type="radio" name="termin" value="tr4" <?php if ($data->termin_ke==4): ?>
						checked
					<?php endif ?>> <span><strong>Termin 4</strong></span>
                      &nbsp&nbsp&nbsp<input type="radio" name="termin" value="tr5" <?php if ($data->termin_ke==5): ?>
						checked
					<?php endif ?>> <span><strong>Termin 5</strong></span>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-4" id="hide6">
					<label>Termin Ke-1</label>
	                <input id="terminnn1" type="text" class="form-control" value="@if($data->termin1 != '0'){{ 'Rp. '.number_format($data->termin1) }}@else 'Rp. 0'@endif">
	                <input id="termin1" type="hidden" name="termin1" class="form-control" value="@if($data->termin1 != '0'){{$data->termin1 }}@else 0 @endif">
				</div>
				<div class="form-group col-md-4" id="hide7">
					<label>Termin Ke-2</label>
                    <input id="terminnn2" type="text" class="form-control" value="@if($data->termin2 != '0'){{ 'Rp. '.number_format($data->termin2) }}@else 'Rp. 0'@endif">
                    <input id="termin2" type="hidden" name="termin2" class="form-control" value="@if($data->termin2 != '0'){{$data->termin2 }}@else 0 @endif">
				</div>
				<div class="form-group col-md-4" id="hide8">
					<label>Termin Ke-3</label>
                    <input id="terminnn3" type="text" class="form-control" value="@if($data->termin3 != '0'){{ 'Rp. '.number_format($data->termin3) }}@else 'Rp. 0'@endif">
                    <input id="termin3" type="hidden" name="termin3" class="form-control" value="@if($data->termin3 != '0'){{$data->termin3 }}@else 0 @endif">
				</div>
				<div class="form-group col-md-4" id="hide9">
					<label>Termin Ke-4</label>
                    <input id="terminnn4" type="text" class="form-control" value="@if($data->termin4 != '0'){{ 'Rp. '.number_format($data->termin4) }}@else 'Rp. 0'@endif">
                    <input id="termin4" type="hidden" name="termin4" class="form-control" value="@if($data->termin4 != '0'){{$data->termin4 }}@else 0 @endif">
				</div>
				<div class="form-group col-md-4" id="hide10">
					<label>Termin Ke-5</label>
                    <input id="terminnn5" type="text" class="form-control" value="@if($data->termin5 != '0'){{ 'Rp. '.number_format($data->termin5) }}@else 'Rp. 0'@endif">
                    <input id="termin5" type="hidden" name="termin5" class="form-control" value="@if($data->termin5 != '0'){{$data->termin5 }}@else 0 @endif">
				</div>
			</div>
			<div class="form-group">
            	<label for="mrc">Mrc</label>
            	<input id="mrccc" type="text" class="form-control" value="{{ 'Rp. '.number_format($data->mrc) }}">
            	<input id="mrc" type="hidden" name="mrc" class="form-control" value="{{ $data->mrc }}">
          	</div>
			<div class="form-group">
				<label for="status">Nilai Excess Usage</label>
				<input id="exccc" type="text" class="form-control" value="{{ 'Rp. '.number_format($data->nilai_excess_usage) }}">
				<input id="exc" type="hidden" name="nilai_excess_usage" class="form-control" value="{{ $data->nilai_excess_usage }}">
			</div>
          	<div class="form-group">
            	<label for="curr_type">Currency Type (<i style="color: red;" class="fa fa-asterisk"></i>)</label>
            	<input id="curr_type" type="text" name="curr_type" class="form-control"  value="{{ $data->curr_type }}">
          	</div>
          	<div class="form-group">
            	<label for="nilai_npk">Nilai Npk (<i style="color: red;" class="fa fa-asterisk"></i>)</label>
            	<input id="n_npk" type="text" class="form-control"  value="{{ 'Rp. '.number_format($data->nilai_npk) }}">
            	<input id="nilai_npk" type="hidden" name="nilai_npk" class="form-control" value="{{ $data->nilai_npk }}">
          	</div>
          	<div class="form-group">
            	<label for="tanggal_npk">Tanggal Npk (<i style="color: red;" class="fa fa-asterisk"></i>)</label>
            	<input id="tanggal_npk" type="text" name="tanggal_npk" class="form-control input-date"  value="{{ $data->tanggal_npk }}">
          	</div>
          	<div class="form-row">
          		<div class="form-group col-md-6">
          			<label for="npk_ke">Npk-ke (<i style="color: red;" class="fa fa-asterisk"></i>)</label>
                    <input id="npk_ke" type="text" name="npk_day" class="form-control"  value="{{ $data->npk_day }}">
          		</div>
          		<div class="form-group col-md-6">
          			<label for="npk_month">Dari Jangka Waktu (<i style="color: red;" class="fa fa-asterisk"></i>)</label>
                    <input id="npk_month" type="text" name="npk_month" class="form-control"  value="{{ $data->npk_month }}">
          		</div>
          	</div>
          	<div class="form-group">
            	<label for="keterangan">Keterangan</label>
            	<input id="keterangan" type="text" name="keterangan" class="form-control"  value="{{ $data->keterangan }}">
          	</div>
          	<div class="form-row">
				<div class="form-group">
					<label for="status">Status Kontrak</label>
					<input type="checkbox" name="status" value="Selesai"> <span><strong>Selesai</strong></span>
				</div>
			</div>
          	<div class="form-row">
          		<span>Faktor Pengurang Mrc <i>(Silahkan Isi Jika Ada Faktor Pengurang Mrc)</i></span>
          	</div>
          	<div class="form-row after-add-more">
          		<div class="form-group col-md-12">
                    <label for="slg">Penalty Slg</label>
                    <input id="slggg" type="text" class="form-control" placeholder="Penalty Slg">
                    <input id="slg" type="hidden" name="slg" class="form-control" placeholder="Penalty Slg">
          		</div>
          		<div class="form-group col-md-4">
                    <label>Total Harga/Bulan</label>
                    <input id="addmore0" type="text" name="addmore0[]" class="form-control" placeholder="Total Harga/Bulan">    
                </div>
                <div class="form-group col-md-4">
                    <label>Quantity</label>
                    <input type="text" name="addmore[]" class="form-control" placeholder="Quantity">    
                </div>
                <div class="form-group col-md-4">
                    <label>Harga/Unit</label>
                    <input id="addmore1" type="text" name="addmore1[]" class="form-control" placeholder="Harga/Unit">
                </div>
                <div class="form-group col-md-4">
                    <label>Jumlah Hari Tidak Aktif</label>
                    <input type="text" name="addmore2[]" class="form-control" placeholder="Jumlah Hari Tidak Aktif">    
                </div>
                <div class="form-group col-md-4">
                    <label>Jumlah Hari dalam 1 Bulan</label>
                    <input type="text" name="addmore3[]" class="form-control" placeholder="Jumlah Hari dalam 1 Bulan">
                </div>
                <div class="form-group col-md-4">
                	<label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                    <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                </div>
          	</div>
          	<div class="copy hide">
	          	<div class="form-row control-group">
	          		<div class="form-group col-md-4">
	                    <label>Total Harga/Bulan</label>
	                    <input id="addmore0" type="text" name="addmore0[]" class="form-control" placeholder="Total Harga/Bulan">    
	                </div>
	                <div class="form-group col-md-4">
	                    <label>Quantity</label>
	                    <input type="text" name="addmore[]" class="form-control" placeholder="Quantity">    
	                </div>
	                <div class="form-group col-md-4">
	                    <label>Harga/Unit</label>
	                    <input id="addmore1" type="text" name="addmore1[]" class="form-control" placeholder="Harga/Unit">
	                </div>
	                <div class="form-group col-md-4">
	                    <label>Jumlah Hari Tidak Aktif</label>
	                    <input type="text" name="addmore2[]" class="form-control" placeholder="Jumlah Hari Tidak Aktif">    
	                </div>
	                <div class="form-group col-md-4">
	                    <label>Jumlah Hari dalam 1 Bulan</label>
	                    <input type="text" name="addmore3[]" class="form-control" placeholder="Jumlah Hari dalam 1 Bulan">
	                </div>
	                <div class="form-group col-md-4"> 
	                	<label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
	                    <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Del</button>
	                </div>
	          	</div>
          	</div>
          	<div class="form-row">
          		<span>Faktor Pengurang Otc <i>(Silahkan Isi Jika Ada Faktor Pengurang Otc)</i></span>
          	</div>
          	<div class="form-row">
          		<div class="form-group col-md-6">
                    <label>Harga/Unit</label>
                    <input id="hrg_unit" type="text" placeholder="Harga/Unit" class="form-control">
                    <input id="hargaunit" type="hidden" name="hargaunit" placeholder="Harga/Unit" class="form-control">
          		</div>
          		<div class="form-group col-md-6">
                    <label>Jumlah Tidak Aktif</label>
                    <input type="text" name="jmlnon" placeholder="Jumlah Tidak Aktif" class="form-control">
          		</div>
          	</div>
          	<input type="hidden" name="month" id="monthh" value="{{ $data->month }}">
        	<input type="hidden" name="termin_ke" id="termin_ke" value="{{ $data->termin_ke }}">
        	<input type="hidden" name="otc_ke" id="otc_ke" value="{{ $data->otc_ke }}">
        	<input type="hidden" name="id" id="id" value="{{ $data->id }}">
          	<div class="form-group">
				<label for="contoh2">&nbsp</label>
				<button type="submit" name="edit-npk" style="background-color: #02275d;bottom: 20px;" class="btn btn-primary col-md-12 text-light"><i class="fa fa-edit"></i> Edit</button>
			</div>
		<!-- </div> -->
	</form>
</div>
<br><br><br>
@endsection