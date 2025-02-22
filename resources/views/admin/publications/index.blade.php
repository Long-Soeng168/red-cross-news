@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Publications')" />
        @livewire('publication-table-data')
    </div>
@endsection
