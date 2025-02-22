@extends('layouts.default')

@section('content')
<div class="bg-white">

    <div class="p-4 border-b border-gray-200">
        <h4 class="text-lg font-semibold">
            Create Permission
            <a href="{{ url('permissions') }}" class="bg-red-500 text-white px-4 rounded-md float-right">
                Back
            </a>
        </h4>
    </div>
    <div class="p-4">
        <form action="{{ url('permissions') }}" method="POST" class="max-w-md mx-auto">
            @csrf
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Permission Name</label>
                <input type="text" name="name" id="name" placeholder="Name" required
                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-500">
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