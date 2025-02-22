@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Videos')" />
        @livewire('video-table-data')
    </div>
@endsection
