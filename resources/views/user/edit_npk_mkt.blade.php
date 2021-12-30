@extends('layouts.user.app-user')

@section('content')
<br><br>
<div class="container" style="background-color: #ffb822;">
	<div class="container text-dark text-center"><strong style="font-size: 25px;">CREATE NPK LANJUTAN MARKETING</strong></div>
	<form action="{{ route('edit-npk-mkt') }}" method="post">
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
	        	<label for="periode">Periode (<i style="color: red;" class="fa fa-asterisk"></i>)</label>
	        	<input id="periode" type="text" name="periode" class="form-control" value="{{ $data->periode }}">
	      	</div>
          	<div class="form-group">
            	<label for="nilai_npk">Nilai Npk (<i style="color: red;" class="fa fa-asterisk"></i>)</label>
            	<input id="n_npk" type="text" class="form-control" value="{{ 'Rp. '.number_format($data->nilai_npk) }}">
            	<input id="nilai_npk" type="hidden" name="nilai_npk" class="form-control">
          	</div>
          	<div class="form-group">
            	<label for="keterangan">Keterangan</label>
            	<input id="keterangan" type="text" name="keterangan" class="form-control" value="{{ $data->keterangan }}">
          	</div>
          	<input type="hidden" name="month" id="monthh" value="{{ $data->month }}">
          	<input type="hidden" name="id" id="id" value="{{ $data->id }}">
          	<div class="form-group">
				<label for="contoh2">&nbsp</label>
				<button type="submit" name="create-npk-baru-mkt-lanjutan" style="background-color: #02275d;bottom: 20px;" class="btn btn-primary col-md-12 text-light"><i class="fa fa-edit"></i> Edit</button>
			</div>
		<!-- </div> -->
	</form>
</div>
<br><br><br>
@endsection