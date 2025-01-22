<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'adress',
        'description',
        'email',
        'phone',
        'devise',
        'livraison',
        'sur_place',
        'banner_img',
        'logo_img',
        'slogan',
        'legal',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function Categorie(): HasMany
    {
        return $this->hasMany(Categorie::class);
    }
}
