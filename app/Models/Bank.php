<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Bank extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'bank';
    protected $primaryKey = 'id_bank';
    protected $fillable = [
        'nama_bank',
    ];

    public $timestamps = true;
}

