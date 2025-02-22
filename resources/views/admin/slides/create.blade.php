@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Create Slide')" class="p-4" />

        @livewire('slide-create')

    </div>
@endsection
