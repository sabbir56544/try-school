@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h2><strong>Artist</strong> List </h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('artist.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group form-float">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="i.e. SM Sultan" id="name"
                                    name="name">
                                @if ($errors->has('name'))
                                    <span id="title_error" style="color: red">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group form-float">
                                <label>Image</label>
                                <input type="file" name="image" id="image" data-height="150">
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
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h2><strong>Category</strong> List </h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="category_table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="10%">#</th>
                                        <th>Image</th>
                                        <th width="35%" width="35%">Name</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($artists as $artist)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td><img src="{{ url('upload/images', $artist->image)}}" style="width: 100px">
                                            </td>
                                            <td>{{ $artist->name }}</td>
                                            <td>
                                                <a href="{{ route('artist.edit', $artist->id) }}"
                                                    class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                                <button type="button" id="{{ $artist->id }}" class="delete btn btn-danger waves-effect waves-float btn-xl waves-red"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="confirm_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="loader-popup" style="display: none;">
                    <img src="{{ url('assets/backend/images/loader.gif') }}">
                </div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">Confirmation</h2>
                </div>
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('backend.partials.datatable.js')
    <!-- Dropify -->
    <script src="{{ asset('assets/backend/plugins/dropify/js/dropify.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#category_table').DataTable();
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
        var medium_id;
        $(document).on('click', '.delete', function() {
            medium_id = $(this).attr('id');
            $('#confirm_modal').modal('show');
        });
    </script>
@endsection
