@extends("layout.app")

@section("titulo")
    Registrate en Devstagram
@endsection

@section("contenido")
    <div class="md:flex p-5 md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12">
            <img src="{{asset("img/registrar.jpg")}}" alt="registrarse"
            class="">
        </div>
        <div class="md:w-6/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{route("register")}}" method="POST" novalidate>
                @csrf

                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    
                    @error("name")
                    <p class="text-red-500">{{$message}}</p>
                    @enderror
                    <input
                    id="name"
                    name="name"
                    placeholder="Tu Nombre"
                    type="text" class="border p-3 w-full rounded-lg @error("name") border-2 border-red-500 @enderror"
                    value="{{old("name")}}">
                </div>
                
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
                    value="{{old("username")}}">
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    @error("email")
                    <p class="text-red-500">{{$message}}</p>
                    @enderror
                    <input
                    id="email"
                    name="email"
                    placeholder="Tu Email"
                    type="text" class="border p-3 w-full rounded-lg @error("email") border-2 border-red-500 @enderror"
                    value="{{old("email")}}">
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    @error("password")
                    <p class="text-red-500">{{$message}}</p>
                    @enderror
                    <input
                    id="password"
                    name="password"
                    placeholder="Tu Contraseña"
                    type="password" class="border p-3 w-full rounded-lg @error("password") border-2 border-red-500 @enderror"
                    >
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repetir Password
                    </label>
                    <input
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Confirma tu Contraseña"
                    type="password" class="border p-3 w-full rounded-lg ">
                </div>

                <input type="submit" value="Crear Cuenta"
                class="p-3 bg-black rounded text-white hover:bg-slate-900 w-full uppercase font-bold cursor-pointer">
            </form>
        </div>
    </div>
@endsection