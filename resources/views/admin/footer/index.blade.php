@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Menus')" />
        @livewire('menu-table-data')
    </div>
@endsection
