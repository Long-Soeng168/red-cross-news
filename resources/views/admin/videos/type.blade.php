@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Video Types')" />
        @livewire('video-type-table-data')
    </div>
@endsection
