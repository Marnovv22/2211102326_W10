<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    protected $fillable = ['nama_pelanggan', 'jenis_layanan', 'berat', 'harga', 'tanggal_transaksi'];


}
