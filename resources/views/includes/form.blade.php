<form action="{{ $actionRoute }}" method="POST" class="container d-flex flex-column">
    @csrf
    @method($method)

    <label class="h2 mt-5" for="title">TITOLO DEL POST</label>
    <input type="text" name="title" value="{{ old('title', $post->title) }}" class="h4 p-1">
    @include("includes.error", [$inputName = "title"])
    <label class="h2 mt-4" for="content">CONTENUTO DEL POST</label>
    <textarea name="content" cols="30" rows="10" class="h5">
        {{ old("content", $post->content) }}
    </textarea>
    @include("includes.error", [$inputName = "content"])

    <label class="h2 mt-5" for="post_image_url">IMMAGINE DEL POST</label>
    <input type="text" name="post_image_url" value="{{ old('post_image_url', $post->post_image_url) }}" class="mb-5 h3">
    @include("includes.error", [$inputName = "post_image_url"])

    <select name="category" id="category" class="mb-5">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    
    <button type="submit" class="align-self-center btn btn-primary">{{ $submitMessage }}</button>

</form>