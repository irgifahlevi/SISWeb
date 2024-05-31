@extends('ClientView.ProfilePendidikContent.master_index')
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
                    <div class="col-lg-8 event-details-left">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ asset('storage/pendidik/' . $profile_pendidik->foto) }}" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-4 mt-sm-20 left-align-p">
                                <div>
                                    <p><h6>Nama Lengkap </h6> {{ $profile_pendidik->ProfilePendidik->nama_lengkap }}</p>
                                </div>
                                <div class="mt-2">
                                    <p><h6>Tempat , Tanggal Lahir </h6>{{ $profile_pendidik->tempat_lahir }} , {{ $profile_pendidik->tanggal_lahir }}</p>
                                    <p><h6>Agama</h6>{{ $profile_pendidik->agama }}</p>
                                    <p><h6>Jabatan </h6>{{ $profile_pendidik->ProfilePendidik->jabatan }}</p>
                                    <p><h6>Mapel </h6>    {{ $profile_pendidik->ProfilePendidik->jabatan }}</p>
                                    <p><h6>Nip </h6>{{ $profile_pendidik->ProfilePendidik->nip }}</p>
                                    <p><h6>No Nuptk </h6>{{ $profile_pendidik->ProfilePendidik->no_nuptk }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 event-details-right">
                        <div class="single-event-details">
                            <h4>Details</h4>
                            <ul class="mt-10">
                                <li class="justify-content-between d-flex">
                                    <span>Tanggal Ditambahkan</span>
                                    <span>{{ ($profile_pendidik->created_at)->translatedFormat('l, d F Y') }}</span>
                                </li>
                                <li class="justify-content-between d-flex">
                                    <span>DItambahkan Oleh</span>
                                    <span>{{ $profile_pendidik->created_by }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- End event-details Area -->
        @endsection
