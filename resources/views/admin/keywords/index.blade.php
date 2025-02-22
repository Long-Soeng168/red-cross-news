@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Keywords')" />
        @livewire('keyword-table-data')
    </div>
@endsection
