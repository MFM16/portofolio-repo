<aside class="max-w-62.5 ease-nav-brand z-990 fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between rounded-2xl border-0 bg-white p-0 antialiased shadow-none transition-transform duration-200 xl:left-0 xl:translate-x-0 xl:bg-transparent">
    <div class="h-19.5">
      <i class="absolute top-0 right-0 hidden p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden" sidenav-close></i>
      <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700">
        <img src="{{ asset(Auth::user()->profile->logo) }}" class="inline h-full max-w-full transition-all duration-200 ease-nav-brand max-h-8" alt="main_logo" />
        <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand overflow-ellipsis">{{ Auth::user()->profile->nickname }}</span>
      </a>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />

    <div class="items-center block w-auto overflow-auto h-screen grow basis-full">
      <ul class="flex flex-col pl-0 mb-0">

        @if (Auth::user()->role == 1)
          <li class="mt-0.5 w-full">
            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ $pages == 'Dashboard' ? 'active' : '' }}" href="{{ url('admin/dashboard') }}">
              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5 {{ $pages == 'Dashboard' ? 'active-logo' : '' }}">
                <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <title>shop</title>
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g transform="translate(-1716.000000, -439.000000)" fill="{{ $pages == 'Dashboard' ? '#FFFFFF' : '#000000' }}" fill-rule="nonzero">
                      <g transform="translate(1716.000000, 291.000000)">
                        <g transform="translate(0.000000, 148.000000)">
                          <path
                            class="opacity-60"
                            d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"
                          ></path>
                          <path
                            class=""
                            d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"
                          ></path>
                        </g>
                      </g>
                    </g>
                  </g>
                </svg>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard</span>
            </a>
          </li>
          <li class="mt-0.5 w-full">
            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ $pages == 'Logo' ? 'active' : '' }}" href="{{ url('admin/logo') }}">
              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-white text-center xl:p-2.5 {{ $pages == 'Logo' ? 'active-logo' : '' }}">
                <svg class="{{ $pages == 'Logo' ? 'fill-current' : '#000000' }}" width="12px" height="12px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M116.65 219.35a15.68 15.68 0 0 0 22.65 0l96.75-99.83c28.15-29 26.5-77.1-4.91-103.88C203.75-7.7 163-3.5 137.86 22.44L128 32.58l-9.85-10.14C93.05-3.5 52.25-7.7 24.86 15.64c-31.41 26.78-33 74.85-5 103.88zm143.92 100.49h-48l-7.08-14.24a27.39 27.39 0 0 0-25.66-17.78h-71.71a27.39 27.39 0 0 0-25.66 17.78l-7 14.24h-48A27.45 27.45 0 0 0 0 347.3v137.25A27.44 27.44 0 0 0 27.43 512h233.14A27.45 27.45 0 0 0 288 484.55V347.3a27.45 27.45 0 0 0-27.43-27.46zM144 468a52 52 0 1 1 52-52 52 52 0 0 1-52 52zm355.4-115.9h-60.58l22.36-50.75c2.1-6.65-3.93-13.21-12.18-13.21h-75.59c-6.3 0-11.66 3.9-12.5 9.1l-16.8 106.93c-1 6.3 4.88 11.89 12.5 11.89h62.31l-24.2 83c-1.89 6.65 4.2 12.9 12.23 12.9a13.26 13.26 0 0 0 10.92-5.25l92.4-138.91c4.88-6.91-1.16-15.7-10.87-15.7zM478.08.33L329.51 23.17C314.87 25.42 304 38.92 304 54.83V161.6a83.25 83.25 0 0 0-16-1.7c-35.35 0-64 21.48-64 48s28.65 48 64 48c35.2 0 63.73-21.32 64-47.66V99.66l112-17.22v47.18a83.25 83.25 0 0 0-16-1.7c-35.35 0-64 21.48-64 48s28.65 48 64 48c35.2 0 63.73-21.32 64-47.66V32c0-19.48-16-34.42-33.92-31.67z"/></svg>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ Auth::user()->profile->setting->language == 1 ? 'Icons' : 'Ikon' }}</span>
            </a>
          </li>
        @endif
          
        @if (Auth::user()->role == 0)
          <li class="mt-0.5 w-full">
            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ $pages == 'Portofolio' ? 'active' : '' }}" href="{{ url('admin/portofolio') }}">
              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5 {{ $pages == 'Portofolio' ? 'active-logo' : '' }}">
                <svg fill="{{ $pages == 'Portofolio' ? '#FFFFFF' : '#000000' }}" width="12px" height="12px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                  viewBox="0 0 512 512" xml:space="preserve">
                  <g>
                    <g>
                      <path d="M457.697,324.848l-23.273,4.231l-93.091,16.924v26.36c0,12.853-10.418,23.273-23.273,23.273H193.939
                        c-12.851,0-23.273-10.42-23.273-23.273v-26.36l-93.091-16.924l-23.273-4.233l-23.273-4.233V480.97
                        c0,12.853,10.422,23.273,23.273,23.273h403.394c12.854,0,23.273-10.42,23.273-23.273V320.616L457.697,324.848z"/>
                    </g>
                  </g>
                  <g>
                    <g>
                      <path d="M488.727,100.848H372.364V77.576V54.303V31.03c0-12.853-10.418-23.273-23.273-23.273H162.909
                        c-12.851,0-23.273,10.42-23.273,23.273v23.273v23.273v23.273H23.273C10.422,100.848,0,111.27,0,124.121v124.121
                        c0,11.247,8.046,20.885,19.11,22.897l33.548,6.101l11.371,2.067l106.637,19.389v-19.423c0-12.853,10.422-23.273,23.273-23.273
                        h124.123c12.854,0,23.273,10.42,23.273,23.273v19.423l106.636-19.389l11.373-2.067l33.548-6.101
                        c11.067-2.012,19.108-11.65,19.108-22.897V124.121C512,111.27,501.583,100.848,488.727,100.848z M325.82,77.576v23.273H186.182
                        V77.576V54.303H325.82V77.576z"/>
                    </g>
                  </g>
                </svg>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ Auth::user()->profile->setting->language == 1 ? 'Portfolio' : 'Portofolio' }}</span>
            </a>
          </li>

          <li class="mt-0.5 w-full">
            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ $pages == 'Skill' ? 'active' : '' }}" href="{{ url('admin/skill') }}">
              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center fill-current stroke-0 text-center xl:p-2.5 {{ $pages == 'Skill' ? 'active-logo' : '' }}">
                <svg fill="{{ $pages == 'Skill' ? '#FFFFFF' : '#000000' }}" width="12px" height="12px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                  <title/>
                  <g data-name="Team Skill" id="Team_Skill">
                    <path d="M21,57v3.5H19V57a3,3,0,0,0-.88-2.13,3.29,3.29,0,0,0-.81-.57,2.45,2.45,0,0,1-.26.06,2.43,2.43,0,0,1-.26.06,3.84,3.84,0,0,1-.76.08H16a4,4,0,0,1-.77-.08l-.24,0-.27-.07A3,3,0,0,0,13,57v3.5H11V57a5,5,0,0,1,1.81-3.83,4.51,4.51,0,1,1,6.38,0c.12.09.23.19.34.29A5.05,5.05,0,0,1,21,57Z"/>
                    <path d="M21,35.5V39H19V35.5a3,3,0,0,0-.88-2.13,3.29,3.29,0,0,0-.81-.57,2.45,2.45,0,0,1-.26.06,2.43,2.43,0,0,1-.26.06A3.84,3.84,0,0,1,16,33H16a4,4,0,0,1-.77-.08l-.24,0-.27-.07A3,3,0,0,0,13,35.5V39H11V35.5a5,5,0,0,1,1.81-3.83,4.51,4.51,0,1,1,6.38,0c.12.09.23.19.34.29A5.05,5.05,0,0,1,21,35.5Z"/>
                    <path d="M21,14v3.5H19V14a3,3,0,0,0-.88-2.13,3.29,3.29,0,0,0-.81-.57,2.45,2.45,0,0,1-.26.06,2.43,2.43,0,0,1-.26.06,3.84,3.84,0,0,1-.76.08H16a4,4,0,0,1-.77-.08l-.24,0-.27-.07A3,3,0,0,0,13,14v3.5H11V14a5,5,0,0,1,1.81-3.83,4.51,4.51,0,1,1,6.38,0c.12.09.23.19.34.29A5.05,5.05,0,0,1,21,14Z"/>
                    <path d="M50,28H30a3,3,0,0,0-3,3v2a3,3,0,0,0,3,3H50a3,3,0,0,0,3-3V31A3,3,0,0,0,50,28Zm1,5a1,1,0,0,1-1,1H40V30H50a1,1,0,0,1,1,1Z"/>
                    <path d="M50,7H30a3,3,0,0,0-3,3v2a3,3,0,0,0,3,3H50a3,3,0,0,0,3-3V10A3,3,0,0,0,50,7Zm1,5a1,1,0,0,1-1,1H37V9H50a1,1,0,0,1,1,1Z"/>
                    <path d="M50,49H30a3,3,0,0,0-3,3v2a3,3,0,0,0,3,3H50a3,3,0,0,0,3-3V52A3,3,0,0,0,50,49Zm1,5a1,1,0,0,1-1,1H45V51h5a1,1,0,0,1,1,1Z"/>
                  </g>
                </svg>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ Auth::user()->profile->setting->language == 1 ? 'Skills' : 'Keahlian' }}</span>
            </a>
          </li>

          @if (Auth::user()->profile->setting->blog == 1)
            <li class="mt-0.5 w-full">
              <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ $pages == 'Post' ? 'active' : '' }}" href="{{ url('admin/post') }}">
                <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-white text-center xl:p-2.5 {{ $pages == 'Post' ? 'active-logo' : '' }}">
                  <svg class="{{ $pages == 'Post' ? 'fill-current' : '' }}" width="12px" height="12px" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0" fill="none" width="20" height="20"/>
                    <g>
                    <path d="M16.89 1.2l1.41 1.41c.39.39.39 1.02 0 1.41L14 8.33V18H3V3h10.67l1.8-1.8c.4-.39 1.03-.4 1.42 0zm-5.66 8.48l5.37-5.36-1.42-1.42-5.36 5.37-.71 2.12z"/>
                    </g>
                  </svg>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ Auth::user()->profile->setting->language == 1 ? 'Blog' : 'Artikel / Tulisan' }}</span>
              </a>
            </li>
          @endif

          <li class="mt-0.5 w-full">
            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ $pages == 'Social' ? 'active' : '' }}" href="{{ url('admin/social') }}">
              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-white text-center xl:p-2.5 {{ $pages == 'Social' ? 'active-logo' : '' }}">
                <svg class="{{ $pages == 'Social' ? 'fill-current' : '#000000' }}" width="12px" height="12px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                  viewBox="0 0 504 504" xml:space="preserve">
                <g>
                  <g>
                    <path d="M152.4,229.2l9.2,3.2c-4.8-9.2-14.4-15.2-25.2-15.2c-16,0-28.8,13.2-28.8,29.2s12.8,29.2,28.8,29.2c2.8,0,5.6-0.4,8.4-1.2
                      l-13.6-4.8c-10.8-6-15.2-20-9.2-31.2C128,227.2,141.6,223.2,152.4,229.2z"/>
                  </g>
                </g>
                <g>
                  <g>
                    <path d="M285.6,271.6c-2.4,0-4.8,0.4-6.8,0.8l17.2,6c10.8,6,15.2,20,9.2,31.2s-19.6,15.2-30.4,9.2l-18.8-6.4
                      c4,12.8,15.6,22,29.6,22c17.2,0,30.8-14,30.8-31.6C316.4,285.2,302.8,271.6,285.6,271.6z"/>
                  </g>
                </g>
                <g>
                  <g>
                    <path d="M377.6,0H126C56.8,0,0,56.8,0,126.4V378c0,69.2,56.8,126,126,126h251.6c69.6,0,126.4-56.8,126.4-126.4V126.4
                      C504,56.8,447.2,0,377.6,0z M374,261.2l-35.2,30.4c0.4,2.4,0.8,4.8,0.8,7.6c0,26-20.8,47.2-46.4,47.2c-22,0-40.8-15.6-45.2-36.8
                      l-87.2-30c-6.8,5.2-15.6,8.4-24.8,8.4c-22.8,0-41.2-18.8-41.2-41.6s18.4-41.6,41.2-41.6c19.6,0,35.6,13.6,40,32.4l84,28.8
                      c8-8.4,19.6-13.6,32-14l12.8-38.8c0-0.8,0-1.6,0-2.4c0-29.2,23.6-53.2,52.4-53.2s52.4,24,52.4,53.2C409.2,234,394.4,254,374,261.2
                      z"/>
                  </g>
                </g>
                <g>
                  <g>
                    <path d="M356.8,169.6c-22.8,0-40.8,18.4-40.8,41.2s18.4,41.2,40.8,41.2c22.4,0,40.8-18.4,40.8-41.2
                      C397.2,188,379.2,169.6,356.8,169.6z M356.4,240.8c-16,0-29.2-13.2-29.2-29.6c0-16.4,13.2-29.6,29.2-29.6s29.2,13.2,29.2,29.6
                      C385.6,227.6,372.8,240.8,356.4,240.8z"/>
                  </g>
                </g>
                </svg>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ Auth::user()->profile->setting->language == 1 ? 'Social Media Account' : 'Akun Media Sosial' }}</span>
            </a>
          </li>

          @if (Auth::user()->profile->setting->client == 1)    
            <li class="mt-0.5 w-full">
              <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ $pages == 'Client' ? 'active' : '' }}" href="{{ url('admin/client') }}">
              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-white text-center xl:p-2.5 {{ $pages == 'Client' ? 'active-logo' : '' }}">
                  <svg fill="{{ $pages == 'Client' ? '#FFFFFF' : '#000000' }}" width="12px" height="12px" viewBox="0 0 36 36" version="1.1"  preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <path class="clr-i-solid clr-i-solid-path-1" d="M12,16.14q-.43,0-.87,0a8.67,8.67,0,0,0-6.43,2.52l-.24.28v8.28H8.54v-4.7l.55-.62.25-.29a11,11,0,0,1,4.71-2.86A6.59,6.59,0,0,1,12,16.14Z"></path><path class="clr-i-solid clr-i-solid-path-2" d="M31.34,18.63a8.67,8.67,0,0,0-6.43-2.52,10.47,10.47,0,0,0-1.09.06,6.59,6.59,0,0,1-2,2.45,10.91,10.91,0,0,1,5,3l.25.28.54.62v4.71h3.94V18.91Z"></path><path class="clr-i-solid clr-i-solid-path-3" d="M11.1,14.19c.11,0,.2,0,.31,0a6.45,6.45,0,0,1,3.11-6.29,4.09,4.09,0,1,0-3.42,6.33Z"></path><path class="clr-i-solid clr-i-solid-path-4" d="M24.43,13.44a6.54,6.54,0,0,1,0,.69,4.09,4.09,0,0,0,.58.05h.19A4.09,4.09,0,1,0,21.47,8,6.53,6.53,0,0,1,24.43,13.44Z"></path><circle class="clr-i-solid clr-i-solid-path-5" cx="17.87" cy="13.45" r="4.47"></circle><path class="clr-i-solid clr-i-solid-path-6" d="M18.11,20.3A9.69,9.69,0,0,0,11,23l-.25.28v6.33a1.57,1.57,0,0,0,1.6,1.54H23.84a1.57,1.57,0,0,0,1.6-1.54V23.3L25.2,23A9.58,9.58,0,0,0,18.11,20.3Z"></path>
                      <rect x="0" y="0" width="36" height="36" fill-opacity="0"/>
                  </svg>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ Auth::user()->profile->setting->language == 1 ? 'Clients' : 'Klien' }}</span>
              </a>
            </li>
          @endif
        @endif

        <li class="mt-0.5 w-full">
             <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ $pages == 'Feedback' ? 'active' : '' }}" href="{{ url('admin/feedback') }}">
             <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-white text-center xl:p-2.5 {{ $pages == 'Feedback' ? 'active-logo' : '' }}">
              <svg width="12px" height="12px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                <title>ic_fluent_person_feedback_24_filled</title>
                <desc>Created with Sketch.</desc>
                <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="ic_fluent_person_feedback_24_filled" fill="{{ $pages == 'Feedback' ? '#FFFFFF' : '#000000' }}" fill-rule="nonzero">
                        <path d="M10.75,14 C11.9926407,14 13,15.0073593 13,16.25 L13,17.7519766 L12.9921156,17.8604403 C12.6813607,19.9866441 10.7715225,21.0090369 7.5667905,21.0090369 C4.37361228,21.0090369 2.43330141,19.9983408 2.01446278,17.8965776 L2,17.75 L2,16.25 C2,15.0073593 3.00735931,14 4.25,14 L10.75,14 Z M7.5,6 C9.43299662,6 11,7.56700338 11,9.5 C11,11.4329966 9.43299662,13 7.5,13 C5.56700338,13 4,11.4329966 4,9.5 C4,7.56700338 5.56700338,6 7.5,6 Z M19.75,2 C20.9926407,2 22,3.00735931 22,4.25 L22,7.75 C22,8.99264069 20.9926407,10 19.75,10 L18.197189,10 L15.6555465,12.2070729 C15.2384861,12.5691213 14.6068936,12.5245251 14.2448452,12.1074647 C14.0869422,11.9255688 14,11.6927904 14,11.4522588 L13.9993343,9.98619411 C12.8746672,9.86153043 12,8.90790995 12,7.75 L12,4.25 C12,3.00735931 13.0073593,2 14.25,2 L19.75,2 Z" id="🎨-Color">
                        </path>
                    </g>
                </g>
            </svg>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">{{ Auth::user()->profile->setting->language == 1 ? 'User Feedback' : 'Ulasan Pengguna' }}</span>
            </a>
          </li>
      </ul>
    </div>
  </aside>