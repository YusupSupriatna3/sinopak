@extends('layouts.user.app-user')

@section('content')
<br><br>
<div class="container" style="background-color: #ffb822;">
	<div class="container text-dark text-center"><strong style="font-size: 25px;">SEARCH NPK</strong></div>
	<form action="{{ route('search-npk-mkt') }}" method="post">
		@csrf
		<!-- <div class="form-row"> -->
			<div class="form-group">
				<label for="contoh2">NAMA MITRA</label>
				<select name="mitra_name" placeholder="NAMA MITRA" class="form-control periode">
					<option value=""></option>
			      @foreach($mitra_name as $mit)
			      	<option value="{{ $mit->mitra_name }}" @if(isset($mitra_namee)) @if($mitra_namee==$mit->mitra_name) {{ 'selected' }} @endif @endif>{{ $mit->mitra_name }}</option>
			      @endforeach
			    </select>
			</div>
			<div class="form-group">
				<label for="contoh2">KONTRAK LAYANAN</label>
				<select name="kl" placeholder="KONTRAK LAYANAN" class="form-control kl">
					<option value=""></option>
			      @foreach($kl as $kontrak)
			      	<option value="{{ $kontrak->pks_number }}" @if(isset($kll)) @if($kll==$kontrak->pks_number) {{ 'selected' }} @endif @endif))>{{ $kontrak->pks_number }}</option>
			      @endforeach
			    </select>
			</div>
			<div class="form-group">
				<label for="contoh2">&nbsp</label>
				<button type="submit" name="search-npk" style="background-color: #02275d;bottom: 20px;" class="btn btn-primary col-md-12 text-light"><i class="fa fa-search"></i> Search</button>
			</div>
		<!-- </div> -->
	</form>
</div>
<br><br>
@if(isset($data))
<div class="container table-responsive text-light" style="background: #02275d;border-radius: 15px;">
		<div class="container text-light text-center"><strong style="font-size: 25px;">DATA NPK</strong></div>
		<table id="example" class="table table-striped table-bordered text-light text-center" style="width:100%">
	        <thead>
                  <tr>
                    <th nowrap>No</th>
                    <th nowrap>Opsi</th>
                    <th nowrap>Month</th>
                    <th nowrap>Nama Mitra</th>
                    <th nowrap>Kontrak Layanan</th>
                    <th nowrap>Periode</th>
                    <th nowrap>Nilai Npk</th>
                    <th nowrap>Keterangan</th>
                    <th nowrap>Created_at</th>
                    <th nowrap>Updated_at</th>
                  </tr>
                </thead>
                <tbody>
                  @php $no = 1; @endphp
                  @foreach($data as $datas)
                  <tr>
                    <td nowrap>{{ $no++ }}</td>
                    <td nowrap><a href="{{ url('view-create-npk-mkt-lanjutan/'.$datas->id) }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>&nbsp&nbsp&nbsp<a href="{{ url('view-edit-npk-mkt-lanjutan/'.$datas->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>&nbsp&nbsp&nbsp<a href="{{ url('delete-npk-mkt/'.$datas->id) }}" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                    <td nowrap>{{ $datas->month }}</td>
                    <td nowrap>{{ $datas->mitra_name }}</td>
                    <td nowrap>{{ $datas->pks_number }}</td>
                    <td nowrap>{{ $datas->periode }}</td>
                    <td nowrap>{{ number_format($datas->nilai_npk) }}</td>
                    <td nowrap>{{ $datas->keterangan }}</td>
                    <td nowrap>{{ $datas->created_at }}</td>
                    <td nowrap>{{ $datas->updated_at }}</td>
                  </tr>
                  @endforeach
                </tbody>
	    </table>
	</div>
	<br><br><br>
@endif
@endsection