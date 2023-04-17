@extends('admin.templates.main')

@section('content')
  <div class="w-full h-full p-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
      <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl">
          <div class="p-4 mb-0 bg-white border-b-0 rounded-2xl">
            <div class="flex flex-wrap -mx-3">
              <div class="items-center w-full max-w-full px-3 shrink-0">
                @if (Auth::user()->role == 1)
                  <div class="flex items-center mb-7">
                    <h6>{{ Auth::user()->profile->setting->language == 1 ? 'Feedbacks List' : 'Daftar Ulasan'}}</h6>
                  </div>
                  <table class="hover row-border order-column stripe" id="feedback-datatable">
                    <thead>
                        <tr>
                            <th>{{ Auth::user()->profile->setting->language == 1 ? '#' : 'No.'}}</th>
                            <th>{{ Auth::user()->profile->setting->language == 1 ? 'Category' : 'Kategori'}}</th>
                            <th>{{ Auth::user()->profile->setting->language == 1 ? 'Feedback' : 'Ulasan' }}</th>
                            <th>{{ Auth::user()->profile->setting->language == 1 ? 'Action' : 'Aksi' }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                @else
                  <div class="flex items-center mb-7">
                    <h6>{{ Auth::user()->profile->setting->language == 1 ? 'Feedback' : 'Ulasan'}}</h6>
                  </div>

                  <form id="form-modal">
                    <div>
                      <div class="grup-input">
                        <div class="flex">
                          <span class="form-title">{{ Auth::user()->profile->setting->language == 1 ? 'Category' : 'Kategori' }}</span>
                          <span class="text-xs text-red-500 ml-1">*</span>
                        </div>
                        <select class="form-input" id="category" required>
                          <option value="">{{ Auth::user()->profile->setting->language == 1 ? 'Select Category' : 'Pilih Kategori' }}</option>
                          <option value="Critics">{{ Auth::user()->profile->setting->language == 1 ? 'Critic' : 'Kritik' }}</option>
                          <option value="Suggest">{{ Auth::user()->profile->setting->language == 1 ? 'Suggestion' : 'Saran' }}</option>
                          <option value="Request">{{ Auth::user()->profile->setting->language == 1 ? 'Request' : 'Permintaan' }}</option>
                        </select>
                      </div>
                      <div class="grup-input">
                        <div class="flex">
                          <span class="form-title">{{ Auth::user()->profile->setting->language == 1 ? 'Feedback' : 'Ulasan' }}</span>
                          <span class="text-xs text-red-500 ml-1">*</span>
                        </div>
                        <textarea class="form-input" id="content" cols="10" rows="10"></textarea>
                      </div>
                    </div>
                  </form>
                  <button class="modal-button mt-2" type="button" id="btn-feedback">
                    {{ Auth::user()->profile->setting->language == 1 ? 'Save' : 'Simpan' }}
                  </button>
                @endif                
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
      <span class="modal-title">{{ Auth::user()->profile->setting->language == 1 ? 'Detail Feedback' : 'Rincian Ulasan' }}</span>
      <button id="btn-close-modal">
        ❌
      </button>
    </div>
    <form id="form-modal">
      <div>
        <div class="grup-input">
          <div class="flex">
            <span class="form-title">{{ Auth::user()->profile->setting->language == 1 ? 'Category' : 'Kategori' }}</span>
            <span class="text-xs text-red-500 ml-1">*</span>
          </div>
          <input class="form-input" type="text" id="category">
        </div>
        <div class="grup-input">
          <div class="flex">
            <span class="form-title">{{ Auth::user()->profile->setting->language == 1 ? 'Feedback' : 'Ulasan' }}</span>
            <span class="text-xs text-red-500 ml-1">*</span>
          </div>
          <textarea class="form-input" id="content" cols="10" rows="10"></textarea>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection