<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Kategori;
use App\Models\TabMasuk;
use App\Models\Tabungan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index_masuk()
    {
        $data=[
            'title'     => 'Transaksi Masuk', 
            'tabmasuk'  => Transaksi::join('bank','transaksi.id_bank','bank.id_bank')
                                    ->join('kategori','transaksi.id_kat','kategori.id_kat')
                                    ->where('status_trans','=','masuk')
                                    ->orderBy('tanggal_trans','ASC')
                                    ->get(),
            'bank'      => Bank::all(),
            'kategori'      => Kategori::all(),
        ];
        return view('admin.simpanan.tabmasuk', $data);
    }

    public function store_masuk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_trans' => 'required',
            'jumlah_masuk' => 'required',
            'id_bank' => 'required',
            'id_kat' => 'required',
            'tanggal_trans' => 'required',
        ]);
    
        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 400);
        }

        $rupiahtanpatitik = str_replace(".", "", $request->input('jumlah_masuk'));
        
        $data = [
            'nama_trans' => $request->input('nama_trans'),
            'jumlah_masuk' => $rupiahtanpatitik,
            'id_bank' => $request->input('id_bank'),
            'id_kat' => $request->input('id_kat'),
            'tanggal_trans' => $request->input('tanggal_trans'),
            'status_trans' => 'masuk',
        ];

        Transaksi::create($data);
        return response()->json([
            'status' => 'success',
            'pesan' => 'Success Add Transaksi'
        ]); 
    }

    public function edit_masuk(Request $request)
    {
        return response()->json(
            Transaksi::where('id_trans', $request->post('id_trans'))->get()
        );
    }

    public function update_masuk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_trans' => 'required',
            'jumlah_masuk' => 'required',
            'id_bank' => 'required',
            'id_kat' => 'required',
            'tanggal_trans' => 'required',
        ]);
    
        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 400);
        }
        
        $rupiahtanpatitik = str_replace(".", "", $request->input('jumlah_masuk'));
        $data = [
            'nama_trans' => $request->input('nama_trans'),
            'jumlah_masuk' => $rupiahtanpatitik,
            'id_bank' => $request->input('id_bank'),
            'id_kat' => $request->input('id_kat'),
            'tanggal_trans' => $request->input('tanggal_trans'),
            'status_trans' => 'masuk',
        ];

        Transaksi::where('id_trans', $request->post('id_trans'))->update($data);
        return response()->json([
            'status' => 'success',
            'pesan' => 'Success Edit Masuk Transaksi'
        ]);
    }

    public function destroy_masuk(Request $request)
    {
       Transaksi::where('id_trans', $request->post('id_trans'))->delete();

        return response()->json([
            'pesan' => 'Succes Delete Masuk Transaksi'
        ]);
    }

    // keluar
    public function index_keluar()
    {
        $data=[
            'title'     => 'Transaksi Keluar', 
            'tabkeluar'  => Transaksi::join('bank','transaksi.id_bank','bank.id_bank')
                                    ->join('kategori','transaksi.id_kat','kategori.id_kat')
                                    ->where('status_trans','=','keluar')
                                    ->orderBy('tanggal_trans','ASC')
                                    ->get(),
            'bank'      => Bank::all(),
            'kategori'      => Kategori::all(),
        ];
        return view('admin.simpanan.tabkeluar', $data);
    }

    public function store_keluar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_trans' => 'required',
            'jumlah_keluar' => 'required',
            'id_bank' => 'required',
            'id_kat' => 'required',
            'tanggal_trans' => 'required',
        ]);
    
        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 400);
        }
        
        $rupiahtanpatitik = str_replace(".", "", $request->input('jumlah_keluar'));

        $data = [
            'nama_trans' => $request->input('nama_trans'),
            'jumlah_keluar' => $rupiahtanpatitik,
            'id_bank' => $request->input('id_bank'),
            'id_kat' => $request->input('id_kat'),
            'tanggal_trans' => $request->input('tanggal_trans'),
            'status_trans' => 'keluar',
        ];

        Transaksi::create($data);
        return response()->json([
            'status' => 'success',
            'pesan' => 'Success Add Transaksi'
        ]); 
    }

    public function edit_keluar(Request $request)
    {
        return response()->json(
            Transaksi::where('id_trans', $request->post('id_trans'))->get()
        );
    }

    public function update_keluar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_trans' => 'required',
            'jumlah_keluar' => 'required',
            'id_bank' => 'required',
            'id_kat' => 'required',
            'tanggal_trans' => 'required',
            'status_trans' => 'keluar',
        ]);
    
        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 400);
        }

        $rupiahtanpatitik = str_replace(".", "", $request->input('jumlah_keluar'));
        
        $data = [
            'nama_trans' => $request->input('nama_trans'),
            'jumlah_keluar' => $rupiahtanpatitik,
            'id_bank' => $request->input('id_bank'),
            'id_kat' => $request->input('id_kat'),
            'tanggal_trans' => $request->input('tanggal_trans'),
        ];

        Transaksi::where('id_trans', $request->post('id_trans'))->update($data);
        return response()->json([
            'status' => 'success',
            'pesan' => 'Success Edit Masuk Transaksi'
        ]);
    }

    public function destroy_keluar(Request $request)
    {
       Transaksi::where('id_trans', $request->post('id_trans'))->delete();

        return response()->json([
            'pesan' => 'Succes Delete Masuk Transaksi'
        ]);
    }
}
