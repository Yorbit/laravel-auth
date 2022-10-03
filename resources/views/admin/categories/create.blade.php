@extends("layouts.app")

@section("content")
    @include("admin.categories.includes.form", [$actionRoute = route("categories.store"), $method = "POST", $submitMessage = "Create Category"])
@endsection