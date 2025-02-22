@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Edit Video')" class="p-4" />

        @livewire('video-edit', [
            'id' => $id
        ])

    </div>
@endsection
