<div>
    @if ($posts->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($posts as $post)
            <div class="">
                <a href="{{route("post.show", ["post" => $post, "user" => $post->user], $post)}}"><img src="{{asset("uploads/thumbnails") . "/" . $post->imagen}}" alt="Imagen del post {{$post->titulo}}"></a>
            </div>
        @endforeach
        </div>

        <div class="mt-10">
            {{$posts->links()}}
        </div>
        
    @else
        <p class="text-center">No hay posts, sigue a alguien para poder mostar sus posts</p>
    @endif
</div>