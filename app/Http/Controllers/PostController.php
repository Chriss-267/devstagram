<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //
    use AuthorizesRequests; 

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->latest()->paginate(5);
        
        return view("dashboard", [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view("post.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route("post.index", Auth::user()->username);
    }

    public function show( User $user, Post $post)
    {
        return view("post.show", [
            'user' => $user,
            'post' => $post
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        //eliminar imagen

        $imagen_path = public_path(("uploads/thumbnails/" . $post->imagen));

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        $imagen_pathUploads = public_path(("uploads/" . $post->imagen));

        if(File::exists($imagen_pathUploads)){
            unlink($imagen_pathUploads);
        }


        return redirect()->route("post.index", Auth::user()->username);
    }

}
