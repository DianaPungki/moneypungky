<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $data=[
            'title' => 'Data Kategori', 
            'kategori' => Kategori::all()
        ];
        return view('admin.data.kategori', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kat' => 'required',
            'des_kat' => 'required',
            'kantong' => 'required',
        ]);
    
        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 400);
        }
        
        $data = [
            'nama_kat' => $request->input('nama_kat'),
            'des_kat' => $request->input('des_kat'),
            'kantong' => $request->input('kantong'),
        ];

        Kategori::create($data);
        return response()->json([
            'status' => 'success',
            'pesan' => 'Success Add Category'
        ]); 
    }

    public function edit(Request $request)
    {
        return response()->json(
            Kategori::where('id_kat', $request->post('id_kat'))->get()
        );
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kat' => 'required',
            'des_kat' => 'required',
            'kantong' => 'required',
        ]);
    
        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 400);
        }
        
        $data = [
            'nama_kat' => $request->input('nama_kat'),
            'des_kat' => $request->input('des_kat'),
            'kantong' => $request->input('kantong'),
        ];

       Kategori::where('id_kat', $request->post('id_kat'))->update($data);
        return response()->json([
            'status' => 'success',
            'pesan' => 'Success Edit Category'
        ]);
    }

    public function destroy(Request $request)
    {
       Kategori::where('id_kat', $request->post('id_kat'))->delete();

        return response()->json([
            'pesan' => 'Succes Delete Category'
        ]);
    }
}
