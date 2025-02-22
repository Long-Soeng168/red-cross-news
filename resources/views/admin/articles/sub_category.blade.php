@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Article Sub-Categories')" />
        @livewire('article-sub-category-table-data')
    </div>
@endsection
