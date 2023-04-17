<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="lang" content="1" />
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ url('css/soft-ui-dashboard-tailwind.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
</head>
@yield('content')
<footer class="py-12 absolute m-auto left-0 right-0">
    <div class="container">
      <div class="flex flex-wrap -mx-3">
        <div class="w-8/12 max-w-full px-3 mx-auto mt-1 text-center flex-0">
          <p class="mb-0 text-slate-400">
            Copyright ©
            <script>
              document.write(new Date().getFullYear());
            </script>
            Soft by Creative Tim.
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
</main>
</body>
<script>
  var button = document.getElementById("registration_button")
  if (button){
      button.addEventListener("click", function() {
      button.setAttribute("disabled", true);
    })
  }
</script>
<script src="{{ url('js/jquery.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="//cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script src="{{ url('js/app.js') }}"></script>
</html>