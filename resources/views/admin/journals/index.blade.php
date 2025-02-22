@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Journals')" />
        @livewire('journal-table-data')
    </div>
@endsection
