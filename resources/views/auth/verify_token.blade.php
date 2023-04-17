@extends('auth.templates.main')

@section('content')
<body class="m-0 font-sans antialiased font-normal bg-white text-start text-base leading-default text-slate-500">
  <!-- Navbar -->
  <main class="mt-0 transition-all duration-200 ease-soft-in-out">
    <section class="min-h-screen">
      <div class="relative flex items-start pt-12 pb-56 m-4 overflow-hidden bg-center bg-cover min-h-50-screen rounded-xl" style="background-image: url('../img/curved0.jpg')">
        <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-gray-900 to-slate-800 opacity-60"></span>
        <div class="container z-10">
          <div class="flex flex-wrap justify-center -mx-3">
            <div class="w-full max-w-full px-3 mx-auto mt-0 text-center lg:flex-0 shrink-0 lg:w-5/12">
              <h1 class="mt-12 mb-2 text-white">Thank you for using our website</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="flex flex-wrap -mx-3 -mt-48 md:-mt-56 lg:-mt-48">
          <div class="w-full max-w-full px-3 mx-auto mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
            <div class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border py-12">
              <table align="center" border="0" width="400px" cellspacing="0" cellpadding="0" style="font-family: Arial, Helvetica, sans-serif;">
                <tbody>
                    <tr>
                        <td class="text-decoration" align="center" valign="center" style="padding-top: 10%;">
                            <h4>{{ $title }}</h4>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td class="text-decoration" align="center" valign="center">
                            {{ $sub_title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection