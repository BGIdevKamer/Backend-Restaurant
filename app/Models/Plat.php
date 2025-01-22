<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plat extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'image',
        'categorie_id',
        'restaurant_id',
    ];

    public function Restaurant(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    public function Categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }
}
