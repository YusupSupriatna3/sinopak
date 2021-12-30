<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Npk;
use App\NpkMkt;
use App\Ncx;
use App\Pembayaran;
use App\Oi;
use PDF;
use App\Exports\SuratPembayaranExport;
use App\Exports\NpkExport;
use App\Exports\NpkMktExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\notification;
use Session;
use App\DashboardPembayaran;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use DateTime;

class NpkController extends Controller
{
    public function viewSearchAccount(Request $request)
    {
        return view('user/search_account');
    }
    public function searchAccount(Request $request)
    {
        if (empty($request->sid)) {
            $sid='';
        }else{
            $sid= $request->sid;
        }

        if (empty($request->order_id)) {
            $order='';
        }else{
            $order= $request->order_id;
        }
      $data = Ncx::where('li_sid',$sid)->orWhere('order_id',$order)->orderBy('LI_CREATED_DATE','DESC')->get();
        return view('user/search_account',compact('data','sid','order'));
    }
    public function viewCekPembayaran()
    {
        $periode = Pembayaran::distinct()->select('nper')->orderBy('nper','DESC')->get();
        return view('user/data_pembayaran',compact('periode'));
    }
    public function cekPembayaran(Request $request)
    {
        $periode = Pembayaran::distinct()->select('nper')->orderBy('nper','DESC')->get();
        $account = $request->account;
        $periode_awal = $request->periode_awal;
        $periode_akhir = $request->periode_akhir;
        $data = Pembayaran::select('cl_id','idnumber','account_name','nper','cl_hkont','cl_post_date',
                        DB::raw('sum(total_cash) as total_cash'),
                        DB::raw('sum(total_non_cash) as total_non_cash'))
                        ->where('idnumber','=',$account)->where('total_cash','!=',0)
                        ->whereNotNull('cl_hkont')->whereBetween('nper',[$periode_awal,$periode_akhir])
                        ->groupBy('cl_id','idnumber','account_name','nper','cl_hkont','cl_post_date')
                        ->orderBy('nper','ASC')->get();
        return view('user/data_pembayaran',compact('periode','account','periode_awal','periode_akhir','data'));
    }

