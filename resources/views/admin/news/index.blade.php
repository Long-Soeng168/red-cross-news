@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Bulletins')" />
        @livewire('news-table-data')
    </div>
@endsection
