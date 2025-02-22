@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Image Types')" />
        @livewire('image-type-table-data')
    </div>
@endsection
