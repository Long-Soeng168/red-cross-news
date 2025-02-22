@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Audio Sub-Categories')" />
        @livewire('audio-sub-category-table-data')
    </div>
@endsection
