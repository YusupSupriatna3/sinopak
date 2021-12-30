@extends('layouts.user.app-user')

@section('content')
<br><br>
<div class="container" style="background-color: #ffb822;">
	<div class="container text-dark text-center"><strong style="font-size: 25px;">SEARCH NPK</strong></div>
	<form action="{{ route('search-npk') }}" method="GET">
		{{ csrf_field() }}
		<!-- <div class="form-row"> -->
			<div class="form-group">
				<label for="contoh2">NO AKUN</label>
				<select id="account" name="account" placeholder="Account" class="form-control account">
					<option value="">NO AKUN</option>
			      @foreach($account as $acc)
			      	<option value="{{ $acc->account_number }}" @if(isset($accountt)) @if($accountt==$acc->account_number) {{ 'selected' }} @endif @endif>{{ $acc->account_number }}</option>
			      @endforeach
			    </select>
			</div>
			<div class="form-group">
				<label for="contoh2">PERIODE</label>
				<select name="periode" placeholder="PERIODE AWAL" class="form-control periode">
					<option value="">PERIODE</option>
			      @foreach($periode as $per)
			      	<option value="{{ $per->periode }}" @if(isset($periodee)) @if($periodee==$per->periode) {{ 'selected' }} @endif @endif>{{ $per->periode }}</option>
			      @endforeach
			    </select>
			</div>
			<div class="form-group">
				<label for="contoh2">KONTRAK LAYANAN</label>
				<select name="kl" placeholder="KONTRAK LAYANAN" class="form-control kl">
					<option value="">KONTRAK LAYANAN</option>
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
<br>
@if(isset($data))
		<div class="container text-light text-center col-md-12" style="background: #02275d;"><strong style="font-size: 30px;">DATA NPK</strong></div>
