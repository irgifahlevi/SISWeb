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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <script>
      $(document).ready(function () {
        $('#loading-overlay').hide();
        $('.rupiah').mask("#.##0", {reverse: true});
        $('.phone').mask('000-0000-000000');
      });
    </script>