<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Satuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',  // Kolom deskripsi, jika diperlukan
    ];

    protected $table = 'satuan';

    /**
     * Relasi many-to-many antara Satuan dan Paket melalui tabel pivot 'menu_items'.
     */
    public function pakets(): BelongsToMany
    {
        return $this->belongsToMany(Paket::class, 'menu_items', 'satuan_id', 'paket_id')
                    ->withPivot('quantity')  // Menambahkan kolom pivot quantity
                    ->withTimestamps();
    }

    /**
     * Menambahkan paket ke satuan dengan quantity tertentu.
     *
     * @param Paket $paket
     * @param int $quantity
     * @return void
     */
    public function addPaket(Paket $paket, int $quantity = 1): void
    {
        // Pastikan relasi pakets sudah dimuat
        $this->loadMissing('pakets');

        // Cek apakah paket sudah ada dalam satuan ini
        if (!$this->pakets->contains($paket->id)) {
            // Menambahkan paket ke satuan dengan quantity
            $this->pakets()->attach($paket->id, ['quantity' => $quantity]);
        }
    }

    /**
     * Menghapus paket dari satuan.
     *
     * @param Paket $paket
     * @return void
     */
    public function removePaket(Paket $paket): void
    {
        $this->pakets()->detach($paket->id);
    }
}
