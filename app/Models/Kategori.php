<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Kategori extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'kategori';
    protected $primaryKey = 'id_kat';
    protected $fillable = [
        'nama_kat',
        'des_kat',
        'kantong',
    ];

    public $timestamps = true;
}

