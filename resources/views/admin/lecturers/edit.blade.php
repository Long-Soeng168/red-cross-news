@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Edit Lecturer')" class="p-4" />

        @livewire('lecturer-edit', [
            'item' => $item,
        ])

    </div>
@endsection
