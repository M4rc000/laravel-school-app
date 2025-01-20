<!DOCTYPE html>
<html
  lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{ $title }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/loading-bar/loading-bar.css') }}">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/select2/select2.min.css') }}">

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <style>
    .select2-selection {
      padding-top: 4px !important;
      height: 38px !important;
    }
  
    label{
      font-weight: bold;
    }
    /* Loading overlay styling */
    #loading-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999; /* Ensure it stays on top */
    }

    /* Blur effect on body */
    body.loading {
      filter: blur(4px); /* Add blur */
      pointer-events: none; /* Disable interactions */
    }
  </style>
  
  <body>
    <!-- Content -->

    <div class="container-xxl">
        @yield('content')
    </div>

    <!-- Loading GIF -->
    <div id="loading-overlay" style="display: none;">
      <img src="assets/img/loading/loading.gif" alt="Loading" />
    </div>

    <!-- / Content -->

    {{-- SELECT2 --}}
    
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->
    
    <!-- Vendors JS -->
    
    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/sweetalert/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/loading-bar/loading-bar.js') }}"></script>
    <!-- Page JS -->
    
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
      $(document).ready(function(){
        function loadingAnimation(){
          $('button[type="submit"]').on('click', function () {
            // Show the loading overlay
            $('#loading-overlay').show();
  
            // Add the 'loading' class to the body for the blur effect
            $('.container-xxl').addClass('loading');
          });
        }

        loadingAnimation();
      });
    </script>
    </body>
</html>