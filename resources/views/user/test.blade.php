<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<style type="text/css">
	#hr2{
        /*border: 0;
        border-top: 3px double #000000;*/
        border-top: 5px double #000000;
        background-color: #ccc;
        /*border: 5px solid black;*/
        /*border-radius: 5px;*/
    }
    h5{
    	font-size: 12pt;
    	page-break-after: avoid;
    }
    table{
    	margin: 1px;
    	border-collapse: collapse;
    }
    th{
    	border: 1px solid #333;
    	font-weight: bold;
    	text-align: center;
    }
    #data{
    	text-align: center;
    }
    th,td{
    	/*padding: 4px 10px 4px 0;*/
    }
</style>
</head>
<body>
<h5><center>SURAT PERNYATAAN PEMBAYARAN CUSTOMER TELKOM</center></h5>
    <!-- <hr> -->
    <hr id="hr2">
    <p>Yang bertanda tangan di bawah ini :</p>
    <table>
        <thead>
            <tr>
                <td>Nama/NIK</td>
                <td>:</td>
                <td>{{ ucwords(strtolower($mgr['manager_name'])) }}/{{ $mgr['nik'] }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>Manager ES Collection & Debt Mgt Seg {{ $mgr['segmen'] }}</td>
            </tr>  
        </thead>
    </table>
    <span>Menyatakan bahwa customer Telkom di bawah ini telah melakukan pembayaran ke Telkom dengan rincian sebagai berikut :</span><br><br>
    <table border="1px;" style="width: 75px;">
        <thead>
            <tr style="text-align: center;">
                <th style="width: 200px;" nowrap>Nama CC</th>
                <th style="width: 100px;" nowrap>Akun</th>
                <th style="width: 120px;" nowrap>Tagihan</th>
                <th style="width: 100px;" nowrap>Tgl Flaging</th>
                <th style="width: 165px;" nowrap>Jumlah Flaging</th>
            </tr>
        </thead>
        <!-- <tbody> -->
            <!-- @php $no=0 @endphp
            @foreach($data as $datas)
                @if($datas->total_cash!=0)
                    @php $no++ @endphp
                    @if ( $no % 25 == 0 )
		                    <tr>
		                    	<td><div style="page-break-before:always;"></div></td>
		                    </tr>
                    	@endif
                    <tr>
                        <td>{{ $mgr['customer_name'] }}</td>
                        <td nowrap>{{ $datas->idnumber }}</td>
                        <td style="text-align: center" nowrap>{{ date_format(date_create(substr($datas->nper,0,4).'-'.substr($datas->nper,4,6)),"M'y") }}</td>
                        <td nowrap>{{ date('d/m/Y',strtotime($datas->cl_post_date)) }}</td>
                        <td style="text-align: right;margin-right: 2px"; nowrap>{{ number_format($datas->total_cash) }}</td>
                    </tr>
                @endif
            @endforeach  -->                  
        <!-- </tbody> -->
            <?php $itemCount=0; ?>
            <?php foreach ($data as $datas): ?>
            	<?php $itemCount++; ?>
            	<tbody>
            		<?php if ($itemCount % 25 == 0): ?>
            				<tr>
            					<td>
            						<div style="page-break-before:always;"></div>
            					</td>
            				</tr>
            			<?php endif ?>
            		<tr style="border-bottom: 1px solid #ccc; line-height: 15px;">
            			<td>{{ $mgr['customer_name'] }}</td>
                        <td nowrap>{{ $datas->idnumber }}</td>
                        <td style="text-align: center" nowrap>{{ date_format(date_create(substr($datas->nper,0,4).'-'.substr($datas->nper,4,6)),"M'y") }}</td>
                        <td nowrap>{{ date('d/m/Y',strtotime($datas->cl_post_date)) }}</td>
                        <td style="text-align: right;margin-right: 2px"; nowrap>{{ number_format($datas->total_cash) }}</td>
            		</tr>
            	</tbody>
            <?php endforeach ?>
    </table>
    <p></p>
    <div style="width: 50%; text-align: center; float: right;">Jakarta, {{ $tgl }}</div><br>
    <div style="width: 50%; text-align: center; float: right;">MGR ES Collection & Debt Mgt Seg {{ $mgr['segmen'] }}</div><br><br><br><br><br>
    <div style="width: 50%; text-align: center; float: right;"><u>{{ ucwords(strtolower($mgr['manager_name'])) }}</u></div><br>
    <div style="width: 50%; text-align: center; float: right;">NIK.{{ $mgr['nik'] }}</div>
</body>
</html>