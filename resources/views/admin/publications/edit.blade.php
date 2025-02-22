@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Edit E-Publication')" class="p-4" />

        @livewire('publication-edit', [
            'id' => $id
        ])

    </div>
@endsection
