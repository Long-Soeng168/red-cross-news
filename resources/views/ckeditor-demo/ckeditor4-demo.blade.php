@extends('layouts.default')

@section('content')
    <div class="my-4">
        <textarea name="" id="description" cols="30" rows="10"></textarea>
        {{-- <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script> --}}
        <script src="{{ asset('/assets/ckeditor/ckeditor4/ckeditor.js') }}"></script>
        <script>
            var options = {
              filebrowserImageBrowseUrl: '{{ asset("laravel-filemanager?type=Images")}}',
              filebrowserImageUploadUrl: '{{ asset("laravel-filemanager/upload?type=Images&_token=")}}',
              filebrowserBrowseUrl: '{{ asset("laravel-filemanager?type=Files")}}',
              filebrowserUploadUrl: '{{ asset("laravel-filemanager/upload?type=Files&_token=")}}'
            };
            var areas = Array('description', 'description_label', 'description_khmer');
            areas.forEach(function(area) {
                CKEDITOR.replace(area, options);
            });

        </script>


    </div>
@endsection
