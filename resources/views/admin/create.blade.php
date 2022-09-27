@extends("layouts.app")

@section("content")
    @include("includes.form", [$actionRoute = route("admin.store"), $method = "POST", $submitMessage = "Create Post"])
@endsection