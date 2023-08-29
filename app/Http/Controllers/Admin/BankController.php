<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{
    public function index()
    {
        $data=[
            'title' => 'Data Bank', 
            'bank' => Bank::all()
        ];
        return view('admin.data.bank', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_bank' => 'required|unique:bank',
        ]);
    
        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 400);
        }
        
        $data = [
            'nama_bank' => $request->input('nama_bank')
        ];

        Bank::create($data);
        return response()->json([
            'status' => 'success',
            'pesan' => 'Success Add Bank'
        ]); 
    }

    public function edit(Request $request)
    {
        return response()->json(
            Bank::where('id_bank', $request->post('id_bank'))->get()
        );
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_bank' => 'required|unique:bank',
        ]);
    
        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 400);
        }
        
        $data = [
            'nama_bank' => $request->input('nama_bank')
        ];

        Bank::where('id_bank', $request->post('id_bank'))->update($data);
        return response()->json([
            'status' => 'success',
            'pesan' => 'Success Edit Bank'
        ]);
    }

    public function destroy(Request $request)
    {
        Bank::where('id_bank', $request->post('id_bank'))->delete();

        return response()->json([
            'pesan' => 'Succes Delete bank'
        ]);
    }
}
