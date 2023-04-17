@extends('admin.templates.main')

@section('content')
  <div class="w-full px-6 mx-auto">
    <div class="relative flex items-center p-0 mt-6 overflow-hidden bg-center bg-cover min-h-75 rounded-2xl" style="background-image: url('../img/curved0.jpg'); background-position-y: 50%">
      <span class="absolute inset-y-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-purple-700 to-pink-500 opacity-60"></span>
    </div>
    <div class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 -mt-16 overflow-hidden break-words border-0 shadow-blur rounded-2xl bg-white/80 bg-clip-border backdrop-blur-2xl backdrop-saturate-200">
      <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-auto max-w-full px-3">
          <div class="text-base ease-soft-in-out h-18.5 w-18.5 relative inline-flex items-center justify-center rounded-xl text-white transition-all duration-200">
            <img src="{{ asset(Auth::user()->profile->photo) }}" alt="profile_image" class="w-full shadow-soft-sm rounded-xl" />
          </div>
        </div>
        <div class="flex-none w-auto max-w-full px-3 my-auto">
          <div class="h-full">
            <h5 class="mb-1">{{ $user->name }}</h5>
            <p class="mb-0 font-semibold leading-normal text-sm">{{ $user->job }}</p>
          </div>
        </div>
        <div class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
        </div>
      </div>
    </div>
  </div>
  <div class="w-full p-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
      <div class="w-full max-w-full px-3">
        <div class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
          <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
            <div class="flex flex-wrap -mx-3">
              <div class="flex items-center w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                <h6 class="mb-0">{{ Auth::user()->profile->setting->language == 1 ? 'Profile Information' : 'Profil' }}</h6>
              </div>
              <div class="w-full max-w-full px-3 text-right shrink-0 md:w-4/12 md:flex-none">
                <div class="cursor-pointer" id="edit-profile">
                  <i class="leading-normal fas fa-user-edit text-sm text-slate-400"></i>
                </div>
                <div data-target="tooltip" class="hidden px-2 py-1 text-center text-white bg-black rounded-lg text-sm" role="tooltip">
                  Edit Profile
                  <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                </div>
              </div>
            </div>
          </div>
          <div class="flex-auto p-4">
            <p class="leading-normal text-sm">{{ $user->biography }}</p>
            <hr class="h-px my-6 bg-transparent bg-gradient-to-r from-transparent via-white to-transparent" />
            <ul class="flex flex-col pl-0 mb-0 rounded-lg">
              <li class="relative block px-4 py-2 pt-0 pl-0 leading-normal bg-white border-0 rounded-t-lg text-sm text-inherit"><strong class="text-slate-700">{{ Auth::user()->profile->setting->language == 1 ? 'Full Name :' : 'Nama Panjang :' }}</strong> &nbsp; {{ $user->name }}</li>
              <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit"><strong class="text-slate-700">{{ Auth::user()->profile->setting->language == 1 ? 'Email :' : 'Email :' }}</strong> &nbsp; {{ Auth::user()->email }}</li>
              <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit"><strong class="text-slate-700">{{ Auth::user()->profile->setting->language == 1 ? 'Address :' : 'Alamat :' }}</strong> &nbsp; {{ $user->address }}</li>
              <li class="relative block px-4 py-2 pb-0 pl-0 bg-white border-0 border-t-0 rounded-b-lg text-inherit">
                <strong class="leading-normal text-sm text-slate-700">{{ Auth::user()->profile->setting->language == 1 ? 'Social Media :' : 'Sosial Media :' }}</strong> &nbsp;
                @foreach ($socials as $social)
                  <a class="inline-block py-0 pl-1 pr-2 mb-0 font-bold text-center align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-none" href="{{ $social->url }}" target="_blank">
                    <i class="{{ $social->logo }}"></i>
                  </a>
                @endforeach
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="flex-none w-full max-w-full px-3 mt-6">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
          <div class="p-4 pb-0 mb-0 bg-white rounded-t-2xl">
            <h6 class="mb-1">{{ Auth::user()->profile->setting->language == 1 ? 'Account Setting' : 'Pengaturan Akun' }}</h6>
            <p class="leading-normal text-sm">{{ Auth::user()->profile->setting->language == 1 ? 'Customize your own website' : 'Sesuaikan situs web anda sendiri' }}</p>
          </div>
          <div class="p-4">
            <div class="-mx-3">
              <form class="ml-2">
                <input type="hidden" id="setting_id" value="{{ Auth::user()->profile->setting->id }}">
                <div class="mb-6 flex flex-col">
                  <label class="mb-2">{{ Auth::user()->profile->setting->language == 1 ? 'Language' : 'Bahasa' }}</label>
                  <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="1" class="sr-only peer" id="lang" {{ Auth::user()->profile->setting->language == 1 ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    <span class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">English</span>
                  </label>
                  <span class="text-xs text-red-500 mt-1">{{ Auth::user()->profile->setting->language == 1 ? "* if the toggle is off, the website will use Indonesian" : '* Jika tombol ini hidup, maka situs web akan menggunakan Bahasa Inggris' }}</span>
                </div>
                <div class="mb-6 flex flex-col">
                  <label class="mb-2">{{ Auth::user()->profile->setting->language == 1 ? 'Client Section' : 'Bagian Klien' }}</label>
                  <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="1" class="sr-only peer" id="client" {{ Auth::user()->profile->setting->client == 1 ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    <span class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">On</span>
                  </label>
                  <span class="text-xs text-red-500 mt-1">{{ Auth::user()->profile->setting->language == 1 ? "* Turn it on if you want the client section to appear" : '* Nyalakan jika ingin memunculkan bagian klien' }}</span>
                </div>
                <div class="mb-6 flex flex-col">
                  <label class="mb-2">{{ Auth::user()->profile->setting->language == 1 ? 'Blog Section' : 'Bagian Tulisan / Artikel' }}</label>
                  <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="1" class="sr-only peer" id="blog" {{ Auth::user()->profile->setting->blog == 1 ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    <span class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">On</span>
                  </label>
                  <span class="text-xs text-red-500 mt-1">{{ Auth::user()->profile->setting->language == 1 ? "* Turn it on if you want the blog section to appear" : '* Nyalakan jika ingin memunculkan bagian artikel / tulisan' }}</span>
                </div>
                <div class="mb-6">
                  <button class="modal-button" type="button" id="btn-setting">
                    {{ Auth::user()->profile->setting->language == 1 ? 'Save' : 'Simpan' }}
                  </button>
                </div>
              </form>
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
      <span class="modal-title">{{ Auth::user()->profile->setting->language == 1 ? 'Update Profile' : 'Perbaharui Profil' }}</span>
      <button id="btn-close-modal">
        ❌
      </button>
    </div>
    <form enctype="multipart/form-data">
      <div>
        <input type="hidden" id="id_profile" value="{{ Auth::user()->profile->id }}">
        <div class="grup-input">
          <div class="flex">
            <span class="form-title">{{ Auth::user()->profile->setting->language == 1 ? 'Full Name' : 'Nama Panjang' }}</span>
            <span class="text-xs text-red-500 ml-1">*</span>
          </div>
          <input class="form-input" type="text" id="name">
        </div>
        <div class="grup-input">
          <div class="flex">
            <span class="form-title">{{ Auth::user()->profile->setting->language == 1 ? 'Nickname' : 'Nama Panggilan' }}</span>
            <span class="text-xs text-red-500 ml-1">*</span>
          </div>
          <input class="form-input" type="text" id="nickname">
        </div>
        <div class="grup-input">
          <div class="flex">
            <span class="form-title">{{ Auth::user()->profile->setting->language == 1 ? 'Address' : 'Alamat' }}</span>
            <span class="text-xs text-red-500 ml-1">*</span>
          </div>
          <textarea class="form-input" id="address" rows="3"></textarea>
        </div>
        <div class="grup-input">
          <div class="flex">
            <span class="form-title">{{ Auth::user()->profile->setting->language == 1 ? 'Biography' : 'Biografi' }}</span>
            <span class="text-xs text-red-500 ml-1">*</span>
          </div>
          <textarea class="form-input" id="biography" rows="3"></textarea>
        </div>
        <div class="grup-input">
          <div class="flex">
            <span class="form-title">{{ Auth::user()->profile->setting->language == 1 ? 'Job' : 'Pekerjaan' }}</span>
            <span class="text-xs text-red-500 ml-1">*</span>
          </div>
          <input class="form-input" type="text" id="job">
        </div>
        <div class="grup-input">
          <div class="flex">
            <span class="form-title">{{ Auth::user()->profile->setting->language == 1 ? 'Job Description' : 'Deskripsi Pekerjaan' }}</span>
            <span class="text-xs text-red-500 ml-1">*</span>
          </div>
          <textarea class="form-input" id="job_description" rows="3"></textarea>
        </div>
        <div class="grup-input">
          <span class="form-title">{{ Auth::user()->profile->setting->language == 1 ? 'Photo' : 'Foto' }}</span>
          <input class="form-input" type="file" id="photo">
        </div>
        <div class="grup-input">
          <span class="form-title">{{ Auth::user()->profile->setting->language == 1 ? 'Website Logo' : 'Logo Situs Web' }}</span>
          <input class="form-input" type="file" id="logo">
        </div>
      </div>
    </form>
    <div class="modal-footer">
      <button class="modal-button" type="button" id="btn-edit-profile">
        {{ Auth::user()->profile->setting->language == 1 ? 'Save' : 'Simpan' }}
      </button>
    </div>
  </div>
</div>
@endsection