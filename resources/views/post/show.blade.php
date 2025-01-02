@extends("layout.app")

@section("titulo")
   {{$post->titulo}}  
@endsection

@section("contenido")

<div class="w-[90vw] mx-auto md:flex">
    <div class="md:w-1/2">
        <img src="{{asset("uploads/thumbnails") . "/" . $post->imagen}}" alt="Imagen del post {{$post->titulo}}">

        <div class="pt-3 flex items-center gap-4">

            @auth

                <livewire:like-post :post="$post"/>
                
            @endauth
            
            
        </div>

        <div>
            <p class="font-bold">{{$post->user->username}}</p>
            <p class="text-sm text-gray-500">{{$post->created_at->diffForHumans()}}</p>
            <p class="mt-5">{{$post->descripcion}}</p>
        </div>

        @auth
            @if($post->user_id == auth()->user()->id)
                <form action="{{route("post.destroy", $post)}}" method="POST">
                    @method("DELETE")
                    @csrf
                    <input type="submit"
                    value="Eliminar Publicación"
                    class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold cursor-pointer mt-5">
                </form>
            @endif
        @endauth
        
    </div>

    <div class="md:w-1/2 p-5">

        <div class="shadow bg-white p-5 mb-5">
            @auth
            <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>

            @if (session("mensaje"))
                <p class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center font-bold">{{session("mensaje")}}</p>
            @endif
            <form action="{{route("comentarios.store", ["post" => $post, "user" => $user])}}" method="POST">
                @csrf
                <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                    Comentario
                </label>
                
                @error("comentario")
                <p class="text-red-500">{{$message}}</p>
                @enderror
                <textarea
                    id="comentario"
                    name="comentario"
                    placeholder="Agrega un comentario"
                    class="border w-full rounded-lg p-1 @error('comentario') border-red-500 @enderror"></textarea>

                    <input type="submit" value="Comentar"
                    class="p-3 bg-black rounded text-white hover:bg-slate-900 w-full uppercase font-bold cursor-pointer">
            </form>

            @endauth

            <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                @if ($post->comentarios->count())
                    @foreach ($post->comentarios as $comentario)
                        <div class="p-5 border-gray-300 border-b">
                            <a href="{{route("post.index", $comentario->user)}}" class="font-bold">{{$comentario->user->username}}</a>
                            <p>{{$comentario->comentario}}</p>
                            <p class="text-sm text-gray-500">{{$comentario->created_at->diffForHumans()}}</p>

                        </div>
                        
                    @endforeach
                @else
                    <p class="p-10 text-center">No hay comentarios aún</p>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection