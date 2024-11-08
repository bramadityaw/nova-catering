<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Paket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'harga',
        'kategori',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'paket';

    public function items() : BelongsToMany
    {
        return $this->belongsToMany(Satuan::class);
    }
}
