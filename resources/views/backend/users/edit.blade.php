@extends('layouts.admin')
@section('title', $title)
@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Edit User') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('users.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ __('Role Management') }}</li>
            <li class="breadcrumb-item">{{ __('User Management') }}</li>
            <li class="breadcrumb-item"><a href="{{ route('users.edit', $user->id) }}">{{ __('Edit users') }}</a></li>
    </ol>
    </div>
</div>

<div class="row justify-content-center mt-3">
  <div class="col-lg-12">
    <!-- Form Basic -->
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('Edit User') }}</h6>
      </div>

      <div class="card-body">
        <div class="gocover" style="background: url() no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    <div class="container pl-0 pr-0 ml-0 mr-0 w-100 mw-100">
        <div id="tabs">
            <ul class="nav nav-pills nav-justified mb-3" role="tablist">
              <li class="nav-item">
                <a class="nav-link bsc active" data-toggle="pill" href="#basic">{{ __('Basic Information') }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link req" data-toggle="pill" href="#req">{{ __('Login credentials') }}</a>
              </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
              <div id="basic" class="container tab-pane active"><br>

                <div class="row">
                    <div class="col-lg-3">
                      <div class="left-area">
                        <h4 class="heading">{{ __('First Name') }} *</h4>
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <input type="text" class="input-field" name="first_name" placeholder="First Name" required="" value="{{ $user->first_name }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                      <div class="left-area">
                        <h4 class="heading">{{ __('Last Name') }} *</h4>
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <input type="text" class="input-field" name="last_name" placeholder="Last Name" required="" value="{{ $user->last_name }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                      <div class="left-area">
                        <h4 class="heading">{{ __('Role') }} *</h4>
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <select name="role" id="" class="input-field">
                        <option value="" disabled>Select</option>
                       <option value="" disabled>Select</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                      </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                      <div class="left-area">
                        <h4 class="heading">{{ __('Status') }} *</h4>
                      </div>
                    </div>
                    <div class="col-lg-9">
                      <select name="status" id="" class="input-field">
                          <option value="" disabled>Select</option>
                          <option value="1" @if($user->status == 1) selected @endif>Active</option>
                          <option value="2" @if($user->status == 2) selected @endif>In-Active</option>
                      </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-lg-3">
                      <div class="left-area">
                        <h4 class="heading">{{ __('User image') }} *</h4>
                      </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="form-group">
                            <label><small class="small-font">({{ __('Preferred Size 600 X 600') }})</small></label>
                            <div class="wrapper-image-preview">
                                <div class="box">
                                    <div class="back-preview-image" style="background-image: url({{ asset('assets/images/placeholder.jpg') }});"></div>
                                    <div class="upload-options">
                                        <label class="img-upload-label" for="img-upload"> <i class="fas fa-camera"></i> {{ __('Upload Picture') }} </label>
                                        <input id="img-upload" type="file" class="image-upload" name="photo" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                  <ul class="list-inline mt-3 mb-0  text-center">
                    <li class="list-inline-item">
                        <a href="javascript:;" data-href=".req" class="next-prev btn btn-primary"> {{ __('Next') }} </a>
                    </li>
                </ul>

              </div>

              <div id="req" class="container tab-pane"><br>

                        <div class="row">
                            <div class="col-lg-3">
                              <div class="left-area">
                                <h4 class="heading">{{ __('Email') }} *</h4>
                              </div>
                            </div>
                            <div class="col-lg-9">
                              <input type="text" class="input-field" name="email" placeholder="{{ __('Email') }}" required="" value="{{ $user->email }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                              <div class="left-area">
                                <h4 class="heading">{{ __('Password') }} *</h4>
                              </div>
                            </div>
                            <div class="col-lg-9">
                              <input type="password" class="input-field" name="password" placeholder="{{ __('Password') }}">
                            </div>
                        </div>

                        <div class="row justify-content-center mt-3">
                          <button type="submit" id="submit-btn" class="btn btn-primary text-center">{{ __('Submit') }}</button>
                      </div>

                        <ul class="list-inline mt-3 mb-0  text-center">

                            <li class="list-inline-item">
                                <a href="javascript:;" data-href=".bsc" class="next-prev btn btn-primary"> {{ __('Prev') }} </a>
                            </li>

                        </ul>

              </div>

            </div>

        </div>

          </div>

        </div>

        </form>
      </div>
    </div>

    <!-- Form Sizing -->

    <!-- Horizontal Form -->

  </div>

</div>
<!--Row-->

@endsection
