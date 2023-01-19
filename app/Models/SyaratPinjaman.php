<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratPinjaman extends Model
{
    use HasFactory;

    protected $table = 'syarat_pinjaman';
    protected $guarded = [
        'id'
    ];
}
