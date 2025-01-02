<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Laravel\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $imagen = $request->file('file');  

        $nombreImagen = Str::uuid() . '.' . $imagen->extension();  

        $imagen->move("uploads", $nombreImagen);
        
        $imageManager = new ImageManager( new Driver());

        $thumbImage = $imageManager->read("uploads/".$nombreImagen);

        $thumbImage->resize(1000, 1000);

        $thumbImage->save(public_path("uploads/thumbnails/".$nombreImagen));

        return response()->json(['imagen' => $nombreImagen]);
    }
}
