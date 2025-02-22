@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Video Categories')" />
        @livewire('video-category-table-data')
    </div>
@endsection
