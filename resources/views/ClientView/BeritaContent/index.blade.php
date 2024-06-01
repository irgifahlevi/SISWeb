@extends('ClientView.BeritaContent.master_index')
@section('content')
        <!-- start banner Area -->
        <section class="banner-area relative">
            <div class="overlay overlay-bg"></div>
            <div class="container">
              <div class="row fullscreen d-flex align-items-center justify-content-between">
                <div class="banner-content col-lg-9 col-md-12">
                  <h1 class="text-uppercase">
                    Selamat datang di <br> MTs Al-Quraniyah Ulujami
                  </h1>
                  <p class="pt-10 pb-10">
                    Menghasilkan lulusan yang Cerdas, Disiplin, Inovatif, dan berukhuwah islamiyah
                  </p>
                </div>
              </div>
            </div>
          </section>
          <!-- End banner Area -->
        <!-- Start event-details Area -->
        <section class="event-details-area section-gap">
            <div class="container" >
                <div class="row">
                    <div class="col-lg-8 event-details-left" >
                        <div class="main-img">
                            <img src="{{ asset('storage/berita/' . $berita->gambar) }}" alt="" class="img-fluid">
                        </div>
                        <div class="details-content">
                            <div class="mt-2">
                                <h2>{{ $berita->judul }}</h2>
                            </div>
                            <p>
                                <h5>{{ $berita->title }}</h5>
                            <p>
                                {{ $berita->deskripsi }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 event-details-right">
                        <div class="single-event-details">
                            <h4>Details</h4>
                            <ul class="mt-10">
                                <li class="justify-content-between d-flex">
                                    <span>Start date</span>
                                    <span>{{ ($berita->created_at)->translatedFormat('l, d F Y') }}</span>
                                </li>
                                <li class="justify-content-between d-flex">
                                    <span>Ketegori Berita</span>
                                    <span>{{ $berita->kategori }}</span>
                                </li>
                                <li class="justify-content-between d-flex">
                                    <span>Penulis</span>
                                    <span>{{ $berita->created_by }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End event-details Area -->
        @endsection
