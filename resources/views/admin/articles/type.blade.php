@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Article Types')" />
        @livewire('article-type-table-data')
    </div>
@endsection
