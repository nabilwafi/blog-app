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
                <div class="card">
                    <div class="card-header">
                        <p class="text-center">All Brands</p>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col" class="text-center">Brand Image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- To Read Data -->
                                @foreach($brands AS $brand)
                                <tr>
                                    <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td><img src="{{ asset($brand->brand_img) }}" style="height: 40px; width: 70px">
                                    </td>
                                    <td>
                                        <!-- To Selection If Data NULL and Not NULL -->
                                        @if($brand->created_at == NULL)
                                        <span class="text-danger">No Date Set</span>
                                        @else
                                        {{ $brand->created_at->diffForHumans() }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('brand/update/'.$brand->id) }}"
                                            class="btn btn-primary">Update</a>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            Delete
                                        </button>

                                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Delete Item</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure want to delete this item?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <a class="btn btn-danger" href="{{ url('brand/delete/'.$brand->id) }}">Delete</a>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="paginate py-3">
                            {{ $brands->links() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <p class="text-center">Add brand</p>
                    </div>
                    <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" class="form-label">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control"
                                        id="exampleFormControlInput1" placeholder="Brand Name">
                                    @error('brand_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group my-2">
                                    <label for="exampleFormControlInput1" class="form-label">Brand Image</label>
                                    <input type="file" name="brand_img" class="form-control"
                                        id="exampleFormControlInput1" placeholder="Category Name">
                                    @error('brand_img')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
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
