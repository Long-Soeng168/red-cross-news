@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Create Thesis')" class="p-4" />

        @livewire('thesis-create')

    </div>
@endsection
