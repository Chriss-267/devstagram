@extends('layout.app')

@section("titulo")
    Crea una nueva Publicación
@endsection


@push("styles")
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush


@section("contenido")
    <div class="md:flex md:items-center px-10">

        <div class="md:w-1/2 px-10">
            <form action={{route("imagen.store")}} method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex 
            flex-col justify-center items-center">
                @csrf
            </form>
        </div>
        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{route("post.store")}}" method="POST" novalidate>
                @csrf

                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                        Titulo
                    </label>
                    
                    @error("titulo")
                    <p class="text-red-500">{{$message}}</p>
                    @enderror
                    <input
                    id="titulo"
                    name="titulo"
                    placeholder="Titulo de la Publicación"
                    type="text" class="border p-3 w-full rounded-lg @error("titulo") border-2 border-red-500 @enderror"
                    value="{{old("titulo")}}">
                </div>

                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripción
                    </label>
                    
                    @error("descripcion")
                    <p class="text-red-500">{{$message}}</p>
                    @enderror
                    <textarea
                        id="descripcion"
                        name="descripcion"
                        placeholder="Descripción de la Publicación"
                        class="border w-full rounded-lg p-1 @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>


                    <div class="mb-5">
                        <input type="hidden"
                        name="imagen"
                        value="{{old("imagen")}}">
                        @error("imagen")
                            <p class="text-red-500">{{$message}}</p>
                        @enderror
                    </div>

                    <input type="submit" value="Crear Publicación"
                    class="p-3 bg-black rounded text-white hover:bg-slate-900 w-full uppercase font-bold cursor-pointer">
                </div>


            </form>
        </div>

    </div>
@endsection