<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Transaksi extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'transaksi';
    protected $primaryKey = 'id_trans';
    protected $fillable = [
        'nama_trans',
        'jumlah_masuk',
        'jumlah_keluar',
        'id_bank',
        'id_kat',
        'tanggal_trans',
        'status_trans',
    ];

    public $timestamps = true;
}

