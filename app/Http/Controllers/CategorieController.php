<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategorieCreateRequest;
use App\Models\Categorie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CategorieController extends Controller
{
    public function store(CategorieCreateRequest $request)
    {
        $validated = $request->validated();

        $Categorie = new Categorie();
        $Categorie->id = (string) Str::uuid();
        $Categorie->libeller = $validated['libeller'];
        $Categorie->description = $validated['description'];
        $Categorie->restaurant_id = Auth::user()->restaurant_id;
        $Categorie->save();

        return response()->json([
            'response' => "success",
        ]);
    }
}
