@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="card">
        <div class="d-sm-flex align-items-center justify-content-between">
        <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Permissions') }}</h5>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('Role Management') }}</li>
            <li class="breadcrumb-item">{{ __('Permissions') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('permissions.create') }}">{{ __('Create Permissions') }}</a></li>
        </ol>
        </div>
    </div>
    <!-- Row -->
    <div class="row mt-3">
      <!-- Datatables -->
      <div class="col-lg-12">
        <div class="card mb-4">
          <div class="table-responsive p-3">
            <table class="table align-items-center table-flush" id="geniustable">
              <thead class="thead-light">
                <tr>
                  <th>{{ __('SL. No') }}</th>
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Group Name') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>
              <tbody>
                  @forelse ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->group_name }}</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{route('permissions.edit', $permission->id)}}" class="btn btn-outline-info">Edit</a>
                                <form method="POST" action="{{ route('permissions.destroy', $permission->id) }}">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button onclick="return confirm('Are you sure you want to Delete?');" id="btnDelete" class="btn btn-outline-danger">Delete</button>
                                </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="4">No Data Found</td>
                    </tr>
                  @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- DataTable with Hover -->
    </div>
    <!--Row-->
@endsection
