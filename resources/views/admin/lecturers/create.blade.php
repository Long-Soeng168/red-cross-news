@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Create Lecturer')" class="p-4" />

        @livewire('lecturer-create')

    </div>
@endsection
