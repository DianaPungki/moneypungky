<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Kategori;
use App\Models\TabKeluar;
use App\Models\Tabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TabKeluarController extends Controller
{
    public function index()
    {
        $data=[
            'title'     => 'Transaksi Keluar', 
            'tabkeluar'  => TabKeluar::join('bank','tab_keluar.id_bank','bank.id_bank')
                                    ->join('kategori','tab_keluar.id_kat','kategori.id_kat')
                                    ->get(),
            'bank'      => Bank::all(),
            'kategori'      => Kategori::all(),
        ];
        return view('admin.simpanan.tabkeluar', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_keluar' => 'required',
            'jumlah_keluar' => 'required|numeric',
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
            'nama_keluar' => $request->input('nama_keluar'),
            'jumlah_keluar' => $request->input('jumlah_keluar'),
            'id_bank' => $request->input('id_bank'),
            'id_kat' => $request->input('id_kat'),
        ];

        TabKeluar::create($data);
        return response()->json([
            'status' => 'success',
            'pesan' => 'Success Add Transaksi'
        ]); 
    }

    public function edit(Request $request)
    {
        return response()->json(
            TabKeluar::where('id_keluar', $request->post('id_keluar'))->get()
        );
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_keluar' => 'required',
            'jumlah_keluar' => 'required|numeric',
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
            'nama_keluar' => $request->input('nama_keluar'),
            'jumlah_keluar' => $request->input('jumlah_keluar'),
            'id_bank' => $request->input('id_bank'),
            'id_kat' => $request->input('id_kat'),
        ];

        TabKeluar::where('id_keluar', $request->post('id_keluar'))->update($data);
        return response()->json([
            'status' => 'success',
            'pesan' => 'Success Edit Masuk Transaksi'
        ]);
    }

    public function destroy(Request $request)
    {
       TabKeluar::where('id_keluar', $request->post('id_keluar'))->delete();

        return response()->json([
            'pesan' => 'Succes Delete Masuk Transaksi'
        ]);
    }
}
