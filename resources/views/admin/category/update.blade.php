@extends('admin.admin_master')
@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <p class="text-center">Update Category</p>
                        </div>

                        @error('category_name')
                        <div class="alert alert-danger alert-dismissible fade show my-2 mx-2" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @enderror
                        
                        <form action="{{ url('category/edit/'.$categories->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                                        <input type="text" name="category_name" class="form-control"
                                            id="exampleFormControlInput1" placeholder="Category Name" value="{{ $categories->category_name }}">
                                    </div>
                                </div>

                                <button class="btn btn-primary" type="submit">Add Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
