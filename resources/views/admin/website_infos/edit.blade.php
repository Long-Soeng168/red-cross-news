@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Edit Website Info')" class="p-4" />

        @livewire('website-info-edit', [
            'item' => $item,
        ])

    </div>
@endsection
