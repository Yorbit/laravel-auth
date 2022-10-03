<form action="{{ $actionRoute }}" method="POST" enctype="multipart/form-data" class="container d-flex flex-column">
    @csrf
    @method($method)

    <label class="h2 mt-5" for="title-input">Post title</label>
    <input required type="text" name="title" id="title-input" value="{{ old("title", $post->title) }}" class="h3 p-1 mt-3">
    @include("admin.posts.includes.error", [$inputName = "title"])

    <label required class="h2" for="content-input">Post content</label>
    <textarea name="content" id="content-input"cols="30" rows="10" class="h4 mt-3">
        {{ old("content", $post->content) }}
    </textarea>
    @include("admin.posts.includes.error", [$inputName = "content"])

    {{-- <label class="h2" for="post_image_url-input">Post image</label>
    <input type="text" name="post_image_url" id="post_image_url-input" value="{{ old("post_image_url", $post->post_image_url) }}" class="mb-5 mt-3 h3">
    @include("admin.posts.includes.error", [$inputName = "post_image_url"]) --}}

    <label class="h2" for="post_image-input">Post image</label>
    <input type="file" name="post_image" id="post_image-input" value="{{ old("post_image", $post->post_image) }}" class="mb-5 mt-3 h3">
    @include("admin.posts.includes.error", [$inputName = "post_image"])
    
    <h4>Category</h4>
    <select required name="category" id="category-input" class="mb-5">
        @foreach ($categories as $category)
            <option 
            {{ isset($post->category->id) && $category->id == $post->category->id ? "selected" : "" }}
            value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    @include("admin.posts.includes.error", [$inputName = "category"])

    <h4>Tags</h4>
    <div class="form-check form-check-inline d-flex justify-content-around">

        @forelse ($tags as $tag)
        
            @if ($errors->any())
                <input {{ in_array($tag->id, old("tags", [])) ? "checked" : "" }} class="form-check-input"type="checkbox" name="tags[]" id="tag-input" value="{{ $tag->id }}">
            @else   
                <input {{ $post->tags->contains($tag) ? "checked" : "" }} class="form-check-input"type="checkbox" name="tags[]" id="tag-input" value="{{ $tag->id }}">
            @endif
            <label class="form-check-label" for="tag-input">{{ $tag->name }}</label>
        @empty
            <p>No tags available.</p>
        @endforelse
                    
    </div>
    @include("admin.posts.includes.error", [$inputName = "tags"])

    <button type="submit" class="w-25 align-self-center mt-5 btn btn-primary">{{ $submitMessage }}</button>

</form>