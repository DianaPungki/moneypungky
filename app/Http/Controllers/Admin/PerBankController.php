<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\TabKeluar;
use App\Models\TabMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PerBankController extends Controller
{
    public function index($bank)
    { 
        $masuk = TabMasuk::leftjoin('bank', 'tab_masuk.id_bank', '=', 'bank.id_bank')
                ->select('tab_masuk.jumlah_masuk',DB::raw('NULL as jumlah_keluar'),'tab_masuk.nama_masuk as nama','nama_bank','nama_kat','tab_masuk.tanggal_masuk as tanggal','tab_masuk.created_at','tab_masuk.updated_at')
                ->join('kategori', 'tab_masuk.id_kat', '=', 'kategori.id_kat')
                ->where('tab_masuk.id_bank',$bank);
                
        $keluar = TabKeluar::leftjoin('bank', 'tab_keluar.id_bank', '=', 'bank.id_bank')
                ->select(DB::raw('NULL as jumlah_masuk'),'tab_keluar.jumlah_keluar','tab_keluar.nama_keluar as nama','nama_bank','nama_kat','tab_keluar.tanggal_keluar as tanggal','tab_keluar.created_at','tab_keluar.updated_at')
                 ->join('kategori', 'tab_keluar.id_kat', '=', 'kategori.id_kat')
                 ->where('tab_keluar.id_bank',$bank);

        $hasil =$masuk->union($keluar)->orderBy('tanggal','ASC')->get();

        
        $jummasuk = $hasil->sum('jumlah_masuk');

        $jumkeluar = $hasil->sum('jumlah_keluar');

        $data=[
            'title'     => 'Data ' . $bank,
            'perbank'   => $hasil,
            'jummasuk'       => $jummasuk,
            'jumkeluar'       => $jumkeluar,
            'bank'             =>Bank::find($bank)
        ];
        return view('admin.bank.perbank', $data);
    }
}
