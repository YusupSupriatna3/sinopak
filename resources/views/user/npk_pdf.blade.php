<html>
<head>
    <title>RINCIAN PEMBAYARAN DAN PERHITUNGAN HAK MITRA</title>
    <style>
        body {
            width:100% !important;
            margin:0 !important;
            padding:0 !important;
            line-height: 1;
            font-family: Garamond,"Times New Roman", serif;
            color: #000;
            background: none;
            font-size: 12pt; }
            /* Headings */
            h1,h2,h3,h4,h5 { page-break-after:avoid; }
            h1{font-size:19pt;}
            h2{font-size:17pt;}
            h3{font-size:15pt;}
            h4,h5,h6{font-size:12pt;}
            p, h2, h3 { orphans: 3; widows: 3; }
            code { font: 12pt Courier, monospace; }
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
            img,tr {page-break-inside: avoid;
        }
    </style>
</head>
<body>
    <div style="margin-left:50px;margin-top:50px;">
        <table>
            <tr style="font-size: 12px;">
                <td>RINCIAN PEMBAYARAN DAN PERHITUNGAN HAK MITRA</td>
            </tr>
        </table>
        <table>
            <tr style="font-size: 12px;">
                <td>NAMA CC</td>
                <td>:</td>
                <td>{{ $data->customer_name }}</td>
            </tr>
            <tr style="font-size: 12px;">
                <td>NO AKUN</td>
                <td>:</td>
                <td>{{ $data->account_number }}</td>
            </tr>
            <tr style="font-size: 12px;">
                <td>TAGIHAN</td>
                <td>:</td>
                <td>
                    {{ $data->periode }}
                    @if(!empty($data->usagee))
                        {{ '(Usage'.' '.$data->usagee.')' }}
                    @endif</td>
            </tr>
        </table>
        <table border="1px;" style="font-size: 12px;">
            <tr style="text-align: center;">
                <td rowspan="2">NO</td>
                <td rowspan="2" style="width: 350px;">URAIAN</td>
                <td rowspan="2" style="width: 110px;">Periode NPK</td>
                <td style="width: 110px;">Periode</td>
            </tr>
            <tr>
                <td style="text-align: center;width: 110px;">
                    @if(!empty($data->usagee))
                        {{ $data->usagee }}@else {{ $data->periode }}
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <span>HAK MITRA</span><br>
                    <span style="margin-left: 30px;">{{ $data->mitra_name }}</span><br>
                    <span style="margin-left: 30px;">{{ $data->pks_number }}</span><br>
                    @if(!empty($data->keterangan_download_mrc))
                        <span style="margin-left: 30px;">+ {{ $data->keterangan_download_mrc }}</span><br>
                    @elseif(!empty($data->keterangan_download_otc))
                        <span style="margin-left: 30px;">+ {{ $data->keterangan_download_otc }}</span><br>
                    @else
                        <span style="margin-left: 30px;">+ {{ $data->keterangan_download_termin }}</span><br>
                    @endif
                </td>
                <td style="text-align: center;"><br><br><br><br>
                    @if($type=='OTC')
                        {{ $data->keterangan }}
                    @elseif($type=='TERMIN')
                        {{ $data->keterangan }}
                    @else
                        <!-- bln ke {{ $data->npk_day }} dari {{ $data->npk_month }} bln -->
                        {{ $data->keterangan }}
                    @endif
                </td>
                <td style="text-align: right;"><br><br><br><br>
                    @if($type=='OTC')
                        IDR {{ number_format($value) }}
                    @elseif($type=='TERMIN')
                        IDR {{ number_format($value) }}
                    @else
                        IDR {{ number_format($value) }}
                    @endif
                </td>
            </tr>
            <tr>
                <td style="text-align: center;" colspan="3">TOTAL HAK MITRA</td>
                <td style="text-align: right;">
                    @if($type=='OTC')
                        IDR {{ number_format($value) }}
                    @elseif($type=='TERMIN')
                        IDR {{ number_format($value) }}
                    @else
                        IDR {{ number_format($value) }}
                    @endif
                </td>
            </tr>
        </table>
        <table style="font-size: 12px;">
            <tr><td>KETERANGAN :</td></tr>
            <tr><td>HAK MITRA BELUM TERMASUK PPN 10 %</td></tr>
        </table>
        <br>
        <table style="font-size: 12px;margin-left: auto;margin-right: auto;">
            <tr style="text-align:center;">
                <td><span>Mengetahui</span><br>OSM CDM</span><br><br><br><br><br><br><br>
                    <u>ARDI IMAWAN</u><br><span>NIK. 670168</span>
                </td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap></td>
                <td nowrap>
                    <span>Jakarta, {{ $tgl }}</span><br><span>MANAGER AP MANAGEMENT</span><br><br><br><br><br><br><br>
                    <u>IBNU RADHI</u><br><span>NIK. 730254</span>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>