<?php

use App\Models\Follower;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;

Route::get('/', HomeController::class)->name("home");

Route::get('/crear-cuenta', [RegisterController::class, "index"])->name("register");
Route::post('/crear-cuenta', [RegisterController::class, "store"]);


Route::get('/login', [LoginController::class, "index"])->name("login");
Route::post('/login', [LoginController::class, "store"]);
Route::post('/logout', [LogoutController::class, "store"])->name("logout");

//rutas para perfil

Route::get("/editar-perfil", [PerfilController::class, "index"])->name("perfil.index"); 
Route::post("/editar-perfil", [PerfilController::class, "store"])->name("perfil.store");




Route::get('/{user:username}', [PostController::class, "index"])->name("post.index");
Route::get("/post/create", [PostController::class, "create"])->name("post.create");
Route::post("/posts", [PostController::class, "store"])->name("post.store");
Route::get("/{user:username}/posts/{post}", [PostController::class, "show"])->name("post.show");
Route::delete("/post/{post}", [PostController::class, "destroy"])->name("post.destroy");

Route::post("/{user:username}/posts/{post}", [ComentarioController::class, "store"])->name("comentarios.store");

Route::post("imagenes", [ImagenController::class, "store"])->name("imagen.store");

//like a las fotos

Route::post("/post/{post}/likes", [LikeController::class, "store"])->name("post.likes.store");
Route::delete("/post/{post}/likes", [LikeController::class, "destroy"])->name("post.likes.destroy");

//siguiendo usuarios

Route::post("/{user:username}/follow", [FollowerController::class, "store"])->name("users.follow");
Route::delete("/{user:username}/unfollow", [FollowerController::class, "destroy"])->name("users.unfollow");





