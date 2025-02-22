@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Roles')" />
        @livewire('role-table-data')
    </div>
@endsection
