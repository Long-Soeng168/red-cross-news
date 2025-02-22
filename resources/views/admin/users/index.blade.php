@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Users')" />
        @livewire('user-table-data')
    </div>
@endsection
