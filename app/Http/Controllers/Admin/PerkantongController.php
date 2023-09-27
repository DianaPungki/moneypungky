<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Kategori;
use App\Models\TabKeluar;
use App\Models\TabMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class PerkantongController extends Controller
{
    public function index($kantong)
    {
        $kantongfind=Kategori::find($kantong);

        $masuk = TabMasuk::join('bank', 'tab_masuk.id_bank', '=', 'bank.id_bank')
                    ->select('tab_masuk.jumlah_masuk',DB::raw('NULL as jumlah_keluar'),'tab_masuk.nama_masuk as nama','nama_bank','nama_kat','tab_masuk.tanggal_masuk as tanggal','tab_masuk.created_at','tab_masuk.updated_at')
                 ->join('kategori', 'tab_masuk.id_kat', '=', 'kategori.id_kat')
                 ->where('kategori.id_kat',$kantong)
              ;
                 
        $keluar = TabKeluar::join('bank', 'tab_keluar.id_bank', '=', 'bank.id_bank')
                 ->select(DB::raw('NULL as jumlah_masuk'),'tab_keluar.jumlah_keluar','tab_keluar.nama_keluar as nama','nama_bank','nama_kat','tab_keluar.tanggal_keluar as tanggal','tab_keluar.created_at','tab_keluar.updated_at')
                ->join('kategori', 'tab_keluar.id_kat', '=', 'kategori.id_kat')
                 ->where('kategori.id_kat',$kantong)

                 ;
        $hasil =$masuk->union($keluar)->orderBy('tanggal','ASC')->get();
        
        $jummasuk = TabMasuk::join('bank', 'tab_masuk.id_bank', '=', 'bank.id_bank')
        ->join('kategori', 'tab_masuk.id_kat', '=', 'kategori.id_kat')
        ->where('kategori.id_kat',$kantong)
        ->sum('jumlah_masuk');

        $jumkeluar = TabKeluar::join('bank', 'tab_keluar.id_bank', '=', 'bank.id_bank')
        ->join('kategori', 'tab_keluar.id_kat', '=', 'kategori.id_kat')
        ->where('kategori.id_kat',$kantong)
        ->sum('jumlah_keluar');

        $bank = TabMasuk::leftjoin('bank', 'tab_masuk.id_bank', '=', 'bank.id_bank')
                        ->leftjoin('kategori', 'tab_masuk.id_kat', '=', 'kategori.id_kat')
                        ->select('bank.id_bank', 'bank.nama_bank', DB::raw('SUM(tab_masuk.jumlah_masuk) as jml_masuk'))                    
                        ->where('kategori.id_kat',$kantong)
                        ->groupBy('bank.id_bank','bank.nama_bank')
                        ->get();
            ;
        $data=[
            'title'     => 'Data ' . $kantongfind->nama_kat,
            'perkantong'   => $hasil,
            'jummasuk'       => $jummasuk,
            'jumkeluar'       => $jumkeluar,
            'kantong'        =>$kantongfind,
            'bank'      => $bank,
        ];
        return view('admin.kantong.perkantong', $data);
    }
}
