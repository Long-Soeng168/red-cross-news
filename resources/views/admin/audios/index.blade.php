@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Audios')" />
        @livewire('audio-table-data')
    </div>
@endsection
