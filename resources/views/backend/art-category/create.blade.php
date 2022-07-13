@extends('layouts.admin')
@section('title', $title)
@section('content')
<div class="container-fluid">
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h2><strong>Category</strong> Add </h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('art-categories.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-lg-12">
                                <div class="form-group form-float">
                                    <label for="name">Category</label>
                                    <input type="text" class="form-control" placeholder="Category" id="name" name="name" title="Please enter category">
                                    @if ($errors->has('name'))
                                    <span id="title_error" style="color: red">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-group form-float">
                                    <label>Image</label>
                                    <input type="file" name="image" id="image" data-max-file-size="200K" data-height="190">
                                    <small>Image size must be 357px X 175px</small><br>
                                    @if ($errors->has('image'))
                                    <span id="image_error" style="color: red">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group form-float">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" cols="100" rows="9"></textarea>
                                    @if ($errors->has('description'))
                                    <span id="slug_error" style="color: red">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- Dropify -->
<script src="{{ asset('assets/backend/plugins/dropify/js/dropify.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('#image').dropify();


    $('#name').keyup(function(e) {
        if ($(this).val() != '') {
            $('#title_error').html('');
        }
    });

    var medium_id;

    $(document).on('click', '.delete', function() {
        medium_id = $(this).attr('id');
        $('#confirm_modal').modal('show');
    });

</script>
@endsection