<form action="{{ $actionRoute }}" method="POST" class="container d-flex flex-column justify-ccontent-center align-items-center">
    @csrf
    @method($method)

    <label for="name-input">Category name</label>
    <input type="text" class="w-50" name="name" id="name-input" value="{{ old("name", $category->name) }}">
    @include("admin.categories.includes.error", [$inputName = "name"])

    <button type="submit" class="w-25 align-self-center mt-5 btn btn-primary">{{ $submitMessage }}</button>

</form>