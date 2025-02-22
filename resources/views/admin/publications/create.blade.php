@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Create E-Publication')" class="p-4" />

        @livewire('publication-create')

    </div>
@endsection
