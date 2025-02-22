@extends('layouts.default')

@section('content')
<div class="bg-white">
    @if (session('status'))
    <div class="relative px-4 py-3 text-blue-700 bg-blue-100 border border-blue-500" role="alert">
        <p>{{ session('status') }}</p>
    </div>

    @endif
    <div class="p-4 border-b border-gray-200">
        <h4 class="text-lg font-semibold">
            Roles
            @if(auth()->user()->hasRole('super-admin'))
            <a href="{{ url('roles/create') }}" class="float-right px-4 text-white rounded-md bg-slate-500">
                Add Role
            </a>
            @endif
        </h4>
    </div>
    <div class="p-4">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                        ID</th>
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                        Name</th>
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase bg-gray-50">
                        Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($roles as $role)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $role->name }}</td>
                    <td class="px-6 py-4 text-center whitespace-nowrap">
                        @if(auth()->user()->hasRole('super-admin'))
                        <a href='{{ url("/roles/$role->id/give-permissions") }}'
                            class="px-4 py-2 font-bold text-white bg-green-600 rounded cursor-pointer hover:bg-green-700">
                            Permissions
                        </a>
                        @endif
                        @if(auth()->user()->hasRole('super-admin'))
                        <a href='{{ url("/roles/$role->id/edit") }}'
                            class="px-4 py-2 mx-4 font-bold text-white bg-blue-500 rounded cursor-pointer hover:bg-blue-700">
                            Edit
                        </a>
                        @endif
                        @if(auth()->user()->hasRole('super-admin'))
                        <a href='{{ url("/roles/$role->id/delete") }}'
                            class="px-4 py-2 font-bold text-white bg-red-500 rounded cursor-pointer hover:bg-red-700">
                            Delete
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>


</div>
@endsection

