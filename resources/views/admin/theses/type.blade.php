@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Thesis Types')" />
        @livewire('thesis-type-table-data')
    </div>
@endsection
