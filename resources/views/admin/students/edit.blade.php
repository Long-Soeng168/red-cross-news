@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Edit Student')" class="p-4" />

        @livewire('student-edit', [
            'item' => $item,
        ])

    </div>
@endsection
