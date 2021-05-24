@extends('admin.admin_master')
@section('admin')

<div class="py-12">
    <div class="container">
        <div class="row">

            @if($errors->any())
            @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $error }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endforeach
            @endif

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <p class="text-center">Update About</p>
                    </div>

                    <form action="{{ url('edit/about/'.$about->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" class="form-label">Title Name</label>
                                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Brand Name" value="{{ $about->title }}">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">About Short
                                        Description</label>
                                    <textarea class="form-control" name="short_desc" id="exampleFormControlTextarea1"
                                        rows="3">{{ $about->short_desc }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">About Long
                                        Description</label>
                                    <textarea class="form-control" name="long_desc" id="exampleFormControlTextarea1"
                                        rows="3">{{ $about->long_desc }}</textarea>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Update About</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
