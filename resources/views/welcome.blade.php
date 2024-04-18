@extends('auth.template.master')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <!-- Layout Demo -->
      <div class="layout-demo-wrapper">
        <div class="layout-demo-info">
          <h4>Welcome</h4>
          <h2>SISTEM INFORMASI SEKOLAH</h2>
          <div class="demo-inline-spacing">
            <a href="{{route('login')}}" class="btn btn-primary">Login</a>
            <a href="{{route('register')}}" class="btn btn-secondary">Register</a>
          </div>
        </div>
      </div>
      <!--/ Layout Demo -->
    </div>
  </div>
@endsection
