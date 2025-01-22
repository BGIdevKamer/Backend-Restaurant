<?php

namespace App\Http\Resources\Categorie;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategorieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'libeller' => $this->nom,
            'description' => $this->description,
            // 'plat' => PlatResource::collection($this->whenLoaded('plats')),
        ];
    }
}
