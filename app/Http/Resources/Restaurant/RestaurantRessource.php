<?php

namespace App\Http\Resources\Restaurant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'nom' => $this->nom,
            'adress' => $this->adress,
            'description' => $this->description,
            'email' => $this->email,
            'phone' => $this->phone,
            'banner_img' => $this->banner_img,
            'logo_img' => $this->logo_img,
            'devise' => $this->devise,
            'livraison' => $this->livraison,
            'sur_place' => $this->sur_place,
            'slogan' => $this->slogan,
            'legal' => $this->legal,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
