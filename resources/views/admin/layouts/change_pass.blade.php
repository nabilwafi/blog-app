@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
  <div class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="card card-default">
          <div class="card-header card-header-border-bottom">
            <h2>Change Password</h2>
          </div>
          <div class="card-body">
            <form action="{{ route('password.update') }}" method="post">
              @csrf

              <label class="text-dark font-weight-medium" for="">Current Password</label>
              <div class="input-group mb-2">
                <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Current Password">
              </div>
              @error('current_password')
              <p class="text-danger">{{ $message }}</p>
              @enderror

              <label class="text-dark mt-4 font-weight-medium" for="">New Password</label>
              <div class="input-group mb-2">
                <input type="password" class="form-control" name="password" id="password" placeholder="New Password">
              </div>
              @error('password')
              <p class="text-danger">{{ $message }}</p>
              @enderror

              <label class="text-dark mt-4 font-weight-medium" for="">Confirm Password</label>
              <div class="input-group mb-2">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
              </div>
              @error('password_confirmation')
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