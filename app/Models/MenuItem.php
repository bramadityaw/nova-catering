<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = ['paket_id', 'satuan_id', 'quantity'];

    /**
     * Relasi balik ke Paket
     */
    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    /**
     * Relasi balik ke Satuan
     */
    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }
}
