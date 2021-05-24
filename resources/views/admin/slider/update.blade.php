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

                        @error('title')
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
                        
                        <form action="{{ url('edit/slider/'.$sliders->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1" class="form-label">Title Name</label>
                                        <input type="text" name="title" class="form-control"
                                            id="exampleFormControlInput1" placeholder="Brand Name" value="{{ $sliders->title }}">
                                    </div>

                                    <div class="mb-3">
                                      <label for="exampleFormControlTextarea1" class="form-label">Slider Description</label>
                                      <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ $sliders->description }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" name="old_slider_img" value="{{ $sliders->image }}">
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="exampleFormControlInput1" class="form-label">Slider Image</label>
                                        <input type="file" name="image" class="form-control"
                                            id="exampleFormControlInput1">
                                    </div>
                                </div>

                                <div class="form-group my-5">
                                    <img src="{{ asset($sliders->image) }}" style="width: 400px; height: 200px">
                                </div>

                                <button class="btn btn-primary" type="submit">Update Slider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection