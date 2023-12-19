<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PerkantongController extends Controller
{
    public function index($kantong)
    {
        $kantongfind=Kategori::find($kantong);

        $hasil =Transaksi::leftjoin('bank', 'transaksi.id_bank', '=', 'bank.id_bank')
                        ->select('transaksi.jumlah_masuk','transaksi.jumlah_keluar','nama_trans','nama_bank','nama_kat','tanggal_trans','transaksi.created_at','transaksi.updated_at')
                        ->join('kategori', 'transaksi.id_kat', '=', 'kategori.id_kat')
                        ->where('transaksi.id_kat',$kantong)->orderBy('tanggal_trans','ASC')->get();

        $bank = Transaksi::leftJoin('bank', 'transaksi.id_bank', '=', 'bank.id_bank')
                        ->leftJoin('kategori', 'transaksi.id_kat', '=', 'kategori.id_kat')
                        ->select(
                            'bank.id_bank',
                            'bank.nama_bank',
                            DB::raw('SUM(transaksi.jumlah_masuk) as jml_masuk'),
                            DB::raw('SUM(transaksi.jumlah_keluar) as jml_keluar'),
                            DB::raw('(SUM(transaksi.jumlah_masuk) - SUM(transaksi.jumlah_keluar)) as saldo')
                        )
                        ->where('kategori.id_kat',$kantong)
                        ->groupBy('bank.id_bank','bank.nama_bank')
                        ->get();

        $data=[
            'title'     => 'Data ' . $kantongfind->nama_kat,
            'perkantong'   => $hasil,
            'kantong'        =>$kantongfind,
            'bank'      => $bank,
        ];
        return view('admin.kantong.perkantong', $data);
    }
}
