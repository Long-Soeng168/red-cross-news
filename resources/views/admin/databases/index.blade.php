@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Databases')" />
        @livewire('database-table-data')
    </div>
@endsection
