@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Create Image')" class="p-4" />

        @livewire('image-create')

    </div>
@endsection
