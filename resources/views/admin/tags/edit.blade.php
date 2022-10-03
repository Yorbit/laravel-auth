@extends("layouts.app")

@section("content")
    @include("admin.tags.includes.form", [$actionRoute = route("tags.update", $tag->id), $method = "PUT", $submitMessage = "Update Tag"])
@endsection