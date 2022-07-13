@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h2><strong>Artist</strong> Edit </h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('artist.update', $artist->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="i.e. SM Sultan" id="name"
                                    name="name" value="{{ $artist->name }}">
                                @if ($errors->has('name'))
                                    <span id="title_error" style="color: red">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group form-float">
                                <label>Image</label>
                                <input type="file" name="image" id="image" data-height="150"
                                    data-default-file="{{ url('upload/images', $artist->image) }}">
                                <small>Image size must be 208px X 139px</small><br>
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
    <!-- Dropify -->
    <script src="{{ asset('backend/plugins/dropify/js/dropify.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#image').dropify();
        $('#title').keyup(function(e) {
            if ($(this).val() != '') {
                $('#title_error').html('');
            }
        });
        $('#image').change(function(e) {
            if ($(this).val() != '') {
                $('#image_error').html('');
            }
        });
    </script>
@endsection
