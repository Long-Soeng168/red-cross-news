@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Article Categories')" />
        @livewire('article-category-table-data')
    </div>
@endsection
