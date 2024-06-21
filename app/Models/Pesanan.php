<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $fillable = ['total_harga'];

    public function orderDetails()
    {
        return $this->hasMany(DetPesanan::class, 'id_pesanan');
    }
}
