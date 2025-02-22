@extends('admin.layouts.admin')
@section('content')


<div>
    @if (session('success'))
        <div class="fixed top-[5rem] right-4 z-[999999] " wire:key="{{ rand() }}" x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 7000)">
            <div x-show="show" id="alert-2"
                class="flex items-center p-4 mb-4 text-green-800 border border-green-500 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div class="ml-2">
                    {{ session('success') }}
                </div>
                <button type="button" @click="show = false"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-2" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        </div>
    @endif
    <x-page-header :value="__('Users')"/>
    <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
        <div class="w-full md:w-1/2">
            <form class="flex items-center gap-4">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" id="simple-search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search Users" required="">
                </div>
                {{-- <div>
                    <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                        </svg>
                        Filter
                        <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                        </svg>
                    </button>
                    <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                        <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Choose brand</h6>
                        <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                            <li class="flex items-center">
                                <input id="apple" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="apple" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Apple (56)</label>
                            </li>
                            <li class="flex items-center">
                                <input id="fitbit" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Microsoft (16)</label>
                            </li>
                            <li class="flex items-center">
                                <input id="razor" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="razor" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Razor (49)</label>
                            </li>
                            <li class="flex items-center">
                                <input id="nikon" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="nikon" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Nikon (12)</label>
                            </li>
                            <li class="flex items-center">
                                <input id="benq" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="benq" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">BenQ (74)</label>
                            </li>
                        </ul>
                    </div>
                </div> --}}
            </form>
        </div>
        <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">

            @can('create user')
            <x-primary-button href="{{ route('admin.users.create') }}">
                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                </svg>
                Add User
            </x-primary-button>
            @endcan
            <div class="flex items-center w-full space-x-3 md:w-auto">
                <button id="filterDropdownButton" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-up">
                        <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                        <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                        <path d="M12 12v6" />
                        <path d="m15 15-3-3-3 3" />
                    </svg>
                    Export
                </button>

            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">No</th>
                    <th scope="col" class="px-4 py-3">Image</th>
                    <th scope="col" class="px-4 py-3">Name</th>
                    <th scope="col" class="px-4 py-3">Email</th>
                    <th scope="col" class="px-4 py-3">Phone</th>
                    <th scope="col" class="px-4 py-3">Roles</th>
                    <th scope="col" class="py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                @if ($user->hasRole('super-admin') && !auth()->user()->hasRole('super-admin'))
                    @continue
                @endif
            <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                <td class="w-4 px-4 py-3">
                    <div class="flex items-center">
                        {{ $loop->iteration }}
                    </div>
                    </td>
                    <th scope="row" class="flex items-center px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @if ($user->image)
                            <img src="{{ asset('assets/images/users/thumb/'.$user->image) }}" alt="profile Image" class="object-cover w-auto h-10 mr-3 rounded-full aspect-square">
                        @else
                            <img src="{{ asset('assets/icons/profile.png') }}" alt="profile icon" class="object-cover w-auto h-10 mr-3 rounded-full aspect-square">
                        @endif

                    </th>
                    <x-table-data value="{{ $user->name ? $user->name : 'N/A' }}"/>
                    <x-table-data value="{{ $user->email ? $user->email : 'N/A' }}"/>
                    <x-table-data value="{{ $user->phone ? $user->phone : 'N/A'}}"/>
                    <x-table-data>
                        <div class="flex flex-wrap w-full gap-1 uppercase">
                            @if ($user->roles->count() > 0)
                                @forelse ($user->roles as $role)
                                    <span class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded whitespace-nowrap dark:bg-primary-900 dark:text-primary-300 m-1">
                                        {{ $role->name }}
                                    </span>
                                @empty
                                    <span>N/A</span>
                                @endforelse
                            @endif
                        </div>
                    </x-table-data>
                    <td class="px-6 py-4">
                        <div class="flex items-start justify-center gap-3">
                            @can('view user')
                            <a href="#profileFrame{{ $user->id }}" class="glightbox4" data-gallery="gallery1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </a>
                            <div id="profileFrame{{ $user->id }}" class="hidden dark:bg-gray-800">
                                <div class="max-w-screen-xl px-2 mx-auto mt-6 lg:px-0">
                                    <div class="min-[1000px]:flex">
                                        <div class="flex flex-col items-center mb-6">
                                            <div class="max-w-[400px] w-full lg:w-auto flex flex-col gap-2 px-2 lg:px-0 border rounded-lg overflow-hidden shardow-md">
                                                @if ($user->image)
                                                    <img class="max-w-[400px] h-auto aspect-square object-cover rounded-md cursor-pointer"
                                                    src="{{ asset('assets/images/users/thumb/'.$user->image) }}"
                                                    alt="User photo">

                                                @else
                                                <img class="max-w-[400px] h-auto aspect-square object-cover rounded-md cursor-pointer"
                                                src="{{ asset('assets/icons/profile.png') }}"
                                                alt="User photo">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="lg:ml-4">
                                            <div class="mb-4 text-sm font-semibold tracking-wide text-blue-600 uppercase">
                                                User Informations
                                            </div>
                                            {{-- <h1 class="block mt-1 mb-2 text-2xl font-medium leading-tight text-gray-800 dark:text-gray-100">
                                                Your subtitle or any other text goes here Implementation of Title,
                                                Subtitle and Author name as well as any other text you like to the
                                                book cover design.
                                            </h1> --}}
                                            <div class="flex flex-col gap-2">
                                                <div class="flex nowrap">
                                                    <p class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                                        Name
                                                    </p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-200">
                                                        {{ $user->name }}
                                                    </p>
                                                </div>
                                                <div class="flex nowrap">
                                                    <p class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                                        gender
                                                    </p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-200">
                                                        {{ $user->gender ? $user->gender : 'N/A' }}
                                                    </p>
                                                </div>
                                                <div class="flex nowrap">
                                                    <p class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                                        Phone
                                                    </p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-200">
                                                        {{ $user->phone ? $user->phone : 'N/A' }}
                                                    </p>
                                                </div>
                                                <div class="flex nowrap">
                                                    <p class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                                        Email
                                                    </p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-200">
                                                        {{ $user->email ? $user->email : 'N/A' }}
                                                    </p>
                                                </div>
                                                <div class="flex nowrap">
                                                    <p class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                                        Birth Date
                                                    </p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-200">
                                                        {{ $user->date_of_birth ? $user->date_of_birth : 'N/A' }}
                                                    </p>
                                                </div>
                                                <div class="flex nowrap">
                                                    <p class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                                        Address
                                                    </p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-200">
                                                        {{ $user->address ? $user->address : 'N/A' }}
                                                    </p>
                                                </div>
                                                <div class="flex nowrap">
                                                    <p class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                                        Roles
                                                    </p>
                                                    <p class="flex flex-wrap gap-1.5 text-sm text-gray-600 uppercase dark:text-gray-600">
                                                        @forelse ($user->roles as $role)
                                                            <span class="bg-blue-200 ">{{ $role->name }}</span>
                                                        @empty
                                                            <span>N/A</span>
                                                        @endforelse
                                                    </p>
                                                </div>
                                                <div class="flex nowrap">
                                                    <p class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                                        Created At
                                                    </p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-200">
                                                        {{ $user->created_at ? $user->created_at : 'N/A' }}
                                                    </p>
                                                </div>
                                                <div class="flex nowrap">
                                                    <p class="w-[123px] uppercase tracking-wide text-sm text-gray-500 dark:text-gray-300 font-semibold border-r border-gray-600 dark:border-gray-300 pr-5 mr-5">
                                                        Updated At
                                                    </p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-200">
                                                        {{ $user->updated_at ? $user->updated_at : 'N/A' }}
                                                    </p>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan

                            @can('delete user')
                            <x-delete-confirm-button
                            identifier="{{ $user->id }}"
                            deleteUrl="{{ route('admin.users.destroy', $user->id) }}"
                            message="Are you sure you want to delete this User"
                            tooltipText="Delete User"
                            />
                            @endcan

                            @can('update user')
                            <x-edit-button
                            identifier="{{ $user->id }}"
                            {{-- editUrl="{{ route('admin.users.edit', $user->id) }}" --}}
                            editUrl="{{ url('admin/users/'.$user->id.'/edit') }}"
                            tooltipText="Edit User"
                            />
                            @endcan

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-2">
            {{ $users->links() }}
        </div>
    </div>
</div>

@endsection
