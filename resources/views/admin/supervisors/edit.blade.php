@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Edit Supervisor')" class="p-4" />

        @livewire('supervisor-edit', [
            'item' => $item,
        ])

    </div>
@endsection
