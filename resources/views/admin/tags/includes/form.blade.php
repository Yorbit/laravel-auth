<form action="{{ $actionRoute }}" method="POST" class="container d-flex flex-column justify-ccontent-center align-items-center">
    @csrf
    @method($method)

    <label for="name-input">NOME TAG</label>
    <input type="text" class="w-50" name="name" id="name-input" value="{{ old('name', $tag->name) }}">

    <button type="submit" class="w-25 align-self-center mt-5 btn btn-primary">{{ $submitMessage }}</button>

</form>