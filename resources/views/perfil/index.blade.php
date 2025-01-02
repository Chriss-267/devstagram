@extends("layout.app")

@section("titulo")
    Editar perfil: {{auth()->user()->username}}
@endsection

@section("contenido")
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{route("perfil.store")}}" method="POST" enctype="multipart/form-data"
            class="mt-10 md:mt-0">
            @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    
                    @error("username")
                    <p class="text-red-500">{{$message}}</p>
                    @enderror
                    <input
                    id="username"
                    name="username"
                    placeholder="Tu Nombre de Usuario"
                    type="text" class="border p-3 w-full rounded-lg @error("username") border-2 border-red-500 @enderror"
                    value="{{auth()->user()->username}}">
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen Perfil
                    </label>
                    
                    @error("imagen")
                    <p class="text-red-500">{{$message}}</p>
                    @enderror
                    <input
                    id="imagen"
                    name="imagen"
                    type="file" class="border p-3 w-full rounded-lg"
                    value=""
                    accept=".jpg, .jpeg, .png">
                </div>

                <input type="submit" value="Guardar Cambios"
                class="p-3 bg-black rounded text-white hover:bg-slate-900 w-full uppercase font-bold cursor-pointer">
        
            </form>
        </div>
    </div>

@endsection