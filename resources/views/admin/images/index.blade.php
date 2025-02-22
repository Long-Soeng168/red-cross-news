@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Images')" />
        @livewire('image-table-data')
    </div>
@endsection
