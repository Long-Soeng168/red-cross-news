@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Theses')" />
        @livewire('thesis-table-data')
    </div>
@endsection
