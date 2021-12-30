@extends('layouts.user.app-user')

@section('content')
<br><br>
<div class="container" style="background-color: #ffb822;">
	<div class="container text-dark text-center"><strong style="font-size: 25px;">SEARCH ACCOUNT</strong></div>
	<form action="{{ route('search-account') }}" method="post">
		@csrf
		<!-- <div class="form-row"> -->
			<div class="form-group">
				<label for="contoh1">SID</label>
				<input type="text" name="sid" class="form-control" id="contoh1" placeholder="SID" value="@if(isset($sid)){{ $sid }}@endif">
			</div>
			<div class="form-group">
				<label for="contoh2">ORDER ID</label>
				<input type="text" name="order_id" class="form-control" id="contoh2" placeholder="ORDER ID" value="@if(isset($order)){{ $order }}@endif">
			</div>
			<div class="form-group">
				<label for="contoh2">&nbsp</label>
				<button type="submit" name="search-account" style="background-color: #02275d;bottom: 20px;" class="btn btn-primary col-md-12 text-light"><i class="fa fa-search"></i> Seach</button>
			</div>
		<!-- </div> -->
	</form>
</div>
<br><br>
@if(isset($data))
<div class="container table-responsive text-light" style="background: #02275d;border-radius: 15px;">
		<div class="container text-light text-center"><strong style="font-size: 25px;">DATA AKUN</strong></div>
		<table id="example" class="table table-striped table-bordered text-light text-center" style="width:100%">
	        <thead>
	            <tr>
	            	<th>ROW ID</th>
	            	<th>INT ID</th>
	                <th>ORDER</th>
	                <th>ORDER TYPE</th>
	                <th>CREATED</th>
	                <th>ACCNAS</th>
	                <th>CA NAME</th>
	                <th>BA NAME</th>
	                <th>PROD NAME</th>
	                <th>SID</th>
	                <th>LI STATUS</th>
	                <th>AGREE NAME</th>
	                <th>AGREE NUM</th>
	            </tr>
	        </thead>
	        <tbody>
	        	@php $no=1; @endphp
	        	@foreach($data as $datas)
		            <tr>
		                <td nowrap>{{ $datas->asset_integ_id }}</td>
		                <td nowrap>{{ $datas->asset_integ_id }}</td>
		                <td nowrap>{{ $datas->order_id }}</td>
		                <td nowrap>{{ $datas->order_subtype }}</td>
		                <td nowrap>{{ $datas->li_created_date }}</td>
		                <td nowrap>{{ $datas->accountnas }}</td>
		                <td nowrap>{{ $datas->custaccntname }}</td>
		                <td nowrap>{{ $datas->billaccntname }}</td>
		                <td nowrap>{{ $datas->li_product_name }}</td>
		                <td nowrap>{{ $datas->li_sid }}</td>
		                <td nowrap>{{ $datas->li_status }}</td>
		                <td nowrap>{{ $datas->agree_name }}</td>
		                <td nowrap>{{ $datas->agree_itemnum }}</td>
		            </tr>
	            @endforeach
	        </tbody>
	    </table>
	</div>
	<br><br>
@endif
@endsection