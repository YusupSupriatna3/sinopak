<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>Surat Pernyataan Pembayaran</title>
    <style>
    /* --------------------------------------------------------------

    Hartija Css Print  Framework
    * Version:   1.0

    -------------------------------------------------------------- */

    body {
        width:100% !important;
        margin:0 !important;
        padding:0 !important;
        line-height: 1;
        font-family: Times, "Times New Roman", Georgia, serif;
        color: #000;
        background: none;
        font-size: 12pt; }

        /* Headings */
        h1,h2,h3,h4,h5 { page-break-after:avoid; }
        h1{font-size:19pt;}
        h2{font-size:17pt;}
        h3{font-size:15pt;}
        h4,h5,h6{font-size:12pt;}


        /*p, h2, h3 { orphans: 3; widows: 3; }*/

        /*code { font: 12pt Courier, monospace; }*/
        blockquote { margin: 1.2em; padding: 1em;  font-size: 12pt; }
        hr { background-color: #ccc; }

        /* Images */
        img { float: left; margin: 1em 1.5em 1.5em 0; max-width: 100% !important; }
        a img { border: none; }

        /* Links */
        a:link, a:visited { background: transparent; font-weight: 700; text-decoration: underline;color:#333; }
        a:link[href^="http://"]:after, a[href^="http://"]:visited:after { content: " (" attr(href) ") "; font-size: 90%; }

        abbr[title]:after { content: " (" attr(title) ")"; }

        /* Don't show linked images  */
        a[href^="http://"] {color:#000; }
        a[href$=".jpg"]:after, a[href$=".jpeg"]:after, a[href$=".gif"]:after, a[href$=".png"]:after { content: " (" attr(href) ") "; display:none; }

        /* Don't show links that are fragment identifiers, or use the `javascript:` pseudo protocol .. taken from html5boilerplate */
        a[href^="#"]:after, a[href^="javascript:"]:after {content: "";}

        /* Table */
        table { margin: 1px; border-collapse: collapse; }
        th { border: 1px solid #333;  font-weight: bold; text-align:center;}
        th,td { padding: 4px 10px 4px 0; }
        p { padding: 4px 10px 4px 0; }
        tfoot { font-style: italic; }
        caption { background: #fff; margin-bottom:2em; text-align:left; }
        thead {display: table-header-group;}
        img,tr {page-break-inside: avoid;}
        /*div.breakNow { page-break-inside:avoid; page-break-after:always; }*/

        /* Hide various parts from the site
        #header, #footer, #navigation, #rightSideBar, #leftSideBar
        {display:none;}
        */
        #hr2{
            /*border: 0;
            border-top: 3px double #000000;*/
            border-top: 5px double #000000;
            /*border: 5px solid black;*/
            /*border-radius: 5px;*/
        }
        .str{ mso-number-format:\@; }
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
                    <th style="text-align: center;width: 200px;" nowrap>Nama CC</th>
                    <th style="text-align: center;width: 100px;" nowrap>Akun</th>
                    <th style="text-align: center;width: 100px;" nowrap>Tagihan</th>
                    <th style="text-align: center;width: 100px;" nowrap>Tgl Flaging</th>
                    <th style="text-align: center;width: 150px;" nowrap>Jumlah Flaging</th>
                </tr>
            </thead>
            <tbody> 
                @php $no=0 @endphp
                @foreach($data as $datas)
                    @if($datas->total_cash!=0)
                        @php $no++ @endphp
                        <tr>
                            <td style="text-align: center;"><span id="acc[]">{{ $mgr['customer_name'] }}</span></td>
                            <td style="text-align: center;" nowrap><span id="nmb[]">{{ $datas->idnumber }}</span></td>
                            <td style="text-align: center" nowrap>{{ date_format(date_create(substr($datas->nper,0,4).'-'.substr($datas->nper,4,6)),"M'y") }}</td>
                            <td style="text-align: center;" nowrap>{{ date('d/m/Y',strtotime($datas->cl_post_date)) }}</td>
                            <td style="text-align: center;" nowrap>{{ number_format($datas->total_cash) }}</td>
                        </tr>

                    @if ( $no % 25 == 0 )
                    <tr>
                        <td
                        ><div style="page-break-before:always;"></div></td>
                    </tr>
                    @endif
                    @endif
                @endforeach                   
            </tbody>
        </table>
        <p></p>
        <!-- <div style="width: 50%; text-align: center; float: left;">MGR ES Collection & Debt Mgt Seg {{ $mgr['segmen'] }}</div><br><br><br><br><br>
        <div style="width: 50%; text-align: center; float: left;"><u>{{ ucwords(strtolower($mgr['manager_name'])) }}</u></div><br>
        <div style="width: 50%; text-align: center; float: left;">NIK.{{ $mgr['nik'] }}</div> -->
        <div style="width: 50%; text-align: center; float: right;">Jakarta, {{ $tgl }}</div><br>
        <div style="width: 50%; text-align: center; float: right;">MGR ES Collection & Debt Mgt Seg {{ $mgr['segmen'] }}</div><br><br><br><br><br>
        <div style="width: 50%; text-align: center; float: right;"><u>{{ ucwords(strtolower($mgr['manager_name'])) }}</u></div><br>
        <div style="width: 50%; text-align: center; float: right;">NIK.{{ $mgr['nik'] }}</div>

        <!-- <span style="margin-left: 495px;">Jakarta, {{ $tgl }}</span><br>
        <span style="margin-left: 445px;">MGR ES Collection & Debt Mgt Seg {{ $mgr['segmen'] }}</span><br><br><br><br><br><br>
        @if(ucwords(strtolower($mgr['manager_name']))=='Irma Silvia Adyatini')
            <div style="margin-left: 500px;">
            <span><u>{{ ucwords(strtolower($mgr['manager_name'])) }}</u></span><br>
            <span style="margin-left: 25px;">NIK.{{ $mgr['nik'] }}</span>
            </div>
        @elseif(ucwords(strtolower($mgr['manager_name']))=='Mhm. Thohirun')
            <div style="margin-left: 520px;">
            <span><u>{{ ucwords(strtolower($mgr['manager_name'])) }}</u></span><br>
            <span style="margin-left: 10px;">NIK.{{ $mgr['nik'] }}</span>
            </div>
        @else
            <div style="margin-left: 520px;">
            <span><u>{{ ucwords(strtolower($mgr['manager_name'])) }}</u></span><br>
            <span style="margin-left: 5px;">NIK.{{ $mgr['nik'] }}</span>
            </div>
        @endif -->
    </body>
    </html>
