@if ($errors->has($inputName))
    <ul>
        @foreach ($errors->get($inputName) as $error)
            <li class="displayed-error">{{ $error }}</li>
        @endforeach
    </ul>
@endif