@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Create Bulletin')" class="p-4" />

        @livewire('news-create')

    </div>
@endsection
