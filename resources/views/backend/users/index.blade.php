@extends('layouts.admin')
@section('title', $title)
@section('content')
    <div class="card">
        <div class="d-sm-flex align-items-center justify-content-between">
        <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Manage User') }}</h5>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ __('Role Management') }}</li>
            <li class="breadcrumb-item">{{ __('User Management') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('users.create') }}">{{ __('Create users') }}</a></li>
        </ol>
        </div>
    </div>

    <!-- Row -->
    <div class="row mt-3">
      <!-- Datatables -->
      <div class="col-lg-12 ">
        <div class="card mb-4">
          <div class="table-responsive p-3">
            <table class="table align-items-center table-flush" id="geniustable">
              <thead class="thead-light">
                <tr>
                  <th>{{ __('#') }}</th>
                  <th>{{ __('Image') }}</th>
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Role') }}</th>
                  <th>{{ __('Phone') }}</th>
                  <th>{{ __('Email') }}</th>
                  <th>{{ __('Status') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>
              <tbody>
                  @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ ($user->image) }}" alt="image"></td>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>
                            @foreach ($user->roles as $role)
                                <span class="badge badge-pill badge-success">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        </td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->status}}</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{route('users.edit', $user->id)}}" class="btn btn-outline-info">Edit</a>
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}">
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
