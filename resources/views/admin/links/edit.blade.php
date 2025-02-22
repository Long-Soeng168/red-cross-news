@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Edit Link')" class="p-4" />

        @livewire('link-edit', [
            'item' => $item,
        ])

    </div>
@endsection
