@extends('layouts.default')

@section('content')

    <div class="py-12">
        <div class="flex flex-col lg:flex-row px-7 lg:px-0 gap-10">
            <div class="flex-1 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div>
                    @include('user.partials.update-profile-information-form')
                </div>
            </div>

            <div class="flex-1 p-4 sm:p-8 bg-white shadow sm:rounded-lg mt-4 sm:mt-0">
                <div>
                    @include('user.partials.update-password-form')
                </div>
            </div>
        </div>


    </div>

@endsection

