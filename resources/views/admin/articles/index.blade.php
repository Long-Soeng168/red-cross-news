@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Articles')" />
        @livewire('article-table-data')
    </div>
@endsection
