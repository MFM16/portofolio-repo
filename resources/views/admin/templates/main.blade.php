<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('img/apple-icon.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="lang" content="{{ Auth::user()->profile->setting->language }}" />
    <link rel="icon" type="image/png" href="{{ url('img/favicon.png') }}" />
    <title>Admin Area</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/ae1d3b3f4f.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="{{ url('css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ url('css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <!-- Main Styling -->
    <link href="{{ url('css/soft-ui-dashboard-tailwind.css?v=1.0.4') }}" rel="stylesheet" />    
    <link href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.css" rel="stylesheet" /> 
  </head>

  <body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500" id="body">
    <!-- sidenav  -->
    @include('admin.includes.sidebar')
    <!-- end sidenav -->
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
      <!-- Navbar -->
      @include('admin.includes.navbar')
      <!-- end Navbar -->
      <!-- content -->
      @yield('content')
      <!-- end content -->
    </main>
    @yield('modal')
  </body>
  @include('admin.includes.footer')
  @yield('script')
</html>
