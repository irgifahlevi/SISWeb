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
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        {{-- Sidebar --}}
        @include('Template.Admin.menu')

        {{-- Content --}}
        <div class="layout-page">
      

          <div id="notificationToast" class="bs-toast toast fade position-absolute top-0 end-0 bg-primary mx-3 my-3" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold toast-title"></div>
                <small class="toast-time"></small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <span class="username"></span>
                <br>
                <span class="email"></span>
                <br>
                <span class="time"></span>
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

    @include('Template.scripts')
    <script>
    // Inisialisasi Pusher dengan credentials yang diberikan
    var pusher = new Pusher('b50c5dbe04d752052ab6', {
        cluster: 'mt1',
        encrypted: true
    });

    // Langganan ke channel yang sesuai dengan pusher Anda
    var channel = pusher.subscribe('notifications');

    // Menangani event 'pusher:subscription_succeeded'
    channel.bind('pusher:subscription_succeeded', function() {
        console.log('Berlangganan berhasil.');
    });

    // Menangani event 'new-notification'
    channel.bind('eventsNotifications', function(data) {
        console.log('Data notifikasi baru diterima:', data);
        var message = data.message;
        showNotification(data.message.title, data.message.username, data.message.email);
    });

    // Fungsi untuk menampilkan notifikasi
    function showNotification(title, username, email) {
        var notificationToast = document.getElementById('notificationToast');
        var toastTitle = notificationToast.querySelector('.toast-title');
        var toastBody = notificationToast.querySelector('.toast-body');
        var toastTime = notificationToast.querySelector('.toast-time');

        // Mendapatkan waktu saat ini
        var currentTime = getCurrentTime();

        // Mengisi konten notifikasi dengan data yang diterima
        toastTitle.textContent = title;
        toastBody.querySelector('.username').textContent = "Nama pengguna : " + username;
        toastBody.querySelector('.email').textContent = "Email : " + email;
        toastTime.textContent = currentTime;
        
        // Menampilkan toast
        var bsToast = new bootstrap.Toast(notificationToast);
        bsToast.show();
    }

    // Fungsi untuk mendapatkan waktu saat ini dalam format hh:mm:ss
    function getCurrentTime() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();

        // Menambahkan leading zero jika perlu
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        return hours + ':' + minutes + ':' + seconds;
    }
</script>
  </body>
</html>
