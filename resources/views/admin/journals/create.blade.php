@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Create Journal')" class="p-4" />

        @livewire('journal-create')

    </div>
@endsection
