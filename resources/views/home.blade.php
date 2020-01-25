@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if(session()->get('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    @if(session()->get('danger'))
                    <div class="alert alert-danger">
                        {{ session()->get('danger') }}
                    </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a class="btn btn-primary" href="{{ route('results') }}">Get results</a>
                    @if (Auth::user()->user_level == 10)
                        <a class="btn btn-primary" href="{{ route('upload.home') }}">Upload a file</a>
                        <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#wipeDatabaseModalCenter">Wipe the database</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="wipeDatabaseModalCenter" tabindex="-1" role="dialog" aria-labelledby="wipeDatabaseModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Wipe the database</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to wipe the database?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="{{ route('database.wipe') }}">Wipe the database</a>
      </div>
    </div>
  </div>
</div>

@endsection
