@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Publication Types')" />
        @livewire('publication-type-table-data')
    </div>
@endsection
