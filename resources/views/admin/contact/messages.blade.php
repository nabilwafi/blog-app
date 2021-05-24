@extends('admin.admin_master')
@section('admin')
<div class="py-12">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="my-3">
                    <a class="btn btn-primary" href="{{ route('add.contact') }}">Add Contact</a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <p class="text-center">All Contacts Data</p>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col" class="text-center">Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- To Read Data -->
                                @foreach($messages AS $message)
                                <tr>
                                    <th scope="row">{{ $messages->firstItem()+$loop->index }}</th>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->subject }}</td>
                                    <td>{{ $message->message }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                      </div>
                      
                      <div class="paginate py-3">
                        {{ $messages->links() }}
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
