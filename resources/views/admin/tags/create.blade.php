@extends("layouts.app")

@section("content")
    @include("admin.tags.includes.form", [$actionRoute = route("tags.store"), $method = "POST", $submitMessage = "Create a new Tag"])
@endsection