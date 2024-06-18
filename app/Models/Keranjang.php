<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang'; // table name

    protected $fillable = [
        'id_customer',
        'id_produk',
        'qty',
        'sub_total'
    ];

    protected $guarded = [
        'id',
        // Add primary key and any other columns you don't want to be mass assignable
    ];
}
