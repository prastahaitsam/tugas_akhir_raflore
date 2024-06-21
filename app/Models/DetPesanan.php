<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetPesanan extends Model
{
    use HasFactory;

    protected $table = 'det_pesanan';
    protected $fillable = ['id_pesanan', 'id_produk', 'qty', 'id_customer'];

    public function order()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}
