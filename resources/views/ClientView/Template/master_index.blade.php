<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
  <!-- Mobile Specific Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon-->
  <link rel="shortcut icon" href="img/fav.png">
  <!-- Author Meta -->
  <meta name="author" content="colorlib">
  <!-- Meta Description -->
  <meta name="description" content="">
  <!-- Meta Keyword -->
  <meta name="keywords" content="">
  <!-- meta character set -->
  <meta charset="UTF-8">
  <!-- Site Title -->
  <title>MTs Al-Quraniyah Ulujami</title>

  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
    <!--
    CSS
    ============================================= -->
    <link rel="stylesheet" href="{{asset('ClientTemplate/css/linearicons.css')}}">
    <link rel="stylesheet" href="{{asset('ClientTemplate/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('ClientTemplate/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('ClientTemplate/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('ClientTemplate/css/nice-select.css')}}">							
    <link rel="stylesheet" href="{{asset('ClientTemplate/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('ClientTemplate/css/owl.carousel.css')}}">			
    <link rel="stylesheet" href="{{asset('ClientTemplate/css/jquery-ui.css')}}">			
    <link rel="stylesheet" href="{{asset('ClientTemplate/css/main.css')}}">

    <style>
      .truncate-multiple-lines {
          display: -webkit-box;
          -webkit-box-orient: vertical;
          overflow: hidden;
          text-overflow: ellipsis;
          line-clamp: 6;
          -webkit-line-clamp: 6;
      }

      .truncate-for-eskul {
          display: -webkit-box;
          -webkit-box-orient: vertical;
          overflow: hidden;
          text-overflow: ellipsis;
          line-clamp: 3;
          -webkit-line-clamp: 3;
      }
    </style>
</head>
<body>	
    @include('ClientView.Template.header')


          @yield('content')
    <!-- start footer Area -->		
    @include('ClientView.Template.footer')
    <!-- End footer Area -->	

    @include('ClientView.Template.scripts')
  </body>
</html>