<div class="container col-md-12 table-responsive text-light fixed" style="background: #02275d;">
		<table id="eexample" class="table table-striped table-bordered text-light text-center" style="width:100%">
	        <thead>
                  <tr>
                    <th nowrap>No</th>
                    <th nowrap>Opsi</th>
                    <th nowrap>Month</th>
                    <th nowrap>Nama Mitra</th>
                    <th nowrap>Kontrak Layanan</th>
                    <th nowrap>Nama Customer</th>
                    <th nowrap>Nomor Akun</th>
                    <th nowrap>Segmen</th>
                    <th nowrap>Nama Manajer</th>
                    <th nowrap>Nik</th>
                    <th nowrap>Jangka Waktu Kontrak</th>
                    <th nowrap>Awal Kontrak</th>
                    <th nowrap>Akhir Kontrak</th>
                    <th nowrap>Nilai Kontrak</th>
                    <th nowrap>Periode</th>
                    <th nowrap>Usage</th>
                    <th nowrap>Curr</th>
                    <th nowrap>Nilai Npk</th>
                    <th nowrap>Tanggal Npk</th>
                    <th nowrap>Mrc</th>
                    <th nowrap>Excess Usage</th>
                    <th nowrap>Otc ke-</th>
                    <th nowrap>Otc ke-1</th>
                    <th nowrap>Otc ke-2</th>
                    <th nowrap>Otc ke-3</th>
                    <th nowrap>Otc ke-4</th>
                    <th nowrap>Otc ke-5</th>
                    <th nowrap>Termin ke-</th>
                    <th nowrap>Termin ke-1</th>
                    <th nowrap>Termin ke-2</th>
                    <th nowrap>Termin ke-3</th>
                    <th nowrap>Termin ke-4</th>
                    <th nowrap>Termin ke-5</th>
                    <th nowrap>Npk Ke-</th>
                    <th nowrap>Penalty Slg</th>
                    <th nowrap>Keterangan</th>
                    <th nowrap>Keterangan Cetak Otc</th>
                    <th nowrap>Keterangan Cetak Mrc</th>
                    <th nowrap>Keterangan Cetak Termin</th>
                    <th nowrap>Created_at</th>
                    <th nowrap>Tanggal Cetak</th>
                    <th nowrap>Updated_at</th>
                    <th nowrap>Created_by</th>
                    <th nowrap>Updated_by</th>
                    <th nowrap>Selesai</th>
                    <th nowrap>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @php $no = 1; @endphp
                  @foreach($data as $datas)
                  <tr>
                    <td nowrap>{{ $no++ }}</td>
                    <td nowrap><a href="{{ url('view-create-npk-lanjutan/'.$datas->id) }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>&nbsp&nbsp&nbsp<a href="{{ url('view-edit-npk/'.$datas->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>&nbsp&nbsp&nbsp<a target="_blank" href="{{ url('view-print-npk/'.$datas->id) }}" id="print_data" class="btn btn-success" value="{{ $datas->id }}"><i class="fa fa-print"></i></a>&nbsp&nbsp&nbsp<a href="{{ url('delete-npk/'.$datas->id) }}" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                    <td nowrap>{{ $datas->month }}</td>
                    <td nowrap>{{ $datas->mitra_name }}</td>
                    <td nowrap>{{ $datas->pks_number }}</td>
                    <td nowrap>{{ $datas->customer_name }}</td>
                    <td nowrap>{{ $datas->account_number }}</td>
                    <td nowrap align="center">{{ $datas->segmen }}</td>
                    <td nowrap>{{ $datas->manager_name }}</td>
                    <td nowrap>{{ $datas->nik }}</td>
                    <td nowrap align="center">{{ $datas->jangka_waktu_kontrak }}</td>
                    <td nowrap align="center">{{ $datas->awal_kontrak }}</td>
                    <td nowrap align="center">{{ $datas->akhir_kontrak }}</td>
                    <td nowrap>{{ number_format($datas->nilai_kontrak) }}</td>
                    <td nowrap>{{ $datas->periode }}</td>
                    <td nowrap>{{ $datas->usagee }}</td>
                    <td nowrap align="center">{{ $datas->curr_type }}</td>
                    <td nowrap>{{ number_format($datas->nilai_npk) }}</td>
                    <td nowrap align="center">{{ $datas->tanggal_npk }}</td>
                    <td nowrap>{{ number_format($datas->mrc) }}</td>
                    <td nowrap>{{ number_format($datas->nilai_excess_usage) }}</td>
                    <td nowrap>{{ $datas->otc_ke }}</td>
                    <td nowrap>{{ number_format($datas->otc1) }}</td>
                    <td nowrap>{{ number_format($datas->otc2) }}</td>
                    <td nowrap>{{ number_format($datas->otc3) }}</td>
                    <td nowrap>{{ number_format($datas->otc4) }}</td>
                    <td nowrap>{{ number_format($datas->otc5) }}</td>
                    <td nowrap>{{ $datas->termin_ke }}</td>
                    <td nowrap>{{ number_format($datas->termin1) }}</td>
                    <td nowrap>{{ number_format($datas->termin2) }}</td>
                    <td nowrap>{{ number_format($datas->termin3) }}</td>
                    <td nowrap>{{ number_format($datas->termin4) }}</td>
                    <td nowrap>{{ number_format($datas->termin5) }}</td>
                    <td nowrap>{{ $datas->npk_ke }}</td>
                    <td nowrap>{{ $datas->slg }}</td>
                    <td nowrap>{{ $datas->keterangan }}</td>
                    <td nowrap>{{ $datas->keterangan_download_otc }}</td>
                    <td nowrap>{{ $datas->keterangan_download_mrc }}</td>
                    <td nowrap>{{ $datas->keterangan_download_termin }}</td>
                    <td nowrap>{{ $datas->created_at }}</td>
                    <td nowrap>{{ $datas->tanggal_cetak }}</td>
                    <td nowrap>{{ $datas->updated_at }}</td>
                    <td nowrap>{{ $datas->created_by }}</td>
                    <td nowrap>{{ $datas->updated_by }}</td>
                    <td nowrap>{{ $datas->selesai }}</td>
                    <td nowrap>{{ $datas->status }}</td>
                  </tr>
                  @endforeach
                </tbody>
	    </table>
	</div>
	<br>
	<div class="content text-center">
	    	{{ $data->links() }}
	</div>
	<br><br>
@endif
@endsection