@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Locations')" />
        @livewire('location-table-data')
    </div>
@endsection
