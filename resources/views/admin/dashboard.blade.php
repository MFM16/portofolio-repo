@extends('admin.templates.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <!-- row 1 -->
    <div class="flex flex-wrap justify-between -mx-3">
      <div class="w-1/2 px-3 mb-6">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
          <div class="flex-auto p-4">
            <div class="flex justify-between">
              <div class="flex-none w-2/3 max-w-full px-3">
                <div>
                  <p class="mb-0 font-sans font-semibold leading-normal text-sm">{{ Auth::user()->profile->setting->language == 1 ? 'User' : 'Pengguna' }}</p>
                  <h5 class="mb-0 font-bold">
                    {{ $countUser }}
                  </h5>
                </div>
              </div>
              <div class="px-3 text-right">
                <div class="w-12 h-12 text-center flex justify-center items-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                  <svg class="w-7 h-7" viewBox="0 0 32.000001 32.000001" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://www.w3.org/2000/svg" version="1.1" id="svg2"><metadata id="metadata7"><rdf:RDF><cc:Work><dc:format>image/svg+xml</dc:format><dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"/><dc:title/><dc:creator><cc:Agent><dc:title>Timothée Giet</dc:title></cc:Agent></dc:creator><dc:date>2021</dc:date><dc:description/><cc:license rdf:resource="http://creativecommons.org/licenses/by-sa/4.0/"/></cc:Work><cc:License rdf:about="http://creativecommons.org/licenses/by-sa/4.0/"><cc:permits rdf:resource="http://creativecommons.org/ns#Reproduction"/><cc:permits rdf:resource="http://creativecommons.org/ns#Distribution"/><cc:requires rdf:resource="http://creativecommons.org/ns#Notice"/><cc:requires rdf:resource="http://creativecommons.org/ns#Attribution"/><cc:permits rdf:resource="http://creativecommons.org/ns#DerivativeWorks"/><cc:requires rdf:resource="http://creativecommons.org/ns#ShareAlike"/></cc:License></rdf:RDF></metadata><circle r="7.5" cy="9.5" cx="16" id="path839" style="opacity:1;vector-effect:none;fill:white;fill-opacity:1;stroke:none;stroke-width:2;stroke-linecap:butt;stroke-linejoin:bevel;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:3.20000005;stroke-opacity:1"/><path id="rect841" d="M16 19c6.648 0 12 2.899 12 6.5V32H4v-6.5C4 21.899 9.352 19 16 19z" style="opacity:1;vector-effect:none;fill:white;fill-opacity:1;stroke:none;stroke-width:2;stroke-linecap:butt;stroke-linejoin:bevel;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:3.20000005;stroke-opacity:1"/></svg>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="flex flex-wrap my-6 -mx-3">
      <!-- card 1 -->
      <div class="w-full max-w-full px-3 mt-0 mb-6">
        <div class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
          <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
            <div class="flex flex-wrap mt-0 -mx-3">
              <div class="flex-none w-7/12 max-w-full px-3 mt-0 lg:w-1/2 lg:flex-none">
                <h6>{{ Auth::user()->profile->setting->language == 1 ? 'Users List' : 'Daftar Pengguna' }}</h6>
              </div>
            </div>
          </div>
          <div class="flex-auto p-6 px-0 pb-2">
            <div class="overflow-x-auto">
              <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                <thead class="align-bottom">
                  <tr>
                    <th class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">{{ Auth::user()->profile->setting->language == 1 ? 'Name' : 'Nama' }}</th>
                    <th class="px-6 py-3 pl-2 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">{{ Auth::user()->profile->setting->language == 1 ? 'Registered Star' : 'Terdaftar Mulai' }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                  <tr>
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                      <div class="flex px-2 py-1">
                        <div>
                          <img src="{{ asset($user->profile->photo) }}" class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl" alt="xd" />
                        </div>
                        <div class="flex flex-col justify-center">
                          <h6 class="mb-0 leading-normal text-sm">{{ $user->profile->name }}</h6>
                        </div>
                      </div>
                    </td>
                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                      @php
                        Auth::user()->profile->setting->language == 1 ? setlocale(LC_ALL, 'USD') : setlocale(LC_ALL, 'IND');
                        echo strftime('%d %B %Y', strtotime($user->created_at));
                      @endphp 
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                {{ $users->links() }}
              </table>
            </div>
          </div>
        </div>
      </div> 
    </div>
  </div>
@endsection