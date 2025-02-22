@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Edit Menu')" class="p-4" />

        @livewire('menu-edit', [
            'menu' => $menu,
        ])

    </div>
@endsection
