@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h2><strong>Exhibition</strong> Create </h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('exhibition.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group form-float">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" placeholder="Exhibition Title" id="title"
                                    name="title" title="Please enter exhibition title">
                                @if ($errors->has('title'))
                                    <span id="title_error" style="color: red">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="form-group form-float">
                                <label for="start">Start Date</label>
                                <input type="datetime-local" class="form-control" id="start" name="start">
                                @if ($errors->has('start'))
                                    <span id="title_error" style="color: red">{{ $errors->first('start') }}</span>
                                @endif
                            </div>
                            <div class="form-group form-float">
                                <label for="end">End Date</label>
                                <input type="datetime-local" class="form-control" id="end" name="end">
                                @if ($errors->has('end'))
                                    <span id="title_error" style="color: red">{{ $errors->first('end') }}</span>
                                @endif
                            </div>
                            <div class="form-group form-float">
                                <label>Image</label>
                                <input type="file" name="image" id="image" data-max-file-size="300K"
                                    data-height="200">
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
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h2><strong>Exhibition</strong> List </h2>
                    </div>
                    <div class="card-body">
                        <div class="body">
                            <div class="table-responsive">
                                <table id="exhibition_table" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="10%">#</th>
                                            <th style="text-align: left;" width="40%">Exhibition</th>
                                            <th width="15%">Start Date</th>
                                            <th width="15%">End Date</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $count = 1; @endphp
                                        @foreach ($exhibitions as $exhibition)
                                            <tr>
                                                <td>{!! $count++ !!}</td>
                                                <td style="text-align: left;">{!! $exhibition->title !!}</td>
                                                <td>{!! $exhibition->start !!}</td>
                                                <td>{!! $exhibition->end !!}</td>
                                                <td>
                                                    <a href="{{ route('exhibition.edit', $exhibition->id) }}"
                                                        class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                                    <button type="button" id="{!! $exhibition->id !!}" class="delete btn btn-danger"><i
                                                                class="fa fa-trash"></i></button>
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
    </div>

    <div id="confirm_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="loader-popup" style="display: none;">
                    <img src="{{ url('backend/images/loader.gif') }}">
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
    <script src="{{ asset('backend/plugins/dropify/js/dropify.min.js') }}"></script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#image').dropify();

        $('#exhibition_table').DataTable();

        $("#name").on('keyup blur', function() {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
            $("#slug").val(Text);
        });

        $('#name').keyup(function(e) {
            if ($(this).val() != '') {
                $('#title_error').html('');
                $('#slug_error').html('');
            }
        });

        $('#slug').keyup(function(e) {
            if ($(this).val() != '') {
                $('#slug_error').html('');
            }
        });

        var medium_id;

        $(document).on('click', '.delete', function() {
            medium_id = $(this).attr('id');
            $('#confirm_modal').modal('show');
        });
    </script>
@endsection
