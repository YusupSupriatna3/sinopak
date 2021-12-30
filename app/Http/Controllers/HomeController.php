<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Npk;
use App\NpkMkt;
use App\DashboardPembayaran;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->hasRole('user')) {
        	$kl = Npk::distinct()->count('pks_number');
        	$mitra = Npk::distinct()->count('mitra_name');
        	$npk = Npk::count('id');
        	$nilai_npk = Npk::whereNULL('status')->whereNULL('nilai_excess_usage')->sum('nilai_npk');
            $n_npk = Npk::whereNotNull('nilai_excess_usage')->sum('nilai_npk');
        	$jumlah_kontrak = Npk::distinct()->whereNULL('status')->sum('nilai_kontrak');
            $jml_kontrak = Npk::distinct()->where('status','=','Selesai')->sum('nilai_kontrak');
        	$data = Npk::distinct()->select('mitra_name', 
              DB::raw('count(distinct pks_number) as jumlah_kl'),
              DB::raw('count(distinct customer_name) as jumlah_customer'),
              DB::raw('sum(distinct nilai_kontrak) as jumlah_kontrak'),
              DB::raw('sum(nilai_npk) as jumlah_npk'))
            ->orderBy('mitra_name', 'ASC')->groupBy('mitra_name')->get();
            $selesai = Npk::where('status','=','Selesai')->distinct()->count('pks_number');
            $Belum_Selesai = Npk::distinct()->whereNULL('status')->count('pks_number');
            $periode_awal= 0;
            $periode_akhir= 0;
            $tamp = array(
                    'kl' => $kl,
                    'mitra' => $mitra,
                    'npk' => $npk,
                    'nilai_npk' => $nilai_npk,
                    'n_npk' => $n_npk,
                    'jumlah_kontrak' => $jumlah_kontrak,
                    'jml_kontrak' => $jml_kontrak,
                    'selesai' => $selesai,
                    'Belum_Selesai' => $Belum_Selesai,
                    'periode_awal' => $periode_awal,
                    'periode_akhir' => $periode_akhir,
            );
        	return view('user/index',compact('data','tamp'));
        }

        if ($request->user()->hasRole('admin')) {
        	return redirect('admin');
        }
    }
    public function marketingDashboard(Request $request)
    {
    	$kl = NpkMkt::distinct()->count('pks_number');
        $mitra = NpkMkt::distinct()->count('mitra_name');
        $npk = NpkMkt::count('mitra_name');
        $nilai_npk = NpkMkt::sum('nilai_npk');
        $data = NpkMkt::distinct()->select('mitra_name', 
              DB::raw('count(distinct pks_number) as jumlah_kl'),
              DB::raw('sum(nilai_npk) as jumlah_npk'))
            ->orderBy('mitra_name', 'ASC')->groupBy('mitra_name')->get();
    	return view('user/marketing',compact('customer','sp','data','mitra','kl','npk','nilai_npk'));
    }
    public function searchDashboardPeriode(Request $request)
    {
    	if (isset($_POST['search-ap'])) {
    		$periode_awal = Carbon::parse($request->periode_awal)->translatedFormat('Ym');
    		$periode_akhir = Carbon::parse($request->periode_akhir)->translatedFormat('Ym');
    		$prd_awal = Carbon::parse($request->periode_awal)->translatedFormat('F Y');
    		$prd_akhir = Carbon::parse($request->periode_akhir)->translatedFormat('F Y');
    		$kl = Npk::distinct()->whereBetween('month', [$periode_awal, $periode_akhir])->count('pks_number');
        	$mitra = Npk::distinct()->whereBetween('month', [$periode_awal, $periode_akhir])->count('mitra_name');
        	$npk = Npk::whereBetween('month', [$periode_awal, $periode_akhir])->count('mitra_name');
        	$nilai_npk = Npk::whereBetween('month', [$periode_awal, $periode_akhir])->sum('nilai_npk');
            $n_npk = Npk::where('nilai_excess_usage','=','Ya')->whereBetween('month', [$periode_awal, $periode_akhir])->sum('nilai_npk');
        	$jumlah_kontrak = Npk::distinct()->whereBetween('month', [$periode_awal, $periode_akhir])->sum('nilai_kontrak');
            $jml_kontrak = Npk::distinct()->where('status','=','Selesai')->whereBetween('month', [$periode_awal, $periode_akhir])->sum('nilai_kontrak');
        	$data = Npk::distinct()->select('mitra_name', 
              DB::raw('count(distinct pks_number) as jumlah_kl'),
              DB::raw('count(distinct customer_name) as jumlah_customer'),
              DB::raw('sum(distinct nilai_kontrak) as jumlah_kontrak'),
              DB::raw('sum(nilai_npk) as jumlah_npk'))->whereBetween('month', [$periode_awal, $periode_akhir])
            ->orderBy('mitra_name', 'ASC')->groupBy('mitra_name')->get();
            $p_awal = $request->periode_awal;
            $p_akhir = $request->periode_akhir;
            $selesai = Npk::where('status','Selesai')->distinct()->whereBetween('month', [$periode_awal, $periode_akhir])->count('pks_number');
            $Belum_Selesai = Npk::where('status',null)->distinct()->whereBetween('month', [$periode_awal, $periode_akhir])->count('pks_number');
            $tamp = array(
                    'kl' => $kl,
                    'mitra' => $mitra,
                    'npk' => $npk,
                    'nilai_npk' => $nilai_npk,
                    'n_npk' => $n_npk,
                    'jumlah_kontrak' => $jumlah_kontrak,
                    'jml_kontrak' => $jml_kontrak,
                    'selesai' => $selesai,
                    'Belum_Selesai' => $Belum_Selesai,
                    'periode_awal' => $periode_awal,
                    'periode_akhir' => $periode_akhir,
                    'prd_awal' => $prd_awal,
                    'prd_akhir' => $prd_akhir,
                    'p_awal' => $p_awal,
                    'p_akhir' => $p_akhir,
            );
            return view('user/index',compact('data','tamp'));
    	}else{
    		$periode_awal = Carbon::parse($request->periode_awal)->translatedFormat('Ym');
    		$periode_akhir = Carbon::parse($request->periode_akhir)->translatedFormat('Ym');
    		$prd_awal = Carbon::parse($request->periode_awal)->translatedFormat('F Y');
    		$prd_akhir = Carbon::parse($request->periode_akhir)->translatedFormat('F Y');
    		$kl = NpkMkt::distinct()->whereBetween('month', [$periode_awal, $periode_akhir])->count('pks_number');
	        $mitra = NpkMkt::distinct()->whereBetween('month', [$periode_awal, $periode_akhir])->count('mitra_name');
	        $npk = NpkMkt::whereBetween('month', [$periode_awal, $periode_akhir])->count('mitra_name');
	        $nilai_npk = NpkMkt::whereBetween('month', [$periode_awal, $periode_akhir])->sum('nilai_npk');
	        $data = NpkMkt::distinct()->select('mitra_name', 
                DB::raw('count(distinct pks_number) as jumlah_kl'),
                DB::raw('sum(nilai_npk) as jumlah_npk'))
                ->whereBetween('month', [$periode_awal, $periode_akhir])->orderBy('mitra_name', 'ASC')->groupBy('mitra_name')->get();
            $p_awal = $request->periode_awal;
            $p_akhir = $request->periode_akhir;
            $selesai = Npk::where('status','Selesai')->distinct()->count('pks_number');
            $Belum_Selesai = Npk::where('status',null)->distinct()->count('pks_number');
            return view('user/marketing',compact('kl','mitra','npk','nilai_npk','data','p_awal','p_akhir','prd_awal','prd_akhir','selesai','Belum_Selesai','periode_awal','periode_akhir'));
    	}
    }
    public function getKlMitra($mitra,$periode_awal,$periode_akhir)
    {
        if (($periode_awal !=0) && ($periode_akhir !=0)) {
            $datas = Npk::distinct()->select('pks_number','nilai_kontrak',
                DB::raw('count(pks_number) as jml_kl'),
                DB::raw('count(keterangan_download_otc) as jml_otc'),
                DB::raw('count(keterangan_download_termin) as jml_termin'),
                DB::raw('sum(nilai_npk) as nilai_npk'))->whereBetween('month', [$periode_awal, $periode_akhir])->where('mitra_name',$mitra)->groupBy('pks_number','nilai_kontrak')->get();
            return view('user/kl_mitra',compact('datas'));    
        } else {
            $datas = Npk::distinct()->select('pks_number','nilai_kontrak',
                DB::raw('count(pks_number) as jml_kl'),
                DB::raw('count(keterangan_download_otc) as jml_otc'),
                DB::raw('count(keterangan_download_termin) as jml_termin'),
                DB::raw('sum(nilai_npk) as nilai_npk'))->where('mitra_name',$mitra)->groupBy('pks_number','nilai_kontrak')->get();
            return view('user/kl_mitra',compact('datas'));
        }
    }
    public function getKlMitraMkt($mitra)
    {
    	$data = NpkMkt::distinct()->select('pks_number',
            DB::raw('count(pks_number) as jumlah_pks'),
            DB::raw('sum(nilai_npk) as jumlah_npk'))->where('mitra_name',$mitra)->groupBy('pks_number')->get();
    	return view('user/kl_mitra_mkt',compact('data'));
    }
    public function SuratPembayaranDashboard()
    {
        $customer = DashboardPembayaran::distinct()->where('type', 'npk')->count('customer_name');
        $sp = DashboardPembayaran::where('type', 'npk')->count('customer_name');
        $data = DashboardPembayaran::distinct()->select('customer_name', 
              DB::raw('count(customer_name) as jumlah_sp'))
            ->where('type', 'npk')
            ->orderBy('customer_name', 'ASC')->groupBy('customer_name')->get();
        return view('user/spnpk',compact('customer','sp','data'));
    }
    public function SuratPembayaranDashboardMkt()
    {
        $customer = DashboardPembayaran::distinct()->where('type', 'mkt')->count('customer_name');
        $sp = DashboardPembayaran::where('type', 'mkt')->count('customer_name');
        $data = DashboardPembayaran::distinct()->select('customer_name', 
              DB::raw('count(customer_name) as jumlah_sp'))
            ->where('type', 'mkt')
            ->orderBy('customer_name', 'ASC')->groupBy('customer_name')->get();
        return view('user/spmkt',compact('customer','sp','data'));
    }
    public function SuratPembayaranDashboardLi()
    {
        $customer = DashboardPembayaran::distinct()->where('type', 'li')->count('customer_name');
        $sp = DashboardPembayaran::where('type', 'li')->count('customer_name');
        $data = DashboardPembayaran::distinct()->select('customer_name', 
              DB::raw('count(customer_name) as jumlah_sp'))
            ->where('type', 'li')
            ->orderBy('customer_name', 'ASC')->groupBy('customer_name')->get();
        return view('user/spli',compact('customer','sp','data'));
    }
    public function SuratPembayaranDashboardFnc()
    {
        $customer = DashboardPembayaran::distinct()->where('type', 'fnc')->count('customer_name');
        $sp = DashboardPembayaran::where('type', 'fnc')->count('customer_name');
        $data = DashboardPembayaran::distinct()->select('customer_name', 
              DB::raw('count(customer_name) as jumlah_sp'))
            ->where('type', 'fnc')
            ->orderBy('customer_name', 'ASC')->groupBy('customer_name')->get();
        return view('user/spfnc',compact('customer','sp','data'));
    }
    public function getSpCustomer($customer)
    {
        $datas = DashboardPembayaran::where('customer_name',$customer)->get();
        return view('user/sp_customer',compact('datas'));
    }
}
