@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Audio Types')" />
        @livewire('audio-type-table-data')
    </div>
@endsection
