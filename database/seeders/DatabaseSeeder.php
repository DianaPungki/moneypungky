<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         \App\Models\Admin::create([
             'nama_admin' => 'Admin',
             'email_admin' => 'admin@gmail.com',
             'password' => Hash::make('PunkAzmi379*'),
         ]);
         \App\Models\Bank::create([
             'nama_bank' => 'BRI',
         ]);
    }
}