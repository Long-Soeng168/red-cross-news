@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Edit Slide')" class="p-4" />

        @livewire('slide-edit', [
            'item' => $item,
        ])

    </div>
@endsection
