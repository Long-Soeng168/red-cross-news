@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Edit Thesis')" class="p-4" />

        @livewire('thesis-edit', ['id' => $id])

    </div>
@endsection