    public function cetakPembayaran(Request $request)
    {
        return view('user/cetak_pembayaran');
    }
    public function suratPembayaran(Request $request)
    {
        $account = $request->account;
        $periode_awal = $request->periode_awal;
        $periode_akhir = $request->periode_akhir;
        $tgl = Carbon::now()->translatedFormat('d F Y');
        $mgr = array(
            'manager_name' => $request->mgr_name,
            'nik' => $request->nik,
            'segmen' => $request->segmen,
            'customer_name' => $request->customer_name,
            'account_number' => $request->account
        );
        $tamp= (object) $mgr;
        if (!empty($request->type)) {
            $data = array(
                        'id' => null,
                        'month' => date('Ym'),
                        'customer_name' => $request->customer_name,
                        'account_number' => $request->account,
                        'manager_name' => $request->mgr_name,
                        'nik' => $request->nik,
                        'segmen' => $request->segmen,
                        'periode_awal' => $request->periode_awal,
                        'periode_akhir' => $request->periode_akhir,
                        'type' => $request->type,
                        'created_at' => date('Y-m-d H:i:s')
                    );
            if ($request->type=='npk') {
                $insert = DashboardPembayaran::insert($data);
                if(isset($_POST["cetak-pembayaran-pdf"])){
                    $data = Pembayaran::select('cl_id','idnumber','account_name','nper','cl_hkont','cl_post_date',
                            DB::raw('sum(total_cash) as total_cash'),
                            DB::raw('sum(total_non_cash) as total_non_cash'))
                            ->where('idnumber','=',$account)
                            ->where('total_cash','!=',0)
                            ->whereNotNull('cl_hkont')
                            ->whereBetween('nper',[$periode_awal,$periode_akhir])
                            ->groupBy('cl_id','idnumber','account_name','nper','cl_hkont','cl_post_date')
                            ->orderBy('nper','ASC')->get();
                    $pdf = PDF::loadview('user/surat_pembayaran',compact('data','tgl','mgr'));
                    return $pdf->stream($mgr['customer_name']."-".$mgr['account_number'].".pdf");
                }else{
                    return Excel::download(new SuratPembayaranExport($account,$periode_awal,$periode_akhir), 'SuratPembayaran.xlsx');
                }
            }elseif($request->type=='mkt'){
                $insert = DashboardPembayaran::insert($data);
                if(isset($_POST["cetak-pembayaran-pdf"])){
                    $data = Pembayaran::select('cl_id','idnumber','account_name','nper','cl_hkont','cl_post_date',
                            DB::raw('sum(total_cash) as total_cash'),
                            DB::raw('sum(total_non_cash) as total_non_cash'))
                            ->where('idnumber','=',$account)
                            ->where('total_cash','!=',0)
                            ->whereNotNull('cl_hkont')
                            ->whereBetween('nper',[$periode_awal,$periode_akhir])
                            ->groupBy('cl_id','idnumber','account_name','nper','cl_hkont','cl_post_date')
                            ->orderBy('nper','ASC')->get();
                    $pdf = PDF::loadview('user/surat_pembayaran',compact('data','tgl','mgr'));
                    return $pdf->stream($mgr['customer_name']."-".$mgr['account_number'].".pdf");
                }else{
                    return Excel::download(new SuratPembayaranExport($account,$periode_awal,$periode_akhir), 'SuratPembayaran.xlsx');
                }
            }elseif($request->type=='li'){
                $insert = DashboardPembayaran::insert($data);
                if(isset($_POST["cetak-pembayaran-pdf"])){
                    $data = Pembayaran::select('cl_id','idnumber','account_name','nper','cl_hkont','cl_post_date',
                            DB::raw('sum(total_cash) as total_cash'),
                            DB::raw('sum(total_non_cash) as total_non_cash'))
                            ->where('idnumber','=',$account)
                            ->where('total_cash','!=',0)
                            ->whereNotNull('cl_hkont')
                            ->whereBetween('nper',[$periode_awal,$periode_akhir])
                            ->groupBy('cl_id','idnumber','account_name','nper','cl_hkont','cl_post_date')
                            ->orderBy('nper','ASC')->get();
                    $pdf = PDF::loadview('user/surat_pembayaran',compact('data','tgl','mgr'));
                   return $pdf->stream($mgr['customer_name']."-".$mgr['account_number'].".pdf");
                }else{
                    return Excel::download(new SuratPembayaranExport($account,$periode_awal,$periode_akhir), 'SuratPembayaran.xlsx');
                }
            }elseif($request->type=='fnc'){
                $insert = DashboardPembayaran::insert($data);
                if(isset($_POST["cetak-pembayaran-pdf"])){
                    $data = Pembayaran::select('cl_id','idnumber','account_name','nper','cl_hkont','cl_post_date',
                            DB::raw('sum(total_cash) as total_cash'),
                            DB::raw('sum(total_non_cash) as total_non_cash'))
                            ->where('idnumber','=',$account)
                            ->where('total_cash','!=',0)
                            ->whereNotNull('cl_hkont')
                            ->whereBetween('nper',[$periode_awal,$periode_akhir])
                            ->groupBy('cl_id','idnumber','account_name','nper','cl_hkont','cl_post_date')
                            ->orderBy('nper','ASC')->get();
                    $pdf = PDF::loadview('user/surat_pembayaran',compact('data','tgl','mgr'));
                    return $pdf->stream($mgr['customer_name']."-".$mgr['account_number'].".pdf");
                }else{
                    return Excel::download(new SuratPembayaranExport($account,$periode_awal,$periode_akhir), 'SuratPembayaran.xlsx');
                }
            }
        }else{
            if(isset($_POST["cetak-pembayaran-pdf"])){
                $data = Pembayaran::select('cl_id','idnumber','account_name','nper','cl_hkont','cl_post_date',
                        DB::raw('sum(total_cash) as total_cash'),
                        DB::raw('sum(total_non_cash) as total_non_cash'))
                        ->where('idnumber','=',$account)
                        ->where('total_cash','!=',0)
                        ->whereNotNull('cl_hkont')
                        ->whereBetween('nper',[$periode_awal,$periode_akhir])
                        ->groupBy('cl_id','idnumber','account_name','nper','cl_hkont','cl_post_date')
                        ->orderBy('nper','ASC')->get();
                $itemCount = 0;
                $html = "";
                foreach ($data as $datas) {
                    $itemCount++;
                    $html .= '<tbody> <tr style="border-bottom: 1px solid #ccc; line-height: 15px;">';

                    if ($itemCount % 25 == 0) {
                        $html .= '<tr><td><div style="page-break-before: always;"></div></td></tr>';
                    }

                    $html .= '<td>'.$datas['customer_name'].'</td>';
                    $html .= '<td>'.$datas['idnumber'].'</td>';
                    $html .= '<td>'.date_format(date_create(substr($datas['nper'],0,4).'-'.substr($datas['nper'],4,6)),"M'y").'</td>';
                    $html .= '<td>'.date('d/m/Y',strtotime($datas['cl_post_date'])).'</td>';
                    $html .= '<td>'.number_format($datas['total_cash']).'</td>';

                    $html .= '</tr> </tbody>';
                }
                $pdf = PDF::loadview('user/surat_pembayaran',compact('data','tgl','mgr'));
                return $pdf->stream($mgr['customer_name']."-".$mgr['account_number'].".pdf");
            }else{
                return Excel::download(new SuratPembayaranExport($account,$periode_awal,$periode_akhir), 'SuratPembayaran.xlsx');
            }
        }
    }
    public function exportToExcel()
    {
        return Excel::download(new NpkExport(), 'DataNpk.xlsx');
    }
    public function exportToExcelMkt()
    {
        return Excel::download(new NpkMktExport(), 'DataNpkMkt.xlsx');
    }
    public function viewCreateNpk()
    {
        return view('user/create_npk_baru');
    }
    public function viewDataNpk()
    {
        $account = Npk::distinct()->select('account_number')->get();
        $periode = Npk::distinct()->select('periode')->get();
        $kl = Npk::distinct()->select('pks_number')->get();
        $data = Npk::orderBy('id','DESC')->paginate();
        return view('user/data_npk',compact('account','periode','kl','data'));
    }
    public function createNpk(Request $request)
    {
        if (!empty($request->termin1)) {
            $termin1 = $request->termin1;
            $npk = $request->termin1;
        }else{
            $termin1 = 0;
        }

        if (!empty($request->termin2)) {
            $termin2 = $request->termin2;
            $npk = $request->termin2;
        }else{
            $termin2 = 0;
        }

        if (!empty($request->termin3)) {
            $termin3 = $request->termin3;
            $npk = $request->termin3;
        }else{
            $termin3 = 0;
        }

        if (!empty($request->termin4)) {
            $termin4 = $request->termin4;
            $npk = $request->termin4;
        }else{
            $termin4 = 0;
        }

        if (!empty($request->termin5)) {
            $termin5 = $request->termin5;
            $npk = $request->termin5;
        }else{
            $termin5 = 0;
        }

        $mr=0;
        $mr1=0;
        if (!empty($request->mrc)) {
            for ($i=0; $i < count($request->addmore)-1; $i++) {
                if (!empty($request->addmore[$i])) {
                    if (count($request->addmore)-1==1) {
                        if (!empty($request->addmore0[$i]) && !empty($request->addmore[$i]) && !empty($request->addmore1[$i]) && !empty($request->addmore2[$i]) && !empty($request->addmore3[$i])) {
                            $mr += $request->addmore0[$i]-(($request->addmore[$i]*$request->addmore1[$i])*($request->addmore2[$i]/$request->addmore3[$i]));
                        }
                    }else {
                        if (!empty($request->addmore0[$i]) && !empty($request->addmore[$i]) && !empty($request->addmore1[$i]) && !empty($request->addmore2[$i]) && !empty($request->addmore3[$i])) {
                            $mr += ($request->addmore[$i]*$request->addmore1[$i]);
                            $mr1 += (($request->addmore[$i]*$request->addmore1[$i]*$request->addmore2[$i]/$request->addmore3[$i]));
                        }
                    }
                }else{
                    $mrc = $request->mrc;
                    $npk = $request->nilai_npk;
                }
            }
            if (!empty($request->addmore[0])) {
                if (count($request->addmore)-1==1) {
                    $mrc = round($mr,0);
                    $npk = round($mr,0);
                }else {
                    $mrc = round($request->mrc-$mr-$mr1,0);
                    $npk = round($request->mrc-$mr-$mr1,0);
                }
            }else{
                $mrc = $request->mrc;
                $npk = $request->nilai_npk;
            }
        }else{
            $mrc = 0;
        }

    if (!empty($request->otc1)) {
        if (!empty($request->hargaunit) && !empty($request->jmlnon)) {
            $otc1 = $request->otc1-($request->hargaunit*$request->jmlnon);
            $npk = $request->otc1-($request->hargaunit*$request->jmlnon);
        }else{
            $otc1 = $request->otc1;
            $npk = $request->nilai_npk;
        }
    }else{
        $otc1 = 0;
    }
    if (!empty($request->otc2)) {
        if (!empty($request->hargaunit) && !empty($request->jmlnon)) {
            $otc2 = $request->otc2-($request->hargaunit*$request->jmlnon);
            $npk = $request->otc2-($request->hargaunit*$request->jmlnon);
        }else{
            $otc2 = $request->otc2;
            $npk = $request->nilai_npk;
        }
    }else{
        $otc2 = 0;
    }

    if (!empty($request->otc3)) {
        if (!empty($request->hargaunit) && !empty($request->jmlnon)) {
            $otc3 = $request->otc3-($request->hargaunit*$request->jmlnon);
            $npk = $request->otc3-($request->hargaunit*$request->jmlnon);
        }else{
            $otc3 = $request->otc3;
            $npk = $request->nilai_npk;
        }
    }else{
        $otc3 = 0;
    }

    if (!empty($request->otc4)) {
        if (!empty($request->hargaunit) && !empty($request->jmlnon)) {
            $otc4 = $request->otc4-($request->hargaunit*$request->jmlnon);
            $npk = $request->otc4-($request->hargaunit*$request->jmlnon);
        }else{
            $otc4 = $request->otc4;
            $npk = $request->nilai_npk;
        }
    }else{
        $otc4 = 0;
    }

    if (!empty($request->otc5)) {
        if (!empty($request->hargaunit) && !empty($request->jmlnon)) {
            $otc5 = $request->otc5-($request->hargaunit*$request->jmlnon);
            $npk = $request->otc5-($request->hargaunit*$request->jmlnon);
        }else{
            $otc5 = $request->otc5;
            $npk = $request->nilai_npk;
        }
    }else{
        $otc5 = 0;
    }

    if (!empty($request->slg)) {
        $slg = $request->slg;
        $npk = $npk-$slg;
        $mrc = $mrc-$slg;
    }else{
        $slg = 0;
    }

    if (!empty($request->otc_ke)) {
        $otc_ke = $request->otc_ke;
    }else{
        $otc_ke = 0;
    }

    if (!empty($request->termin_ke)) {
        $termin_ke = $request->termin_ke;
    }else{
        $termin_ke = 0;
    }

    if (!empty($request->hargalokasi)) {
        $hargalokasi = $request->hargalokasi;
    }else{
        $hargalokasi = 0;
    }

    if (!empty($request->jmlhari)) {
        $jmlhari = $request->jmlhari;
    }else{
        $jmlhari = 0;
    }

    if (!empty($request->jmlbln)) {
        $jmlbln = $request->jmlbln;
    }else{
        $jmlbln = 0;
    }

    if (!empty($request->periode_bulan_usage)) {
        $usage = $request->periode_bulan_usage;
    }else {
        $usage ='';
    }

    if (empty($request->nilai_kontrak)) {
        $nilai_kontrak = 0;
    }else {
        $nilai_kontrak = $request->nilai_kontrak;
    }

    if (!empty($request->status)) {
        $status = $request->status;
        $data = array(
          'status' => $request->status
        );
      $update = Npk::where('pks_number',$request->pks_number)->update($data);
    }else {
        $status = '';
    }

    if (!empty($request->nilai_excess_usage)) {
        $nilai_excess_usage = $request->nilai_excess_usage;
        $data = array(
          'nilai_excess_usage' => $request->nilai_excess_usage
        );
    }else {
        $nilai_excess_usage = '';
    }    
    $mytime = Carbon::now();
    $data = array(
        'id' =>null,
        'month' => $request->month,
        'mitra_name' => $request->mitra_name,
        'pks_number' => $request->pks_number,
        'customer_name' => $request->customer_name,
        'account_number' => $request->account_number,
        'segmen' => $request->segmen,
        'manager_name' => $request->manager_name,
        'nik' => $request->nik,
        'jangka_waktu_kontrak' => $request->jangka_waktu_kontrak.' '.'bulan',
        'awal_kontrak' => $request->awal_kontrak,
        'akhir_kontrak' => $request->akhir_kontrak,
        'nilai_kontrak' => $nilai_kontrak,
        'periode' => $request->periode_bulan,
        'usagee' => $usage,
        'curr_type' => $request->curr_type,
        'nilai_npk' => $npk,
        'tanggal_npk' => $request->tanggal_npk,
        'mrc' => $mrc,
        'otc_ke' => $otc_ke,
        'otc1' => $otc1,
        'otc2' => $otc2,
        'otc3' => $otc3,
        'otc4' => $otc4,
        'otc5' => $otc5,
        'termin_ke' => $termin_ke,
        'termin1' => $termin1,
        'termin2' => $termin2,
        'termin3' => $termin3,
        'termin4' => $termin4,
        'termin5'=> $termin5,
        'slg' => $slg,
        'qty' => $hargalokasi,
        'jumlah_hari' => $jmlhari,
        'jumlah_bulan' => $jmlbln,
        'npk_ke' => $request->npk_day.'/'.$request->npk_month,
        'npk_day' => $request->npk_day,
        'npk_month' => $request->npk_month,
        'keterangan' => $request->keterangan,
        'keterangan_download_otc' => '',
        'keterangan_download_mrc' => '',
        'keterangan_download_termin' => '',
        'created_at' => $mytime->toDateTimeString(),
        'created_by' => Auth::user()->username.'_'.Auth::user()->name,
        'status'=> $status,
        'updated_by' => '',
        'nilai_excess_usage' => $nilai_excess_usage
    );

      $insert = Npk::insert($data);

      if ($insert) {
        \notification('sukses','Data Berhasil Di Tambahkan !!!');
        return redirect('view-data-npk');
      }else{
        \notification('warning','Data Gagal Di Tambahkan !!!');
        return redirect('view-data-npk');
      }
    }
    public function searchNpk(Request $request)
    {
        $accountt = $request->account;
        $periodee = $request->periode;
        $kll = $request->kl;
        $account = Npk::distinct()->select('account_number')->get();
        $periode = Npk::distinct()->select('periode')->get();
        $kl = Npk::distinct()->select('pks_number')->get();
        $data = Npk::where(function ($query) use ($accountt,$periodee,$kll){
          $query->where('account_number','like','%'.$accountt.'%')->where('periode','like','%'.$periodee.'%')->where('pks_number','like','%'.$kll.'%');
        })->orderBy('id','DESC')->paginate();
        $data->appends($request->only('account','period','kl'));
        return view('user/data_npk',compact('account','periode','kl','accountt','periodee','kll','data'));
    }
    public function viewCreateNpkLanjutan($id)
    {
        $data = Npk::findOrFail($id);
        return view('user/create_npk_baru_lanjutan',compact('data'));
    }
    public function viewEditNpk($id)
    {
        $data = Npk::findOrFail($id);
        return view('user/edit_npk',compact('data'));
    }
    public function editNpk(Request $request)
    {

        if (!empty($request->termin1)) {
            $termin1 = $request->termin1;
            $npk = $request->termin1;
        }else{
            $termin1 = 0;
        }

        if (!empty($request->termin2)) {
            $termin2 = $request->termin2;
            $npk = $request->termin2;
        }else{
            $termin2 = 0;
        }

        if (!empty($request->termin3)) {
            $termin3 = $request->termin3;
            $npk = $request->termin3;
        }else{
            $termin3 = 0;
        }

        if (!empty($request->termin4)) {
            $termin4 = $request->termin4;
            $npk = $request->termin4;
        }else{
            $termin4 = 0;
        }

        if (!empty($request->termin5)) {
            $termin5 = $request->termin5;
            $npk = $request->termin5;
        }else{
            $termin5 = 0;
        }

        $mr=0;
        $mr1=0;
        if (!empty($request->mrc)) {
            for ($i=0; $i < count($request->addmore)-1; $i++) {
                if (!empty($request->addmore[$i])) {
                    if (count($request->addmore)-1==1) {
                        if (!empty($request->addmore0[$i]) && !empty($request->addmore[$i]) && !empty($request->addmore1[$i]) && !empty($request->addmore2[$i]) && !empty($request->addmore3[$i])) {
                            $mr += $request->addmore0[$i]-(($request->addmore[$i]*$request->addmore1[$i])*($request->addmore2[$i]/$request->addmore3[$i]));
                        }
                    }else {
                        if (!empty($request->addmore0[$i]) && !empty($request->addmore[$i]) && !empty($request->addmore1[$i]) && !empty($request->addmore2[$i]) && !empty($request->addmore3[$i])) {
                            $mr += ($request->addmore[$i]*$request->addmore1[$i]);
                            $mr1 += (($request->addmore[$i]*$request->addmore1[$i]*$request->addmore2[$i]/$request->addmore3[$i]));
                        }
                    }
                }else{
                    $mrc = $request->mrc;
                    $npk = $request->nilai_npk;
                }
            }
            if (!empty($request->addmore[0])) {
                if (count($request->addmore)-1==1) {
                    $mrc = round($mr,0);
                    $npk = round($mr,0);
                }else {
                    $mrc = round($request->mrc-$mr-$mr1,0);
                    $npk = round($request->mrc-$mr-$mr1,0);
                }
            }else{
                $mrc = $request->mrc;
                $npk = $request->nilai_npk;
            }
        }else{
            $mrc = 0;
        }

    if (!empty($request->otc1)) {
        if (!empty($request->hargaunit) && !empty($request->jmlnon)) {
            $otc1 = $request->otc1-($request->hargaunit*$request->jmlnon);
            $npk = $request->otc1-($request->hargaunit*$request->jmlnon);
        }else{
            $otc1 = $request->otc1;
            $npk = $request->nilai_npk;
        }
    }else{
        $otc1 = 0;
    }
    if (!empty($request->otc2)) {
        if (!empty($request->hargaunit) && !empty($request->jmlnon)) {
            $otc2 = $request->otc2-($request->hargaunit*$request->jmlnon);
            $npk = $request->otc2-($request->hargaunit*$request->jmlnon);
        }else{
            $otc2 = $request->otc2;
            $npk = $request->nilai_npk;
        }
    }else{
        $otc2 = 0;
    }

    if (!empty($request->otc3)) {
        if (!empty($request->hargaunit) && !empty($request->jmlnon)) {
            $otc3 = $request->otc3-($request->hargaunit*$request->jmlnon);
            $npk = $request->otc3-($request->hargaunit*$request->jmlnon);
        }else{
            $otc3 = $request->otc3;
            $npk = $request->nilai_npk;
        }
    }else{
        $otc3 = 0;
    }

    if (!empty($request->otc4)) {
        if (!empty($request->hargaunit) && !empty($request->jmlnon)) {
            $otc4 = $request->otc4-($request->hargaunit*$request->jmlnon);
            $npk = $request->otc4-($request->hargaunit*$request->jmlnon);
        }else{
            $otc4 = $request->otc4;
            $npk = $request->nilai_npk;
        }
    }else{
        $otc4 = 0;
    }

    if (!empty($request->otc5)) {
        if (!empty($request->hargaunit) && !empty($request->jmlnon)) {
            $otc5 = $request->otc5-($request->hargaunit*$request->jmlnon);
            $npk = $request->otc5-($request->hargaunit*$request->jmlnon);
        }else{
            $otc5 = $request->otc5;
            $npk = $request->nilai_npk;
        }
    }else{
        $otc5 = 0;
    }

    if (!empty($request->slg)) {
        $slg = $request->slg;
        $npk = $npk-$slg;
        $mrc = $mrc-$slg;
    }else{
        $slg = 0;
    }

    if (!empty($request->otc_ke)) {
        $otc_ke = $request->otc_ke;
    }else{
        $otc_ke = 0;
    }

    if (!empty($request->termin_ke)) {
        $termin_ke = $request->termin_ke;
    }else{
        $termin_ke = 0;
    }

    if (!empty($request->hargalokasi)) {
        $hargalokasi = $request->hargalokasi;
    }else{
        $hargalokasi = 0;
    }

    if (!empty($request->jmlhari)) {
        $jmlhari = $request->jmlhari;
    }else{
        $jmlhari = 0;
    }

    if (!empty($request->jmlbln)) {
        $jmlbln = $request->jmlbln;
    }else{
        $jmlbln = 0;
    }

    if (!empty($request->periode_bulan_usage)) {
        $usage = $request->periode_bulan_usage;
    }else {
        $usage ='';
    }

    if (empty($request->nilai_kontrak)) {
        $nilai_kontrak = 0;
    }else {
        $nilai_kontrak = $request->nilai_kontrak;
    }

    if (!empty($request->status)) {
        $status = $request->status;
        $data = array(
          'status' => $request->status
        );
      $update = Npk::where('pks_number',$request->pks_number)->update($data);
    }else {
        $status = '';
    }

    if (!empty($request->nilai_excess_usage)) {
        $nilai_excess_usage = $request->nilai_excess_usage;
        $data = array(
          'nilai_excess_usage' => $request->nilai_excess_usage
        );
    }else {
        $nilai_excess_usage = '';
    }
    $mytime = Carbon::now();
    $id = $request->id;
    $data = array(
        'month' => $request->month,
        'mitra_name' => $request->mitra_name,
        'pks_number' => $request->pks_number,
        'customer_name' => $request->customer_name,
        'account_number' => $request->account_number,
        'segmen' => $request->segmen,
        'manager_name' => $request->manager_name,
        'nik' => $request->nik,
        'jangka_waktu_kontrak' => $request->jangka_waktu_kontrak.' '.'bulan',
        'awal_kontrak' => $request->awal_kontrak,
        'akhir_kontrak' => $request->akhir_kontrak,
        'nilai_kontrak' => $nilai_kontrak,
        'periode' => $request->periode_bulan,
        'usagee' => $usage,
        'curr_type' => $request->curr_type,
        'nilai_npk' => $npk,
        'tanggal_npk' => $request->tanggal_npk,
        'mrc' => $mrc,
        'otc_ke' => $otc_ke,
        'otc1' => $otc1,
        'otc2' => $otc2,
        'otc3' => $otc3,
        'otc4' => $otc4,
        'otc5' => $otc5,
        'termin_ke' => $termin_ke,
        'termin1' => $termin1,
        'termin2' => $termin2,
        'termin3' => $termin3,
        'termin4' => $termin4,
        'termin5'=> $termin5,
        'slg' => $slg,
        'qty' => $hargalokasi,
        'jumlah_hari' => $jmlhari,
        'jumlah_bulan' => $jmlbln,
        'npk_ke' => $request->npk_day.'/'.$request->npk_month,
        'npk_day' => $request->npk_day,
        'npk_month' => $request->npk_month,
        'keterangan' => $request->keterangan,
        'updated_at' => $mytime->toDateTimeString(),
        'status' => $status,
        'updated_by' => Auth::user()->username.'_'.Auth::user()->name,
        'nilai_excess_usage' => $nilai_excess_usage
    );

      $update = Npk::where('id',$id)->update($data);

      if ($update) {
        \notification('sukses','Data Berhasil Di Ubah !!!');
        return redirect('view-data-npk');
      }else{
        \notification('warning','Data Gagal Di Ubah !!!');
        return redirect('view-data-npk');
      }
    }
    public function viewPrintNpk($id)
    {
        $data = Npk::findOrFail($id);

        if (!empty($data->otc_ke)) {
            $type = 'OTC';
            if (!empty($data->otc1)) {
                $value = $data->otc1;
            }
            if (!empty($data->otc2)) {
                $value = $data->otc2;
            }
            if (!empty($data->otc3)) {
                $value = $data->otc3;
            }
            if (!empty($data->otc4)) {
                $value = $data->otc4;
            }
        }
        if (!empty($data->npk_day)) {
            $type = 'MRC';
            $value = $data->mrc;
        }
        if (!empty($data->termin_ke)) {
            $type = 'TERMIN';
            if (!empty($data->termin1)) {
                $value = $data->termin1;
            }
            if (!empty($data->termin2)) {
                $value = $data->termin2;
            }
            if (!empty($data->termin3)) {
                $value = $data->termin3;
            }
            if (!empty($data->termin4)) {
                $value = $data->termin4;
            }
            if (!empty($data->termin5)) {
                $value = $data->termin5;
            }
        }
        $tgl = Carbon::now()->translatedFormat('d F Y');
        return view('user/preview_npk',compact('data','tgl','type','value'));
    }
    public function printNpk(Request $request,$id)
    {

        $mytime = Carbon::now();
        $my = $mytime->toDateTimeString();
        $tgl1 = new DateTime(date('Y-m-d',strtotime($request->created)));
        $tgl2 = new DateTime(date('Y-m-d',strtotime($my)));
        $d = $tgl2->diff($tgl1)->days + 1;
        $type = $request->type;
        if ($type=='MRC') {
            $data = array(
            'keterangan_download_mrc' => $request->ktr,
            'tanggal_cetak' => $mytime->toDateTimeString(),
            'updated_by' => Auth::user()->username.'_'.Auth::user()->name,
            'selesai' => $d
            );
        }elseif ($type=='OTC') {
            $data = array(
              'keterangan_download_otc' => $request->ktr,
              'tanggal_cetak' => $mytime->toDateTimeString(),
              'updated_by' => Auth::user()->username.'_'.Auth::user()->name,
              'selesai' => $d
            );
        }else {
            $data = array(
              'keterangan_download_termin' => $request->ktr,
              'tanggal_cetak' => $mytime->toDateTimeString(),
              'updated_by' => Auth::user()->username.'_'.Auth::user()->name,
              'selesai' => $d
            );
        }
        $value = $request->value;

        $update = Npk::where('id',$id)->update($data);
        if ($update) {
            $data = Npk::findOrFail($id);
        }

        $tgl = Carbon::now()->translatedFormat('d F Y');
        $pdf = PDF::loadview('user/npk_pdf',compact('data','tgl','type','value'));
        if (empty($data->usagee)) {
            return $pdf->stream($data->customer_name."-".$data->account_number."-".$data->periode);
        }else{
            return $pdf->stream($data->customer_name."-".$data->account_number."-".$data->periode."(".$data->usagee.")");
        }
    }
    public function delete($id)
    {
      $delete = Npk::where('id',$id)->delete();
        if ($delete) {
          \notification('sukses','Data Berhasil Di Hapus !!!');
          return redirect('view-data-npk');
        }else {
          \notification('warning','Data Gagal Di Hapus !!!');
          return redirect('view-data-npk');
        }
    }
    public function viewDataNpkMkt()
    {
        $data = NpkMkt::all();
        $kl = NpkMkt::distinct()->select('pks_number')->orderBy('pks_number','ASC')->get();
        $mitra_name = NpkMkt::distinct()->select('mitra_name')->orderBy('mitra_name','ASC')->get();
        return view('user/data_npk_mkt',compact('data','kl','mitra_name'));
    }
    public function viewCreateNpkMkt()
    {
        return view('user/create_npk_baru_mkt');
    }
    public function createNpkMkt(Request $request)
    {
        $data = array(
        'id' =>null,
        'month' => $request->month,
        'mitra_name' => $request->mitra_name,
        'pks_number' => $request->pks_number,
        'periode' => $request->periode,
        'nilai_npk' => $request->nilai_npk,
        'keterangan' => $request->keterangan,
        'created_at' => date('Y-m-d H:i:s', mktime(date("H") + 7, date("i"), date("s"), date("m"), date("d"), date("Y")))
      );

        $insert = NpkMkt::insert($data);

        if ($insert) {
          \notification('sukses','Data Berhasil Di Tambahkan !!!');
          return redirect('view-data-npk-mkt');
        }else{
          \notification('warning','Data Gagal Di Tambahkan !!!');
          return redirect('view-data-npk-mkt');
        }
    }
    public function searchNpkMkt(Request $request)
    {
        $mitra_namee = $request->mitra_name;
        $kll = $request->kl;
        $data = NpkMkt::where(function ($query) use ($mitra_namee,$kll){
                        $query->where('mitra_name','like','%'.$mitra_namee.'%')->where('pks_number','like','%'.$kll.'%');
      })->orderBy('id','DESC')->get();
      $kl = NpkMkt::distinct()->select('pks_number')->orderBy('pks_number','ASC')->get();
      $mitra_name = NpkMkt::distinct()->select('mitra_name')->orderBy('mitra_name','ASC')->get();
      return view('user/data_npk_mkt',compact('data','mitra_name','mitra_namee','kl','kll'));
    }
    public function viewCreateNpkMktLanjutan($id)
    {
        $data = NpkMkt::findOrFail($id);
        return view('user/create_npk_baru_mkt_lanjutan',compact('data'));
    }

