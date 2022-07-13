@extends('layouts.admin')
@section('title', $title)
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit School</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edit School
                    </div>
                    <div class="panel-body">

                        <form role="form" action="{{ route('school.update', $school->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Name of School</label>
                                <input class="form-control" name="name" id="name" required value="{{ $school->name }}">
                                @if ($errors->has('name'))
                                <span style="color: red">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" name="address" id="address" required value="{{ $school->address }}">
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

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
