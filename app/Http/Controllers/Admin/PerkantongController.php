<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Kategori;
use App\Models\TabKeluar;
use App\Models\TabMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PerkantongController extends Controller
{
    public function index($kantong)
    {
        $masuk = TabMasuk::join('bank', 'tab_masuk.id_bank', '=', 'bank.id_bank')
                 ->join('kategori', 'tab_masuk.id_kat', '=', 'kategori.id_kat')
                 ->where('kategori.id_kat',$kantong)
                 ->get(); 
                 
        $keluar = TabKeluar::join('bank', 'tab_keluar.id_bank', '=', 'bank.id_bank')
                 ->join('kategori', 'tab_keluar.id_kat', '=', 'kategori.id_kat')
                 ->where('kategori.id_kat',$kantong)

                   ->get(); 
        
        $jummasuk = TabMasuk::join('bank', 'tab_masuk.id_bank', '=', 'bank.id_bank')
        ->join('kategori', 'tab_masuk.id_kat', '=', 'kategori.id_kat')
        ->where('kategori.id_kat',$kantong)
        ->sum('jumlah_masuk');

        $jumkeluar = TabKeluar::join('bank', 'tab_keluar.id_bank', '=', 'bank.id_bank')
        ->join('kategori', 'tab_keluar.id_kat', '=', 'kategori.id_kat')
        ->where('kategori.id_kat',$kantong)
        ->sum('jumlah_keluar');
        $data=[
            'title'     => 'Data ' . $kantong,
            'kantongmasuk'   => $masuk,
            'kantongkeluar'   => $keluar,
            'jummasuk'       => $jummasuk,
            'jumkeluar'       => $jumkeluar,
            'kantong'             =>Kategori::find($kantong)
        ];
        return view('admin.kantong.perkantong', $data);
    }
}
