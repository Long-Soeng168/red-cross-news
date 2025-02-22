@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Publishers')" />
        @livewire('publisher-table-data')
    </div>
@endsection
