@if ( session("created") )
    <div class="warn create-warn container">
        {{ session("created") }}
    </div>
@elseif ( session("updated") )   
    <div class="warn update-warn container">
         {{ session("updated") }}
    </div>
@endif
<div class="container">
    <div class="row">
        <div class="col-12 post-card d-flex flex-column p-2">
            <h2>{{ $post->title }}</h2>
            <h5>{{ $post->user->name }}, in {{ $post->date }}</h5> 
            <span>{{ isset($post->category->name) ? $post->category->name : "No category" }} - 
                @foreach ($post->tags as $tag) 
                    <span class="text-primary"> #{{ $tag->name }} </span>
                @endforeach
            </span>
            <img src="{{ asset('storage/' . $post->post_image) }}" class="w-75 align-self-center" alt="Post Image">
            <p>{{ $post->content }}</p>
        </div>
    </div>
</div>