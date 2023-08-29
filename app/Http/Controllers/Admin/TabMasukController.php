<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Kategori;
use App\Models\TabMasuk;
use App\Models\Tabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TabMasukController extends Controller
{
    public function index()
    {
        $data=[
            'title'     => 'Transaksi Masuk', 
            'tabmasuk'  => TabMasuk::join('bank','tab_masuk.id_bank','bank.id_bank')
                                    ->join('kategori','tab_masuk.id_kat','kategori.id_kat')
                                    ->get(),
            'bank'      => Bank::all(),
            'kategori'      => Kategori::all(),
        ];
        return view('admin.simpanan.tabmasuk', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_masuk' => 'required',
            'jumlah_masuk' => 'required|numeric',
            'id_bank' => 'required',
            'id_kat' => 'required',
        ]);
    
        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 400);
        }
        
        $data = [
            'nama_masuk' => $request->input('nama_masuk'),
            'jumlah_masuk' => $request->input('jumlah_masuk'),
            'id_bank' => $request->input('id_bank'),
            'id_kat' => $request->input('id_kat'),
        ];

        TabMasuk::create($data);
        return response()->json([
            'status' => 'success',
            'pesan' => 'Success Add Transaksi'
        ]); 
    }

    public function edit(Request $request)
    {
        return response()->json(
            TabMasuk::where('id_masuk', $request->post('id_masuk'))->get()
        );
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_masuk' => 'required',
            'jumlah_masuk' => 'required|numeric',
            'id_bank' => 'required',
            'id_kat' => 'required',
        ]);
    
        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 400);
        }
        
        $data = [
            'nama_masuk' => $request->input('nama_masuk'),
            'jumlah_masuk' => $request->input('jumlah_masuk'),
            'id_bank' => $request->input('id_bank'),
            'id_kat' => $request->input('id_kat'),
        ];

        TabMasuk::where('id_masuk', $request->post('id_masuk'))->update($data);
        return response()->json([
            'status' => 'success',
            'pesan' => 'Success Edit Masuk Transaksi'
        ]);
    }

    public function destroy(Request $request)
    {
       TabMasuk::where('id_masuk', $request->post('id_masuk'))->delete();

        return response()->json([
            'pesan' => 'Succes Delete Masuk Transaksi'
        ]);
    }
}
