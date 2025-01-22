<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Restaurant\RestaurantCollection;
use GuzzleHttp\Psr7\Response;

class RestaurantController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données (y compris les fichiers)
        $validated = $request->validate([
            'nom' => 'required|string',
            'adress' => 'required',
            'email' => 'nullable|email',
            'phone' => 'required|min:8',
            'description' => 'nullable',
            'banner_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slogan' => 'nullable|string',
            'devise' => 'nullable',
            'livraison' => 'nullable',
            'sur_place' => 'nullable',
            'legal' => 'nullable',
        ]);

        // Traitement des images (upload et stockage)
        $bannerImgPath = $request->file('banner_img')->store('images/banner', 'public');
        $logoImgPath = $request->file('logo_img')->store('images/logo', 'public');

        $uuid = (string) Str::uuid(); // Génère un UUID unique

        $restaurant = new Restaurant();
        $restaurant->id = $uuid;
        $restaurant->nom = $validated['nom'];
        $restaurant->adress =  $validated['adress'];
        $restaurant->email = $validated['email'];
        $restaurant->description = $validated['description'];
        $restaurant->phone = $validated['phone'];
        $restaurant->banner_img = $bannerImgPath;
        $restaurant->logo_img = $logoImgPath;
        $restaurant->devise = $validated['devise'];
        $restaurant->livraison = $validated['livraison'];
        $restaurant->sur_place = $validated['sur_place'];
        $restaurant->legal = $validated['legal'];
        $restaurant->save();

        User::where('id', '=', Auth::user()->id)->update([
            'restaurant_id' => $uuid,
        ]);

        return response()->json([
            'response' => "success",
        ]);
    }
    public function update(Request $request)
    {
        // Validation des données (y compris les fichiers)
        $validated = $request->validate([
            'id' => 'required',
            'nom' => 'required|string',
            'adress' => 'required',
            'email' => 'nullable|email',
            'phone' => 'required|min:8',
            'description' => 'nullable',
            'slogan' => 'nullable',
            'devise' => 'nullable',
            'livraison' => 'nullable|integer',
            'sur_place' => 'nullable|integer',
            'legal' => 'nullable',
        ]);

        $prev_value = Restaurant::find($request->id)->value('banner_img');
        $prev_value_logo = Restaurant::find($request->id)->value('logo_img');

        if (empty($request->banner_img)) {
            $bannerImgPath = $prev_value;
        } else {
            //suppression de l'encienne imanage .....
            if (Storage::disk('public')->exists($prev_value)) {
                Storage::disk('public')->delete($prev_value);
            }
            //enregister la nouvelle image
            $bannerImgPath = $request->file('banner_img')->store('images/banner', 'public');
        }
        if (empty($request->logo_img)) {
            $logoImgPath = $prev_value_logo;
        } else {
            //suppression de l'encienne imanage .....
            if (Storage::disk('public')->exists($prev_value_logo)) {
                Storage::disk('public')->delete($prev_value_logo);
            }
            //enregister la nouvelle image
            $logoImgPath = $request->file('logo_img')->store('images/logo', 'public');
        }

        Restaurant::where('id', $request->id)->update([
            'nom' => $validated['nom'],
            'adress' => $validated['adress'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'description' => $validated['description'],
            'banner_img' => $bannerImgPath,
            'logo_img' => $logoImgPath,
            'slogan' => $validated['slogan'],
            'devise' => $validated['devise'],
            'livraison' => $validated['livraison'],
            'sur_place' => $validated['sur_place'],
            'legal' => $validated['legal'],
        ]);
        return response()->json([
            'response' => "success",
        ]);
    }
    public function get($id): RestaurantCollection
    {
        // Récupérer le restaurant avec l'ID donné
        $restaurant = Restaurant::findOrFail($id);

        // Retourner la collection avec une seule ressource
        return new RestaurantCollection(collect([$restaurant]));

        //Ici, je passe le restaurant dans un tableau pour que RestaurantCollection puisse le traiter correctement. Si vous souhaitez retourner plusieurs restaurants, vous pouvez faire une requête comme ceci :

        // php
        // Copier
        // $restaurants = Restaurant::all();
        // return new RestaurantCollection($restaurants);
    }
}
