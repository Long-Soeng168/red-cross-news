@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Authors')" />
        @livewire('author-table-data')
    </div>
@endsection
