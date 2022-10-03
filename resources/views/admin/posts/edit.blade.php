@extends("layouts.app")

@section("content")
    @include("admin.posts.includes.form", [$actionRoute = route("admin.update", $post->id), $method = "PUT", $submitMessage = "Update Post"])
@endsection