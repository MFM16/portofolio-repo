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
                  <h6>{{ Auth::user()->profile->setting->language == 1 ? "Skills" : 'Keahlian' }}</h6>
                  <button type="button" class="btn-info ml-4" id="btn-modal">
                    <i class="fas fa-plus">&nbsp;</i></i>{{ Auth::user()->profile->setting->language == 1 ? "Add Skill" : 'Tambah Keahlian' }}
                  </button>
                </div>
                <table class="hover row-border order-column stripe" id="skill-datatable">
                  <thead>
                      <tr>
                          <th>{{ Auth::user()->profile->setting->language == 1 ? "#" : 'No.' }}</th>
                          <th>{{ Auth::user()->profile->setting->language == 1 ? "Name" : 'Nama' }}</th>
                          <th>{{ Auth::user()->profile->setting->language == 1 ? "Icon" : 'Ikon' }}</th>
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
      <span class="modal-title">{{ Auth::user()->profile->setting->language == 1 ? "Add New Skill" : 'Tambah Keahlian Baru' }}</span>
      <button id="btn-close-modal">
        ❌
      </button>
    </div>
    <form id="form-modal">
      <div>
        <input type="hidden" id="id_profile" value="{{ Auth::user()->profile->id }}">
        <input type="hidden" id="id_skill" value="">
        <input type="hidden" id="process" value="">
        <div class="grup-input">
          <div class="flex">
            <span class="form-title">{{ Auth::user()->profile->setting->language == 1 ? "Name" : 'Nama' }}</span>
            <span class="text-xs text-red-500 ml-1">*</span>
          </div>
          <input class="form-input" type="text" id="name">
        </div>
        <div class="grup-input">
          <div class="flex">
            <span class="form-title">{{ Auth::user()->profile->setting->language == 1 ? "Icon" : 'Ikon' }}</span>
            <span class="text-xs text-red-500 ml-1">*</span>
          </div>
          <select class="form-input" id="logo">
            <option value="">{{ Auth::user()->profile->setting->language == 1 ? "Select icon" : 'Pilih ikon' }}</option>
            @foreach ($logos as $item)
                <option value="{{ $item->icon }}">{{ $item->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </form>
    <div class="modal-footer">
      <button class="modal-button" type="button" id="btn-skill">
        {{ Auth::user()->profile->setting->language == 1 ? "Save" : 'Simpan' }}
      </button>
    </div>
  </div>
</div>
@endsection