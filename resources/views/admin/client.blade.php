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
                  <h6>{{ Auth::user()->profile->setting->language == 1 ? 'Clients' : 'Klien' }}</h6>
                  <button type="button" class="btn-info ml-4" id="btn-modal">
                    <i class="fas fa-plus">&nbsp;</i></i>{{ Auth::user()->profile->setting->language == 1 ? 'Add Client Picture' : 'Tambah Foto Klien' }}
                  </button>
                </div>
                <table class="hover row-border order-column stripe" id="client-datatable">
                  <thead>
                      <tr>
                          <th>{{ Auth::user()->profile->setting->language == 1 ? 'Client Name' : 'Nama Klien' }}</th>
                          <th>{{ Auth::user()->profile->setting->language == 1 ? 'Photo' : 'Foto' }}</th>
                          <th>{{ Auth::user()->profile->setting->language == 1 ? 'Action' : 'Aksi' }}</th>
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
      <span class="modal-title">{{ Auth::user()->profile->setting->language == 1 ? 'Add Client Picture' : 'Tambah Foto Klien' }}</span>
      <button id="btn-close-modal">
        ❌
      </button>
    </div>
    <form id="form-modal" enctype="multipart/form-data">
      <div>
        <input type="hidden" id="id" value="">
        <input type="hidden" id="profile_id" value="{{ Auth::user()->profile->id }}">
        <input type="hidden" id="process" value="">
        <div class="grup-input">
          <div class="flex">
            <span class="form-title">{{ Auth::user()->profile->setting->language == 1 ? 'Name' : 'Nama' }}</span>
            <span class="text-xs text-red-500 ml-1">*</span>
          </div>
          <input class="form-input" type="text" id="name">
        </div>
        <div class="grup-input">
          <div class="flex">
            <span class="form-title">{{ Auth::user()->profile->setting->language == 1 ? 'Photo' : 'Foto' }}</span>
            <span class="text-xs text-red-500 ml-1">*</span>
          </div>
          <input class="form-input" type="file" id="photo">
        </div>
      </div>
    </form>
    <div class="modal-footer">
      <button class="modal-button" type="button" id="btn-client">
        {{ Auth::user()->profile->setting->language == 1 ? 'Save' : 'Simpan' }}
      </button>
    </div>
  </div>
</div>
@endsection