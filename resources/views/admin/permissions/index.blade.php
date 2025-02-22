@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Permissions')" />
        @livewire('permission-table-data')
    </div>
@endsection
