@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Edit Database')" class="p-4" />

        @livewire('database-edit', [
            'item' => $item,
        ])

    </div>
@endsection
