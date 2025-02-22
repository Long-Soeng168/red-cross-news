@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Audio Categories')" />
        @livewire('audio-category-table-data')
    </div>
@endsection
