@extends("layouts.app")

@section("content")
    @if ( session("created") )
        <div class="warn create-warn container">
            Post n°{{ session("created") }} creato.
        </div>
    @elseif ( session("updated") )   
        <div class="warn update-warn container">
            Post n°{{ session("updated") }} aggiornato.
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-12 post-card d-flex flex-column p-2">
                <h2>{{ $post->title }}</h2>
                <h5>{{ $post->user->name }}, in {{ $post->date }}</h5> <span>{{ $post->category->name }}</span>
                <img src="{{ $post->post_image_url }}" class="w-75 align-self-center" alt="Post Image">
                <p>{{ $post->content }}</p>
            </div>
            <div class="d-flex justify-content-center w-100">
                <a href="{{ route('admin.edit', $post->id) }}" class="btn btn-lg btn-success m-3">Modifica</a>
                <form action="{{ route('admin.destroy', $post->id) }}" class="m-3" method="post">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-lg btn-danger">Elimina</button>
                </form>
            </div>
        </div>
    </div>
@endsection