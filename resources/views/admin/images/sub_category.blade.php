@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Image Sub-Categories')" />
        @livewire('image-sub-category-table-data')
    </div>
@endsection
