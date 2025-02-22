@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Video Sub-Categories')" />
        @livewire('video-sub-category-table-data')
    </div>
@endsection
