<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="lang" content="{{ $profile->setting->language }}" />
    <link rel="stylesheet" href="{{ url('css/build.css') }}">
    <script src="https://kit.fontawesome.com/ae1d3b3f4f.js" crossorigin="anonymous"></script>
    <title>Website Portofolio</title>
</head>

<body>
    @include('includes.navbar')

    @yield('content')

    @include('includes.footer')

</body>

</html>