<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk'; // table name

    protected $fillable = [
        'id_produk',
        'nama_produk',
        'gambar',
        'harga',
        'deskripsi'
    ];

    protected $guarded = [
        'id_produk',
        // Add primary key and any other columns you don't want to be mass assignable
    ];
}
