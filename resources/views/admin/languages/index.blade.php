@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Languages')" />
        @livewire('language-table-data')
    </div>
@endsection
