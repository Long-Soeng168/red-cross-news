@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Students')" />
        @livewire('student-table-data')
    </div>
@endsection
