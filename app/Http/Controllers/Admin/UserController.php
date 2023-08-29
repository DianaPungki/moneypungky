<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data=[
            'title' => 'User Admin', 
            'admin' => Admin::all()
        ];
        return view('admin.users.admin', $data);
    }
}
