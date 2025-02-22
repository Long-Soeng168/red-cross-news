@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Create Supervisor')" class="p-4" />

        @livewire('supervisor-create')

    </div>
@endsection
