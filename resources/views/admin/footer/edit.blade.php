@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Edit Footer')" class="p-4" />

        @livewire('footer-edit', [
            'footer' => $footer,
        ])

    </div>
@endsection
