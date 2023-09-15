<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TabMasuk extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'tab_masuk';
    protected $primaryKey = 'id_masuk';
    protected $fillable = [
        'nama_masuk',
        'jumlah_masuk',
        'id_bank',
        'id_kat',
        'tanggal_masuk',
    ];

    public $timestamps = true;
}

