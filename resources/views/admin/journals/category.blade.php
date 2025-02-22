@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Journal Categories')" />
        @livewire('journal-category-table-data')
    </div>
@endsection
