@extends("layouts.app")

@section('content')
    <div class="container">
        @if (session("deleted"))
            <div class="warn delete-warn">
                {{ session("deleted") }}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <table class="table table-dark table-striped">
                    <thead>
                        <td>ID</td>
                        <td>TITOLO</td>
                        <td>NOME UTENTE</td>
                        <td>DATA</td>
                        <td>CATEGORY</td>
                        <td></td>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td><a href='{{ route("admin.show", $post->id) }}'>{{ $post->title }}</a></td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->date }}</td>
                                <td>{{ isset($post->category->name) ? $post->category->name : "-" }}</td>
                                <td class="d-flex">
                                    <a href='{{ route("admin.edit", $post->id) }}' class="btn btn-sm btn-success">Edit</a>
                                    <form action='{{ route("admin.destroy", $post->id) }}' method="POST" class="delete-element-button">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-sm text-danger">ELIMINA</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <h2>NON CI SONO POST QUI</h2>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination w-100 d-flex justify-content-center align-items-center">{{ $posts->links() }}</div>
        </div>
    </div>
@endsection