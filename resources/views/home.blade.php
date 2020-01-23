@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a class="btn btn-primary" href="{{ route('results') }}">Get results</a>
                    @if (Auth::user()->user_level == 10)
                        <a class="btn btn-primary" href="{{ route('upload.home') }}">Upload a file</a>
                        <a class="btn btn-danger" href="{{ route('database.wipe') }}">Wipe the database</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
