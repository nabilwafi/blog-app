@extends('admin.admin_master')
@section('admin')

<div class="row">
  <div class="col-lg-12">

    @if($errors->any())
      @foreach($errors->all() as $error)
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ $error }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endforeach
    @endif

    <div class="card card-default">
      <div class="card-header card-header-border-bottom">
        <h2>Contact Form Input</h2>
      </div>
      <div class="card-body">
      <form action="{{ route('create.contact') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label for="exampleFormControlInput1">Contact Address</label>
            <input type="text" class="form-control" name="address" id="exampleFormControlInput1" >
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Contact Email</label>
            <input type="email" class="form-control" name="email" id="exampleFormControlInput1">
          </div>
          <div class="form-group">
            <label for="exampleFormControlFile1">Contact Phone</label>
            <input type="text" class="form-control" name="phone" id="exampleFormControlFile1">
          </div>
          <div class="form-footer pt-4 pt-5 mt-4 border-top">
            <button type="submit" class="btn btn-primary btn-default">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection