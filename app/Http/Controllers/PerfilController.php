<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PerfilController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(["auth"]);
    }

    public function index()
    {
        return view("perfil.index");
    }

    public function store(Request $request)
    {
        //modificar request para user name que no sea duplicado

        $request->request->add(['username' =>Str::slug($request->username)]);

        $request->validate([
            'username' => ['required', Rule::unique('users', 'username')->ignore(Auth::user()->id),'min:3', 'max:30', 'not_in:devstagram,editar-perfil']
        ]);

        if($request->imagen){
            $imagen = $request->file('imagen');  

            $nombreImagen = Str::uuid() . '.' . $imagen->extension();  

            $imagen->move("perfiles", $nombreImagen);
            
            $imageManager = new ImageManager( new Driver());

            $thumbImage = $imageManager->read("perfiles/".$nombreImagen);

            $thumbImage->resize(1000, 1000);

            $thumbImage->save(public_path("perfiles/thumbnails/".$nombreImagen));
        }

        //guardar cambios


        $usuario = User::find(Auth::user()->id);

        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? Auth::user()->imagen ?? null;
        $usuario->save();

        //Redireccionar

        return redirect()->route('post.index', $usuario->username);

    }
}
