@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Create Video')" class="p-4" />

        @livewire('video-create')

    </div>
@endsection
