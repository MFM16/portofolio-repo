@extends('admin.templates.main')

@section('content')
  <div class="w-full h-full p-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
      <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl">
          <div class="p-4 mb-0 bg-white border-b-0 rounded-2xl">
            <div class="flex flex-wrap -mx-3">
              <div class="items-center w-full max-w-full px-3 shrink-0">
                <div class="flex items-center mb-7">
                  <h6>{{ Auth::user()->profile->setting->language == 1 ? 'Projects' : 'Proyek'}}</h6>
                  <button type="button" class="btn-info ml-4" id="btn-modal">
                    <i class="fas fa-plus">&nbsp;</i></i>{{ Auth::user()->profile->setting->language == 1 ? 'Add Portfolio' : 'Tambah Portofolio'}}
                  </button>
                </div>
                <table class="hover row-border order-column stripe" id="portofolio-datatable">
                  <thead>
                      <tr>
                        <th>{{ Auth::user()->profile->setting->language == 1 ? "Project Title" : 'Judul Proyek' }}</th>
                        <th>{{ Auth::user()->profile->setting->language == 1 ? "Short Description Project" : 'Deskripsi Pendek Proyek' }}</th>
                        <th>{{ Auth::user()->profile->setting->language == 1 ? "Thumbnail" : 'Gambar' }}</th>
                        <th>{{ Auth::user()->profile->setting->language == 1 ? "Action" : 'Aksi' }}</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('modal')
<div class="min-h-screen min-w-full h-full w-full backdrop-blur-md bg-transparent absolute z-990 top-0 flex items-center justify-center hidden" id="modal">
  <div class="modal-body">
    <div class="modal-header">
      <span class="modal-title">{{ Auth::user()->profile->setting->language == 1 ? "Add New Portfolio" : 'Tambah Portofolio Baru' }}</span>
      <button id="btn-close-modal">
        ❌
      </button>
    </div>
    <form id="form-modal" enctype="multipart/form-data">
      <div>
        <input type="hidden" id="id" value="">
        <input type="hidden" id="process" value="">
        <input type="hidden" id="profile_id" value="{{ Auth::user()->profile->id }}">
        <div class="grup-input">
          <div class="flex">
            <span class="form-title">{{ Auth::user()->profile->setting->language == 1 ? "Project Title" : 'Judul Proyek' }}</span>
            <span class="text-xs text-red-500 ml-1">*</span>
          </div>
          <input class="form-input" type="text" id="name">
        </div>
        <div class="grup-input">
          <div class="flex">
            <span class="form-title">{{ Auth::user()->profile->setting->language == 1 ? "Short Description Project" : 'Deskripsi Pedek Proyek' }}</span>
            <span class="text-xs text-red-500 ml-1">*</span>
          </div>
          <textarea class="form-input" id="description" cols="30" rows="3"></textarea>
        </div>
        <div class="grup-input">
          <div class="flex">
            <span class="form-title">{{ Auth::user()->profile->setting->language == 1 ? "Content" : 'Isi Proyek' }}</span>
            <span class="text-xs text-red-500 ml-1">*</span>
          </div>
          <textarea class="ck-editor" id="full_description" cols="30" rows="10"></textarea>
        </div>
        <div class="grup-input">
          <div class="flex">
            <span class="form-title">{{ Auth::user()->profile->setting->language == 1 ? "Thumbnail" : 'Gambar' }}</span>
            <span class="text-xs text-red-500 ml-1">*</span>
          </div>
          <input class="form-input" type="file" id="thumbnail">
        </div>
      </div>
    </form>
    <div class="modal-footer">
      <button class="modal-button" type="button" id="btn-portofolio">
        {{ Auth::user()->profile->setting->language == 1 ? "Save" : 'Simpan' }}
      </button>
    </div>
  </div>
</div>
@endsection

@section('script')
    <script>
      let editor;

      class MyUploadAdapter {
        constructor( loader ) {
            // The file loader instance to use during the upload.
            this.loader = loader;
        }

        // Starts the upload process.
        upload() {
            return this.loader.file
                .then( file => new Promise( ( resolve, reject ) => {
                    this._initRequest();
                    this._initListeners( resolve, reject, file );
                    this._sendRequest( file );
                } ) );
        }

        // Aborts the upload process.
        abort() {
            if ( this.xhr ) {
                this.xhr.abort();
            }
        }

        // Initializes the XMLHttpRequest object using the URL passed to the constructor.
        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();

            // Note that your request may look different. It is up to you and your editor
            // integration to choose the right communication channel. This example uses
            // a POST request with JSON as a data structure but your configuration
            // could be different.
            xhr.open( 'POST', '{{ url('admin/portofolio/image') }}', true );
            xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}')
            xhr.responseType = 'json';
        }

        // Initializes XMLHttpRequest listeners.
        _initListeners( resolve, reject, file ) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${ file.name }.`;

            xhr.addEventListener( 'error', () => reject( genericErrorText ) );
            xhr.addEventListener( 'abort', () => reject() );
            xhr.addEventListener( 'load', () => {
                const response = xhr.response;

                // This example assumes the XHR server's "response" object will come with
                // an "error" which has its own "message" that can be passed to reject()
                // in the upload promise.
                //
                // Your integration may handle upload errors in a different way so make sure
                // it is done properly. The reject() function must be called when the upload fails.
                if ( !response || response.error ) {
                    return reject( response && response.error ? response.error.message : genericErrorText );
                }

                // If the upload is successful, resolve the upload promise with an object containing
                // at least the "default" URL, pointing to the image on the server.
                // This URL will be used to display the image in the content. Learn more in the
                // UploadAdapter#upload documentation.
                resolve( {
                    default: response.url
                } );
            } );

            // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
            // properties which are used e.g. to display the upload progress bar in the editor
            // user interface.
            if ( xhr.upload ) {
                xhr.upload.addEventListener( 'progress', evt => {
                    if ( evt.lengthComputable ) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                } );
            }
        }

        // Prepares the data and sends the request.
        _sendRequest( file ) {
            // Prepare the form data.
            const data = new FormData();

            data.append( 'upload', file );

            // Important note: This is the right place to implement security mechanisms
            // like authentication and CSRF protection. For instance, you can use
            // XMLHttpRequest.setRequestHeader() to set the request headers containing
            // the CSRF token generated earlier by your application.

            // Send the request.
            this.xhr.send( data );
        }
      }

      function MyCustomUploadAdapterPlugin( editor ) {
          editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
              // Configure the URL to the upload script in your back-end here!
              return new MyUploadAdapter( loader );
          };
      }

      ClassicEditor
          .create( document.querySelector( '.ck-editor' ),{
          extraPlugins: [ MyCustomUploadAdapterPlugin ],
          } )
          .then( newEditor => {
              editor = newEditor;
          } )
          .catch( error => {
              console.error( error );
          } );
    </script>
@endsection