@extends('layouts.default')

@section('content')
<div class="bg-white">

    <div class="p-4 border-b border-gray-200">
        <h4 class="text-lg font-semibold">
            Edit Role
            <a href="{{ url('roles') }}" class="bg-red-500 text-white px-4 rounded-md float-right">
                Back
            </a>
        </h4>
    </div>
    <div class="p-4">
        <form action='{{ url("roles/$role->id") }}' method="POST" class="max-w-md mx-auto">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Role Name</label>
                <input type="text" name="name" id="name" placeholder="Name" required value="{{ $role->name }}" class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:border-blue-500 focus:ring
                focus:ring-blue-500">
            </div>
            <div class="mb-6">
                <button type="submit"
                    class="w-full px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                    Save
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
