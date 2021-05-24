<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>Hi, {{ Auth::User()->name }}</span>
            <div class="count-users" style="float: right;">
            <p>Total Users : <span class="text-muted badge badge-danger">{{ count($users) }}</span></p>
            </div>
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">SL Num</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created At</th>
                </tr>
            </thead>
            <tbody>

                @php($i = 1)
                @foreach($users AS $user)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                </tr>

                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</x-app-layout>
