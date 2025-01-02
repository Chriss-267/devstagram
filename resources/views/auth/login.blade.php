@extends("layout.app")

@section("titulo")
    Inicia Sesion en Devstagram
@endsection

@section("contenido")
    <div class="md:flex p-5 md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12">
            <img src="{{asset("img/login.jpg")}}" alt="iniciar sesion"
            class="">
        </div>
        <div class="md:w-6/12 bg-white p-6 rounded-lg shadow-xl">
            <form novalidate action="{{route("login")}}" method="POST">
                @csrf

                @if(@session('mensaje'))
                    <p class="p-2 text-red-500 border-2 border-red-500 rounded-lg text-center text-sm mb-2">{{session("mensaje")}}</p>
                @endif
                
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
                    <input type="checkbox" name="remember"> <label class=" text-gray-500 text-sm">Mantener mi sesion abierta</label>
                </div>
                <input type="submit" value="Iniciar Sesion"
                class="p-3 bg-black rounded text-white hover:bg-slate-900 w-full uppercase font-bold cursor-pointer">
            </form>
        </div>
    </div>
@endsection