@extends("layouts.app")

@section("content")
    @include("admin.categories.includes.form", [$actionRoute = route("categories.update", $category->id), $method = "PUT", $submitMessage = "Update Category"])
@endsection