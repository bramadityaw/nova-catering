<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Satuan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'satuan';

    public function menus() : BelongsToMany
    {
        return $this->belongsToMany(Paket::class);
    }
}
