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
        @include('Template.Siswa.menu')

        {{-- Content --}}
        <div class="layout-page">
            @yield('content')
        </div>
      </div>
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    @yield('scripts')

    @include('Template.scripts')
  </body>
</html>
