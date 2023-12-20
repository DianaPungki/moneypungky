<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PerBankController extends Controller
{
    public function index($bank)
    { 
        $bankfind=Bank::find($bank);

        $hasil =Transaksi::leftjoin('bank', 'transaksi.id_bank', '=', 'bank.id_bank')
                        ->select('transaksi.jumlah_masuk','transaksi.jumlah_keluar','nama_trans','nama_bank','nama_kat','tanggal_trans','transaksi.created_at','transaksi.updated_at')
                        ->join('kategori', 'transaksi.id_kat', '=', 'kategori.id_kat')
                        ->where('transaksi.id_bank',$bank)->orderBy('tanggal_trans','ASC')->get();

        $kantong = Transaksi::leftJoin('bank', 'transaksi.id_bank', '=', 'bank.id_bank')
                            ->leftJoin('kategori', 'transaksi.id_kat', '=', 'kategori.id_kat')
                            ->select(
                                'kategori.id_kat',
                                'kategori.nama_kat',
                                DB::raw('SUM(transaksi.jumlah_masuk) as jml_masuk'),
                                DB::raw('SUM(transaksi.jumlah_keluar) as jml_keluar'),
                                DB::raw('(SUM(transaksi.jumlah_masuk) - SUM(transaksi.jumlah_keluar)) as saldo')
                            )
                            ->where('transaksi.id_bank', $bank)
                            ->groupBy('kategori.id_kat', 'kategori.nama_kat')
                            ->get();

        $data=[
            'title'     => 'Data ' . $bankfind->nama_bank,
            'perbank'   => $hasil,
            'bank'      => $bankfind,
            'kantong'   => $kantong,
            'kategori'  => Kategori::all()
        ];
        return view('admin.bank.perbank', $data);
    }
}
