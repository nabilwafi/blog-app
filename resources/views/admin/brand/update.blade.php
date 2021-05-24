@extends('admin.admin_master')
@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <p class="text-center">Update Brand</p>
                        </div>

                        @error('brand_name')
                        <div class="alert alert-danger alert-dismissible fade show my-2 mx-2" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @enderror

                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        
                        <form action="{{ url('brand/edit/'.$brands->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1" class="form-label">Brand Name</label>
                                        <input type="text" name="brand_name" class="form-control"
                                            id="exampleFormControlInput1" placeholder="Brand Name" value="{{ $brands->brand_name }}">
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" name="old_brand_img" value="{{ $brands->brand_img }}">
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="exampleFormControlInput1" class="form-label">Brand Image</label>
                                        <input type="file" name="brand_img" class="form-control"
                                            id="exampleFormControlInput1">
                                    </div>
                                </div>

                                <div class="form-group my-5">
                                    <img src="{{ asset($brands->brand_img) }}" style="width: 400px; height: 200px">
                                </div>

                                <button class="btn btn-primary" type="submit">Add Brand</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
