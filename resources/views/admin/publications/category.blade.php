@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Publication Categories')" />
        @livewire('publication-category-table-data')
    </div>
@endsection
