<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
     <!-- [Favicon] icon -->
      <link rel="icon" href="{{ asset('admin/assets/images/fev.png')}}" type="image/x-icon" />
      <!-- [Google Font : Public Sans] icon -->
      <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
      <!-- [phosphor Icons] https://phosphoricons.com/ -->
      <link rel="stylesheet" href="{{ asset('admin/assets/fonts/phosphor/duotone/style.css')}}" />
      <!-- [Tabler Icons] https://tablericons.com -->
      <link rel="stylesheet" href="{{ asset('admin/assets/fonts/tabler-icons.min.css')}}" />
      <!-- [Feather Icons] https://feathericons.com -->
      <link rel="stylesheet" href="{{ asset('admin/assets/fonts/feather.css')}}" />
      <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
      <link rel="stylesheet" href="{{ asset('admin/assets/fonts/fontawesome.css')}}" />
      <!-- [Material Icons] https://fonts.google.com/icons -->
      <link rel="stylesheet" href="{{ asset('admin/assets/fonts/material.css')}}" />
      <!-- [Template CSS Files] -->
      <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css')}}" id="main-style-link" />
      <link rel="stylesheet" href="{{ asset('admin/assets/css/style-preset.css')}}" />
      <link rel="stylesheet" href="{{ asset('admin/assets/css/plugins/dataTables.bootstrap5.min.css')}}" />
      <link rel="stylesheet" href="{{ asset('admin/assets/fonts/phosphor/duotone/style.css')}}" />
</head>
<body>

    <main>
        @yield('content')
    </main>

   
    <footer class="pc-footer">
         <div class="footer-wrapper container-fluid">
            <div class="row">
               <div class="col-sm-6 my-1">
                  <p class="m-0">Made with &#9829; by Team <a href="#" target="_blank"> Cello Community</a></p>
               </div>
               
            </div>
         </div>
      </footer>
      <!-- Required Js -->
      <script src="{{ asset('admin/assets/js/plugins/popper.min.js')}}"></script>
      <script src="{{ asset('admin/assets/js/plugins/simplebar.min.js')}}"></script>
      <script src="{{ asset('admin/assets/js/plugins/bootstrap.min.js')}}"></script>
      <script src="{{ asset('admin/assets/js/plugins/i18next.min.js')}}"></script>
      <script src="{{ asset('admin/assets/js/plugins/i18nextHttpBackend.min.js')}}"></script>
      <script src="{{ asset('admin/assets/js/icon/custom-font.js')}}"></script>
      <script src="{{ asset('admin/assets/js/script.js')}}"></script>
      <script src="{{ asset('admin/assets/js/theme.js')}}"></script>
      <script src="{{ asset('admin/assets/js/multi-lang.js')}}"></script>
      <script src="{{ asset('admin/assets/js/plugins/feather.min.js')}}"></script>
      <script>
         layout_change('light');
      </script>
      <script>
         layout_sidebar_change('light');
      </script>
      <script>
         change_box_container('false');
      </script>
      <script>
         layout_caption_change('true');
      </script>
      <script>
         layout_rtl_change('false');
      </script>
      <script>
         preset_change('preset-1');
      </script>
</body>
</html>
