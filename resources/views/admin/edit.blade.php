@extends("layouts.app")

@section("content")
    @include("includes.form", [$actionRoute = route("admin.update", $post->id), $method = "PUT", $submitMessage = "Update Post"])
@endsection