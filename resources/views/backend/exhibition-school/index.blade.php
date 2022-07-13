@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Schools</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add new School
                        </div>
                        <div class="panel-body">

                            <form role="form" action="{{ route('school.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Name of School</label>
                                    <input class="form-control" name="name" id="name" required
                                        value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span style="color: red">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" name="address" id="address" required
                                        value="{{ old('address') }}">
                                    @if ($errors->has('address'))
                                        <span style="color: red">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-default">Save</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-7">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Category list
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>School</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $count = 1; @endphp
                                        @foreach ($schools as $school)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $school->name }}, {{ $school->address }}</td>
                                                <td>
                                                    <form class="delete"
                                                        action="{{ route('school.destroy', $school->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('school.edit', $school->id) }}"
                                                            class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        @csrf
                                                        <button class="btn btn-danger" type="submit"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@endsection
@section('script')
    <!-- DataTables JavaScript -->
    <script src="{{ asset('back/js/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('back/js/dataTables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $('#dataTables-example').DataTable({
            responsive: true
        });

        $(".delete").on("submit", function() {
            return confirm("Are you sure?");
        });
    </script>
@endsection
