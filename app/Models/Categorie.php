<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;
use App\Models\Plat;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'libeller',
        'description',
        'restaurant_id',
    ];

    public function Restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function Plats(): HasMany
    {
        return $this->hasMany(Plat::class);
    }
}
