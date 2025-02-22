@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Lecturers')" />
        @livewire('lecturer-table-data')
    </div>
@endsection
