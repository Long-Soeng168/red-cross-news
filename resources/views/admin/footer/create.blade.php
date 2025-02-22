@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Create Menu')" class="p-4" />

        @livewire('menu-create')

    </div>
@endsection
