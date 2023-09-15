<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TabKeluar extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'tab_keluar';
    protected $primaryKey = 'id_keluar';
    protected $fillable = [
        'nama_keluar',
        'jumlah_keluar',
        'id_bank',
        'id_kat',
        'tanggal_keluar',
    ];

    public $timestamps = true;
}

