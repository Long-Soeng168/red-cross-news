@extends('layouts.default')

@section('content')
<div class="bg-white">
    @if (session('status'))
    <div class="bg-blue-100 border border-blue-500 text-blue-700 px-4 py-3 relative" role="alert">
        <p>{{ session('status') }}</p>
    </div>
    @endif

    <div class="p-4 border-b border-gray-200">
        <h4 class="text-lg font-semibold">
            Users
            @can('create user')
            <a href="{{ url('users/create') }}" class="bg-slate-500 text-white px-4 rounded-md float-right">
                Add User
            </a>
            @endcan
        </h4>
    </div>
    <div class="p-4">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        No</th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID</th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name</th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Roles</th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @foreach ($user->roles as $role)
                            <span class="px-4 py-1 rounded-full bg-green-300">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @can('view user')
                        <a href='{{ url("/users/$user->id") }}'
                            class="bg-green-600 cursor-pointer hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            View
                        </a>
                        @endcan
                        @can('update user')
                        <a href='{{ url("/users/$user->id/edit") }}'
                            class="bg-blue-500 cursor-pointer hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-4 ">
                            Edit
                        </a>
                        @endcan
                        @can('delete user')
                        <a href='{{ url("/users/$user->id/delete") }}'
                            class="bg-red-500 cursor-pointer hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Delete
                        </a>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>


</div>
@endsection

