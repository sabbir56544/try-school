@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h2><strong>Exhibition</strong> Edit </h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('exhibition.update', $exhibition->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" placeholder="Exhibition Title" id="title"
                                    name="title" title="Please enter exhibition title" value="{{ $exhibition->title }}">
                                @if ($errors->has('title'))
                                    <span id="title_error" style="color: red">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="form-group form-float">
                                <label for="start">Start Date</label>
                                <input type="datetime-local" class="form-control" id="start" name="start"
                                    value="{{ $exhibition->start }}">
                                @if ($errors->has('start'))
                                    <span id="title_error" style="color: red">{{ $errors->first('start') }}</span>
                                @endif
                            </div>
                            <div class="form-group form-float">
                                <label for="end">End Date</label>
                                <input type="datetime-local" class="form-control" id="end" name="end"
                                    value="{{ $exhibition->end }}">
                                @if ($errors->has('end'))
                                    <span id="title_error" style="color: red">{{ $errors->first('end') }}</span>
                                @endif
                            </div>
                            <div class="form-group form-float">
                                <label>Image</label>
                                <input type="file" name="image" id="image" data-max-file-size="300K"
                                    data-height="200" data-default-file="{{ url('upload/images', $exhibition->image) }}">
                                <small>Image size must be 825px X 366px</small><br>
                                @if ($errors->has('image'))
                                    <span id="image_error" style="color: red">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                            <button type="submit" name="action_button" id="action_button"
                                class="btn btn-primary waves-effect">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('backend.partials.datatable.js')

    <!-- Dropify -->
    <script src="{{ asset('backend/plugins/dropify/js/dropify.min.js') }}"></script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#image').dropify();



        var medium_id;

        $(document).on('click', '.delete', function() {
            medium_id = $(this).attr('id');
            $('#confirm_modal').modal('show');
        });
    </script>

@endsection
