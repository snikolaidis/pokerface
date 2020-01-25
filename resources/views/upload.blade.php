@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">File Upload</div>
                @if(session()->get('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif

                <div class="card-body">
                    <form id="file" method="POST" class="dropzone" action="{{ route('upload') }}" aria-label="{{ __('Upload') }}" enctype="multipart/form-data">
                        @csrf
                    </form>
                    <div class="row btn-block text-right">
                        <a class="btn btn-primary" href="{{ route('home') }}">Back to home</a>
                        <a id="get-results" class="btn btn-primary d-none" href="{{ route('results') }}">Get results</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="fileUploadModalCenter" tabindex="-1" role="dialog" aria-labelledby="fileUploadModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">File Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    window.addEventListener('load', function() {
        var drop = new Dropzone('#file', {
            createImageThumbnails: false,
            url: "{{ route('upload') }}",
            headers: {
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
            }
        });
        drop.on("complete", function(file) {
            var data = JSON.parse(file.xhr.response);
            $('.modal-body').html(data.message)
            if (data.result) {
                $('#get-results').removeClass('d-none');
            }
            $('#fileUploadModalCenter').modal();
        });
    });
</script>
@endsection