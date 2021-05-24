@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
  <div class="content">
    <div class="row">
      <div class="col-lg-12">

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card card-default">
          <div class="card-header card-header-border-bottom">
            <h2>Change Password</h2>
          </div>
          <div class="card-body">
            <form action="{{ route('profile.update') }}" method="post">
              @csrf

              <label class="text-dark font-weight-medium" for="">User Name</label>
              <div class="input-group mb-2">
                <input type="text" class="form-control" name="name" id="name" value="{{ $user['name'] }}">
              </div>
              @error('name')
              <p class="text-danger">{{ $message }}</p>
              @enderror

              <label class="text-dark mt-4 font-weight-medium" for="">Email</label>
              <div class="input-group mb-2">
                <input type="email" class="form-control" name="email" id="email" value="{{ $user['email'] }}">
              </div>
              @error('email')
              <p class="text-danger">{{ $message }}</p>
              @enderror

              <div class="input-group my-4">
                <button type="submit" class="btn btn-primary">Add</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection