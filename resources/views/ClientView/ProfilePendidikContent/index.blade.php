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
                <div class="row d-flex justify-content-center">
                    <div class="menu-content pb-70 col-lg-8">
                        <div class="title text-center">
                        <h1 class="mb-10">Profile detail</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 event-details-left">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ asset('storage/pendidik/' . $profile_pendidik->foto) }}" alt="" class="img-fluid">
                                </div>
                                <div class="col-md-4 mt-sm-20 left-align-p">
                                    <div class="mb-2">
                                        <h6>Nama Lengkap</h6>
                                        <p class="card-text">{{ $profile_pendidik->ProfilePendidik->nama_lengkap }}</p>
                                    </div>
                                    <div class="mb-2">
                                        <h6>Tempat, Tanggal Lahir</h6>
                                        <p class="card-text">{{ $profile_pendidik->tempat_lahir }}, {{ $profile_pendidik->tanggal_lahir }}</p>
                                    </div>
                                    <div class="mb-2">
                                        <h6>Jenis kelamin</h6>
                                        <p class="card-text">{{ $profile_pendidik->JenisKelaminPendidik->jenis_kelamin }}</p>
                                    </div>
                                    <div class="mb-2">
                                        <h6>Agama</h6>
                                        <p class="card-text">{{ $profile_pendidik->agama }}</p>
                                    </div>
                                    <div class="mb-2">
                                        <h6>Jabatan</h6>
                                        <p class="card-text">{{ $profile_pendidik->ProfilePendidik->jabatan }}</p>
                                    </div>
                                    <div class="mb-2">
                                        <h6>Mata pelajaran</h6>
                                        <p class="card-text">{{ $profile_pendidik->ProfilePendidik->mapel }}</p>
                                    </div>
                                    <div class="mb-2">
                                        <h6>NIP</h6>
                                        <p class="card-text">{{ $profile_pendidik->ProfilePendidik->nip }}</p>
                                    </div>
                                    <div class="mb-2">
                                        <h6>No NUPTK</h6>
                                        <p class="card-text">{{ $profile_pendidik->ProfilePendidik->no_nuptk }}</p>
                                    </div>
                                    <div class="mb-2">
                                        <h6>No telepon</h6>
                                        <p class="card-text">{{ $profile_pendidik->no_telepon }}</p>
                                    </div>
                                    <div class="mb-2">
                                        <h6>No telepon</h6>
                                        <p class="card-text">{{ $profile_pendidik->email }}</p>
                                    </div>
                                    <div class="mb-2">
                                        <h6>Alamat</h6>
                                        <p class="card-text">{{ $profile_pendidik->alamat }}</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-lg-4 event-details-right">
                        <div class="single-event-details">
                            <h4>Details</h4>
                            <ul class="mt-10">
                                <li class="justify-content-between d-flex">
                                    <span>Tanggal</span>
                                    <span>{{ ($profile_pendidik->created_at)->translatedFormat('l, d F Y') }}</span>
                                </li>
                                <li class="justify-content-between d-flex">
                                    <span>Dibuat oleh</span>
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
