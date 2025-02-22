@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Thesis Categories')" />
        @livewire('thesis-category-table-data')
    </div>
@endsection
