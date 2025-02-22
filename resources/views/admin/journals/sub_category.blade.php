@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Publication Sub-Categories')" />
        @livewire('publication-sub-category-table-data')
    </div>
@endsection
