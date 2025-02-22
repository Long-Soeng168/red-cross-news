@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Journal Types')" />
        @livewire('journal-type-table-data')
    </div>
@endsection
