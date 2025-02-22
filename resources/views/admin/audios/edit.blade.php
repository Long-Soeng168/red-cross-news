@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Edit Audio')" class="p-4" />

        @livewire('audio-edit', [
            'id' => $id
        ])

    </div>
@endsection
