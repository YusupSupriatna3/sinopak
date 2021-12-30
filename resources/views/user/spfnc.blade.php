@extends('layouts.user.app-user')

@section('content')
<br><br>
	<div class="container">
		<nav class="nav nav-pills">
			<a style="background-color: #EBECF1;border-radius: 15px 50px 30px 5px;" class="nav-link text-secondary" href="{{ url('home') }}"><strong>AP Management</strong></a>
			<a style="background-color: #EBECF1;border-radius: 15px 50px 30px 5px;" class="nav-link text-secondary" href="{{ url('marketing') }}"><strong>Marketing Fee</strong></a>
            <a style="background-color: #02275d;border-radius: 15px 50px 30px 5px;" class="nav-link active text-light" href="{{ url('pembayaran') }}"><strong>Surat Pembayaran</strong></a>
		</nav>
	</div>
	<br>
    <div class="container alert alert-elevate alert-light alert-bold" style="border: 2px solid #ffb822 ;box-shadow: 0 0 0 rgba(204,169,44, 0.4); animation: pulse 1s infinite;">
        <nav class="nav nav-pills">
            <span style="padding-left: 200px;"><a style="background-color: #EBECF1;border-radius: 15px 50px 30px 5px;" class="nav-link text-secondary" href="{{ url('spnpk') }}"><strong>AP Management</strong></a></span>
            <!-- <span style="padding-left: 150px;"><a style="background-color: #EBECF1;border-radius: 15px 50px 30px 5px;" class="nav-link text-secondary" href="{{ url('spmkt') }}"><strong>Marketing Fee</strong></a></span> -->
            <span style="padding-left: 150px;"><a style="background-color: #EBECF1;border-radius: 15px 50px 30px 5px;" class="nav-link text-secondary" href="{{ url('spli') }}"><strong>Late Input</strong></a></span>
            <span style="padding-left: 150px;"><a style="background-color: #02275d;border-radius: 15px 50px 30px 5px;" class="nav-link active text-light" href="{{ url('spfnc') }}"><strong>Finance</strong></a></span>
        </nav>
    </div>
    <br>
	<!-- <div class="container" style="background-color: #ffb822;">
        <form action="{{ route('search-dashboard-periode') }}" method="post">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="contoh1">Periode Awal</label>
                    <input type="text" name="periode_awal" class="form-control input-dateee" id="contoh1" placeholder="Periode Awal" value="@if(isset($p_awal)){{ $p_awal }}@endif">
                </div>
                <div class="form-group col-md-4">
                    <label for="contoh2">Periode Akhir</label>
                    <input type="text" name="periode_akhir" class="form-control input-dateee" id="contoh2" placeholder="Periode Akhir" value="@if(isset($p_akhir)){{ $p_akhir }}@endif">
                </div>
                <div class="form-group col-md-4">
                    <label for="contoh2">&nbsp</label>
                    <button type="submit" name="search-mkt" style="background-color: #02275d;" class="btn btn-primary col-md-12 text-light"><i class="fa fa-search"></i> Seach</button>
                </div>
            </div>
        </form>
    </div> -->
    <br>
    <div class="container container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <div class="card text-white text-center border-danger" style="border-radius: 15px 50px 30px;background-color: #ff4800;">
                    <div class="card-header">
                        <strong style="font-size: 20px;">Customer</strong>
                    </div>
                 
                    <div class="card-body">
                        <strong style="font-size: 20px;">{{ $customer }}</strong>
                    </div>
                 
                    <div class="card-footer">
                        @if(isset($prd_awal) && isset($prd_akhir))
                        {{ $prd_awal }} - {{ $prd_akhir }}
                        @else
                        -
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white text-center border-danger" style="border-radius: 15px 50px 30px;background-color: #3c096c;">
                    <div class="card-header">
                        <strong style="font-size: 20px;">Surat Pembayaran</strong>
                    </div>
                 
                    <div class="card-body">
                        <strong style="font-size: 20px;">{{ $sp }}</strong>
                    </div>
                 
                    <div class="card-footer">
                        @if(isset($prd_awal) && isset($prd_akhir))
                        {{ $prd_awal }} - {{ $prd_akhir }}
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
        <div class="container text-light text-center"><strong style="font-size: 25px;">DATA SURAT PEMBAYARAN CUSTOMER</strong></div>
        <table id="example" class="table table-striped table-bordered text-light text-center" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Customer</th>
                    <th>Jumlah Surat Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @php $no=1; @endphp
                @foreach($data as $datas)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td><a class="text-light" href="sp-customer/{{ $datas->customer_name }}">{{ $datas->customer_name }}</a></td>
                        <td>{{ $datas->jumlah_sp }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br><br><br>
@endsection