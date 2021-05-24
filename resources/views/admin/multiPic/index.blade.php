@extends('admin.admin_master')

@section('admin')

  <div class="py-12">
      <div class="container">
          <div class="row">
              <div class="col-md-8">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                  @foreach($images as $multi_image)
                    <div class="col-md-4 mt-5">
                      <div class="card">
                        <img src="{{ asset($multi_image->image) }}" alt="">
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
              <div class="col-md-4">
                  <div class="card">
                      <div class="card-header">
                          <p class="text-center">Add Multi Images</p>
                      </div>
                      <form action="{{ route('store.pic') }}" method="POST" enctype="multipart/form-data">
                          @csrf

                          <div class="card-body">
                              <div class="form-group">
                                  <label for="exampleFormControlInput1" class="form-label">Brand Image</label>
                                  <input type="file" name="image[]" class="form-control"
                                      id="exampleFormControlInput1" placeholder="Category Name" multiple="multiple">

                                  @error('brand_img')
                                  <div class="text-danger">{{ $message }}</div>
                                  @enderror

                              </div>
                            
                            <div class="button-form d-flex justify-content-end">
                              <button class="btn btn-primary my-2" type="submit">Add Image</button>
                            </div>
                          
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>

  @endsection
