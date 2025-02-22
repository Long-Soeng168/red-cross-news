@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Create Link')" class="p-4" />

        @livewire('link-create')

    </div>
@endsection
