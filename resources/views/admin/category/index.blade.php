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
                            <p class="text-center">All Categories</p>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" class="text-center">User</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- To Read Data -->
                                    @foreach($categories AS $category)
                                    <tr>
                                        <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                        <td>{{ $category->category_name }}</td>
                                        <td class="text-center">{{ $category->user->name }}</td>
                                        <td>
                                            <!-- To Selection If Data NULL and Not NULL -->
                                            @if($category->created_at == NULL)
                                                <span class="text-danger">No Date Set</span>
                                            @else
                                                {{ $category->created_at->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('category/update/'.$category->id) }}" class="btn btn-primary">Update</a>
                                            <a href="{{ url('softdelete/delete/'.$category->id) }}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="paginate py-3">
                                {{ $categories->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <p class="text-center">Add Category</p>
                        </div>
                        <form action="{{ route('store.category') }}" method="POST">
                            @csrf

                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                                        <input type="text" name="category_name" class="form-control"
                                            id="exampleFormControlInput1" placeholder="Category Name">
                                        @error('category_name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <button class="btn btn-primary" type="submit">Add Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row my-2">
                <div class="col-md-8">
                
                    <div class="card">
                        <div class="card-header">
                            <p class="text-center">Delete Categories</p>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">SL Num</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" class="text-center">User</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- To Read Data -->
                                    @foreach($softDeleteCategory AS $deleteCategory)
                                    <tr>
                                        <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                        <td>{{ $deleteCategory->category_name }}</td>
                                        <td class="text-center">{{ $deleteCategory->user->name }}</td>
                                        <td>
                                            <!-- To Selection If Data NULL and Not NULL -->
                                            @if($deleteCategory->created_at == NULL)
                                                <span class="text-danger">No Date Set</span>
                                            @else
                                                {{ $deleteCategory->created_at->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('category/restore/'.$deleteCategory->id) }}" class="btn btn-primary">Restore</a>
                                            <a href="{{ url('permanentDelete/delete/'.$deleteCategory->id) }}" class="btn btn-danger">Permanent Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="paginate py-3">
                                {{ $softDeleteCategory->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    
                </div>
            </div>
        </div>
    </div>
@endsection
