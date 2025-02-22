@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Slides')" />
        @livewire('slide-table-data')
    </div>
@endsection
