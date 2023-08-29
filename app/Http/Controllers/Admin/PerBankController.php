<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\TabKeluar;
use App\Models\TabMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PerBankController extends Controller
{
    public function index($bank)
    {
        $masuk = TabMasuk::join('bank', 'tab_masuk.id_bank', '=', 'bank.id_bank')
                 ->join('kategori', 'tab_masuk.id_kat', '=', 'kategori.id_kat')
                 ->where('tab_masuk.id_bank',$bank)
                 ->get(); 
                 
        $keluar = TabKeluar::join('bank', 'tab_keluar.id_bank', '=', 'bank.id_bank')
                 ->join('kategori', 'tab_keluar.id_kat', '=', 'kategori.id_kat')
                 ->where('tab_keluar.id_bank',$bank)
                   ->get(); 
        
        $jummasuk = TabMasuk::join('bank', 'tab_masuk.id_bank', '=', 'bank.id_bank')
        ->join('kategori', 'tab_masuk.id_kat', '=', 'kategori.id_kat')
        ->where('tab_masuk.id_bank',$bank)->sum('jumlah_masuk');

        $jumkeluar = TabKeluar::join('bank', 'tab_keluar.id_bank', '=', 'bank.id_bank')
        ->join('kategori', 'tab_keluar.id_kat', '=', 'kategori.id_kat')
        ->where('tab_keluar.id_bank',$bank)->sum('jumlah_keluar');
        $data=[
            'title'     => 'Data ' . $bank,
            'perbankmasuk'   => $masuk,
            'perbankkeluar'   => $keluar,
            'jummasuk'       => $jummasuk,
            'jumkeluar'       => $jumkeluar,
            'bank'             =>Bank::find($bank)
        ];
        return view('admin.bank.perbank', $data);
    }
}
