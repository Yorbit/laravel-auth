@extends("layouts.app")

@section('content')
    <div class="container">
        @if (session("deleted"))
            <div class="warn delete-warn">
                {{ session("deleted") }}
            </div>
        @elseif (session("created"))
        <div class="warn create-warn">
            {{ session("created") }}
        </div>
        @elseif (session("updated"))
            <div class="warn update-warn">
                {{ session("updated") }}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <table class="table table-dark table-striped">
                    <thead>
                        <td>ID</td>
                        <td>NOME</td>
                        <td><a href='{{ route("tags.create") }}' class="btn btn-sm btn-primary">AGGIUNGI</a></td>
                    </thead>
                    <tbody>
                        @forelse ($tags as $tag)
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
                                <td class="d-flex">
                                    <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-sm btn-success">Edit</a>
                                    <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="delete-element-button">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-sm text-danger">ELIMINA</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <h2>NON CI SONO TAG QUI.</h2>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection