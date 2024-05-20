@extends('Template.Siswa.master_siswa')
@section('content')
@include('Template.navbar')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div>
      <div class="row">
        <div class="col-lg-12 col-md-12 mb-4">
          @auth
              @if (auth()->user()->SiswaUser)
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Hallo, selamat datang {{ Auth::user()->username }} ! 🎉</h5>
                        
                        @if (count($tagihan) > 0)
                          <p class="mb-4">
                            Kamu memiliki tagihan yang perlu dibayar. Ayo segera lakukan pembayaran!
                          </p>
        
                          <a href="{{route('tagihan-saya.index')}}" class="btn btn-sm btn-outline-primary">Tagihan saya</a>
                        @else
                          <p class="mb-4">
                            Yeayyy! 🎉 Kamu belum memiliki tagihan saat ini.
                          </p>
                          
                          <a href="{{route('tagihan-saya.index')}}" class="btn btn-sm btn-outline-primary">Tagihan saya</a>
                        @endif
                        
                      </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                      <div class="card-body pb-0 px-0 px-md-4">
                        <img
                          src="{{asset('Template/assets/img/illustrations/man-with-laptop-light.png')}}"
                          height="140"
                          alt="View Badge User"
                          data-app-dark-img="illustrations/man-with-laptop-dark.png"
                          data-app-light-img="illustrations/man-with-laptop-light.png"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              @else
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Hallo, selamat datang {{ Auth::user()->username }} ! 🎉</h5>
                        
                        <p class="mb-4">
                          Maaf akunmu sepenuhnya belum lengkap, silahkan hubungi admin untuk melengkapi profile kamu 😞
                        </p>

                      </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                      <div class="card-body pb-0 px-0 px-md-4">
                        <img
                          src="{{asset('Template/assets/img/illustrations/man-with-laptop-light.png')}}"
                          height="140"
                          alt="View Badge User"
                          data-app-dark-img="illustrations/man-with-laptop-dark.png"
                          data-app-light-img="illustrations/man-with-laptop-light.png"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              @endif
          @endauth
        </div>
      </div>
    </div>
  </div>
  {{-- Footer --}}
  @include('Template.footer')

  <div class="content-backdrop fade"></div>
</div>
@endsection