    public function viewEditNpkMkt($id)
    {
        $data = NpkMkt::findOrFail($id);
        return view('user/edit_npk_mkt',compact('data'));
    }
    public function editNpkMkt(Request $request)
    {
        $id = $request->id;
        $data = array(
          'month' => $request->monthh,
          'mitra_name' => $request->mitra_namee,
          'pks_number' => $request->pks_numberr,
          'periode' => $request->periode_bulann,
          'nilai_npk' => $request->nilai_npkk,
          'keterangan' => $request->keterangann,
          'updated_at' => date('Y-m-d H:i:s', mktime(date("H") + 7, date("i"), date("s"), date("m"), date("d"), date("Y")))
        );

      $update = NpkMkt::where('id',$id)->update($data);

      if ($update) {
        \notification('sukses','Data Berhasil Di Ubah !!!');
        return redirect('view-data-npk-mkt');
      }else{
        \notification('warning','Data Gagal Di Ubah !!!');
        return redirect('view-data-npk-mkt');
      }
    }
    public function deleteNpk($id)
    {
      $delete = NpkMkt::where('id',$id)->delete();
        if ($delete) {
          \notification('sukses','Data Berhasil Di Hapus !!!');
          return redirect('view-data-npk-mkt');
        }else {
          \notification('warning','Data Gagal Di Hapus !!!');
          return redirect('view-data-npk-mkt');
        }
    }
    public function searchSegmen($account)
    {

        $data = Oi::where('akun',$account)->get();
        
        return json_encode($data);
    }
}
