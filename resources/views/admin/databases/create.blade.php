@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Create Database')" class="p-4" />

        @livewire('database-create')

    </div>
@endsection
