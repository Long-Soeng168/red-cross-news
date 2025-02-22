@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Create Audio')" class="p-4" />

        @livewire('audio-create')

    </div>
@endsection
