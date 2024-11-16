<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paket extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'harga',
        'kategori',
        'deskripsi',
        'foto',
    ];

    protected $table = 'paket';


    /**
     * Relasi many-to-many antara Paket dan Satuan melalui tabel pivot 'menu_items'.
     */
    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Satuan::class, 'menu_items', 'paket_id', 'satuan_id')
                    ->withPivot('quantity')  // Mengambil data quantity dari pivot
                    ->withTimestamps();
    }

    /**
     * Menambahkan satuan ke paket dengan quantity tertentu.
     *
     * @param Satuan $satuan
     * @param int $quantity
     * @return void
     */
    public function addSatuan(Satuan $satuan, int $quantity = 1): void
    {
        $this->loadMissing('items');
    
        if ($this->items->contains($satuan->id)) {
            // Update quantity jika satuan sudah ada
            $this->items()->updateExistingPivot($satuan->id, ['quantity' => $quantity]);
        } else {
            // Attach satuan jika belum ada
            $this->items()->attach($satuan->id, ['quantity' => $quantity]);
        }
    }
    

    /**
     * Menghapus satuan dari paket.
     *
     * @param Satuan $satuan
     * @return void
     */
    public function removeSatuan(Satuan $satuan): void
    {
        $this->items()->detach($satuan->id);
    }
}
