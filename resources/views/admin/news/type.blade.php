@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Bulletin Types')" />
        @livewire('news-type-table-data')
    </div>
@endsection
