@extends('layouts.default')

@section('content')
    <div class="no-tailwind">
        <textarea name="" id="description" cols="30" rows="10"></textarea>
        <script src="{{ asset('/assets/ckeditor/ckeditor5/build/ckeditor.js') }}"></script>
        <script>
            var config = {
              filebrowserImageBrowseUrl: '{{ asset("laravel-filemanager?type=Images")}}',
              filebrowserImageUploadUrl: '{{ asset("laravel-filemanager/upload?type=Images&_token=")}}',
              filebrowserBrowseUrl: '{{ asset("laravel-filemanager?type=Files")}}',
              filebrowserUploadUrl: '{{ asset("laravel-filemanager/upload?type=Files&_token=")}}'
            };
            const watchdog = new CKSource.EditorWatchdog();

            window.watchdog = watchdog;

            watchdog.setCreator( ( element, config ) => {
                return CKSource.Editor
                    .create( element, config )
                    .then( editor => {
                        return editor;
                    } );
            } );

            watchdog.setDestructor( editor => {
                return editor.destroy();
            } );

            watchdog.on( 'error', handleSampleError );

            watchdog
                .create( document.querySelector( '#description' ), {
                    // Editor configuration.
                } )
                .catch( handleSampleError );

            function handleSampleError( error ) {
                const issueUrl = 'https://github.com/ckeditor/ckeditor5/issues';

                const message = [
                    'Oops, something went wrong!',
                    `Please, report the following error on ${ issueUrl } with the build id "ew0wrnbb0gww-mf9g9ylt1ids" and the error stack trace:`
                ].join( '\n' );

                console.error( message );
                console.error( error );
            }

        </script>



    </div>
@endsection
