@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Supervisors')" />
        @livewire('supervisor-table-data')
    </div>
@endsection
