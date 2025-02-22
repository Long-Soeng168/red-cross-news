@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Bulletin Sub-Categories')" />
        @livewire('news-sub-category-table-data')
    </div>
@endsection
