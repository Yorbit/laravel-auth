@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('MAIN ZONE') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Accesso Admin') }}
                </div>
            </div>
        </div>
    </div>
    <div class="text-center pt-5">
        <a href="{{ route('admin.index') }}" class="btn btn-lg btn-primary">ARCHIVIO POST</a>
    </div>
</div>
@endsection
