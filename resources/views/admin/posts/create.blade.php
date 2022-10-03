@extends("layouts.app")

@section("content")
    @include("admin.posts.includes.form", [$actionRoute = route("admin.store"), $method = "POST", $submitMessage = "Create Post"])
@endsection