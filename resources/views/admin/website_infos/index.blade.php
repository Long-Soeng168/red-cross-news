@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Links')" />
        @livewire('link-table-data')
    </div>
@endsection
