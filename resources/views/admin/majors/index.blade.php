@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Majors')" />
        @livewire('major-table-data')
    </div>
@endsection
