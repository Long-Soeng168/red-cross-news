@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Image Categories')" />
        @livewire('image-category-table-data')
    </div>
@endsection
