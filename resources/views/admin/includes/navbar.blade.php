<nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="true">
    <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
      <nav>
        <!-- breadcrumb -->
        <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
          <li class="leading-normal text-sm">
            <a class="opacity-50 text-slate-700" href="javascript:;">{{ Auth::user()->profile->setting->language == 1 ? 'Pages' : 'Halaman' }}</a>
          </li>
          <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']" aria-current="page">{{ $breadcrumbs }}</li>
        </ol>
        <h6 class="mb-0 font-bold capitalize" id="page">{{ $breadcrumbs }}</h6>
      </nav>

      <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
        <div class="flex items-center md:ml-auto md:pr-4">
          {{-- <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft">
            <span class="text-sm ease-soft leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
              <i class="fas fa-search"></i>
            </span>
            <input type="text" class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="{{ Auth::user()->profile->setting->language == 1 ? 'Type here...' : 'Tulis di sini' }}" />
          </div> --}}
        </div>
        <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full relative">
          <li class="flex items-center cursor-pointer" id='profile'>
            <a class="block px-0 py-2 font-semibold transition-all ease-nav-brand text-sm text-slate-500">
              <i class="fa fa-user sm:mr-1"></i>
            </a>
          </li>
          <li class="flex items-center pl-4 xl:hidden">
            <a href="javascript:;" class="block p-0 transition-all ease-nav-brand text-sm text-slate-500" sidenav-trigger>
              <div class="w-4.5 overflow-hidden">
                <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                <i class="ease-soft relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
              </div>
            </a>
          </li>
          <ul class="absolute z-10 w-40 rounded-lg bg-white shadow-lg top-10 hidden" id="profile-dropdown">
            <li class="w-full hover:bg-slate-200 px-2 py-2 rounded-lg cursor-pointer">
              <a class="font-sans font-semibold" href="{{ url('admin/profile') }}">{{ Auth::user()->profile->setting->language == 1 ? 'Profile and Setting' : 'Profil dan Pengaturan' }}</a>
            </li>
            <li class="w-full hover:bg-slate-200 px-2 py-2 rounded-lg cursor-pointer">
              <a class="font-sans font-semibold" href="{{ url('admin/logout') }}">{{ Auth::user()->profile->setting->language == 1 ? 'Logout' : 'Keluar' }}</a>
            </li>
          </ul>
        </ul>
      </div>
    </div>
  </nav>