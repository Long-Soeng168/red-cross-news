@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Edit Article')" class="p-4" />

        @livewire('article-edit', [
            'id' => $id
        ])

    </div>
@endsection
