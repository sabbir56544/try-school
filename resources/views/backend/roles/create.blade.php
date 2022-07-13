@extends('layouts.admin')
@section('title', $title)
@section('content')
<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Create Roles') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{ route('roles.index') }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ __('Role Management') }}</li>
        <li class="breadcrumb-item">{{ __('Roles') }}</li>
        <li class="breadcrumb-item"><a href="{{ route('roles.create') }}">{{ __('Create Roles') }}</a></li>
    </ol>
    </div>
</div>
<div class="row justify-content-center mt-3">
  <div class="col-lg-6">
    <!-- Form Basic -->
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('Create Permission') }}</h6>
      </div>
      <div class="card-body">
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <h5>Role Name <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input type="text" name="name" class="form-control" required data-validation-required-message="Please Enter A Role Name">
                </div>
            </div>
            <div class="form-group">
                <h5>Permissions<span class="text-danger">*</span></h5>
                @foreach($permissions as $permission)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="permissions[]" class="form-check-input" id="md_checkbox_{{$permission->id}}" value="{{$permission->id}}">
                    <label for="md_checkbox_{{$permission->id}}">{{$permission->name}}</label>
                </div>
                @endforeach
            </div>
            <button type="submit" id="submit-btn" class="btn btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--Row-->
@endsection
