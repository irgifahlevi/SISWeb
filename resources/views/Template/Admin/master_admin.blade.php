<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{asset('Template/assets/')}}"
  data-template="vertical-menu-template-free"
>
  <head>
    @include('Template.header')
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        {{-- Sidebar --}}
        @include('Template.Admin.menu')

        {{-- Content --}}
        <div class="layout-page">
      

          <div class="bs-toast toast fade show position-absolute top-0 end-0 bg-primary mx-3 my-3" role="alert" aria-live="assertive" aria-atomic="true" >
            <div class="toast-header">
              <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Bootstrap</div>
                <small>11 mins ago</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.
            </div>
          </div>
            @yield('content')
        </div>
      </div>
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    @yield('scripts')

    <script src="{{asset('Template/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('Template/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('Template/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('Template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{asset('Template/assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('Template/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('Template/assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('Template/assets/js/dashboards-analytics.js')}}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
