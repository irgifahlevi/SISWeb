@extends('ClientView.Template.master_index')
@section('content')
        <!-- start banner Area -->
        <section class="banner-area relative" id="home">
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
                <a class="genric-btn primary" href="{{ Route('login') }}">Login</a>
              </div>
            </div>
          </div>
        </section>
        <!-- End banner Area -->

        <!-- Start feature Area -->
        <section class="feature-area">
          <div class="container">
            <div class="row">
              <div class="col-lg-4">
                <div class="single-feature">
                  <div class="title">
                    <h4>Pendidikan berkualitas</h4>
                  </div>
                  <div class="desc-wrap">
                    <p>
                      Kami menyiapkan program pendidikan yang berkualitas dengan sarana dan prasarana yang memadai.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="single-feature">
                  <div class="title">
                    <h4>Lingkungan yang sehat</h4>
                  </div>
                  <div class="desc-wrap">
                    <p>
                      Mendukung tumbuh kembang peserta didik secara optimal serta membentuk perilaku hidup bersih dan sehat.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="single-feature">
                  <div class="title">
                    <h4>Pendidik professional</h4>
                  </div>
                  <div class="desc-wrap">
                    <p>
                      Mampu menjawab tantangan bekal pendidikan bagi peserta didik di masa depan.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End feature Area -->


        {{-- pengantar kepsek --}}
        @if ($pengantar_kepsek)
          <section class="popular-course-area section-gap" id="pengantarKepsek">
            <div class="container">
              <div class="section-top-border">
                <div class="title text-center">
                  <h1 class="mb-10">Prakata kepala sekolah</h1>
                  <p class="mb-30">MTs Al-Quraniyah Ulujami.</p>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <img src="{{ asset('storage/pengantarKepsek/' . $pengantar_kepsek->gambar) }}" alt="" class="img-fluid">
                  </div>
                  <div class="col-md-9 mt-sm-20 left-align-p">
                    <h5><i>Assalamu’alaikum Warohmatullohi Wabarokatuh</i></h5>
                    <br>
                    {{$pengantar_kepsek->deskripsi}}
                    <br>
                    <br>
                    <h5><i>Wabillahi taufik wal hidayah wassalamu’alaikum Warohmatullohi Wabarokatuh.</i></h5>
                  </div>
                </div>
            </div>
          </section>
        @endif

        <section class="popular-course-area section-gap" id="profilependidik">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="menu-content pb-70 col-lg-8">
                        <div class="title text-center">
                            <h1 class="mb-10">Profile Pendidik</h1>
                            <p>Berikut Adalah Profile Pendidik</p>
                          </div>
                    </div>
                </div>
                <div class="row">
                    <div class="active-popular-carusel">
                        @foreach ($profile_pendidik as $item)
                            <div class="single-popular-carusel">
                                <div class="thumb-wrap relative">
                                    <div class="thumb relative">
                                        <div class="overlay overlay-bg"></div>
                                        <img class="img-fluid" src="{{ asset('storage/pendidik/' . $item->foto) }}" alt="">
                                    </div>
                                </div>
                                <div class="details">
                                    <a href="{{ route('profilePendidik.show', $item->id) }}">
                                        <h4>
                                            {{ $item->ProfilePendidik->nama_lengkap }}
                                        </h4>
                                    </a><br>
                                    <p>
                                        Jabatan : {{ $item->ProfilePendidik->jabatan }}<br>
                                        Mata Pelajaran : {{ $item->ProfilePendidik->mapel }}<br>
                                        No NIP : {{ $item->ProfilePendidik->nip }}
                                        <br>
                                        No NUPTK : {{ $item->ProfilePendidik->no_nuptk }}
                                        <br>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- End Profile Pendidik -->

        <!-- Start Visi Misi-->
        <section class="search-course-area relative" id="visimisi">
          <div class="overlay overlay-bg"></div>
          <div class="container">
            <div class="row justify-content-center align-items-center">
              <div class="col-lg-8 search-course-left p-4 text-white justify-content-center">
                <h1 class="text-white ">
                 Motivasi Sekolah <br>
                </h1>
                <p>
                    MTS Alquraniyah Jakarta Ulujami, menyiapkan program pendidikan yang berkualitas dengan lingkungan yang sehat, asri dan nyaman serta didukung oleh tenaga pendidik yang professional serta sarana yang memadai akan menghasilkan lulusan yang Cerdas, Disiplin, Inovatif, dan berukhuwah islamiyah
                </p>
                <a class="genric-btn primary" href="{{ Route('register') }}">Registrasi</a>
                <div class="row details-content">
                  <div class="col single-detials">
                    <span class="lnr lnr-graduation-hat"></span>
                    <a href=""><h4>Visi</h4></a>
                    <p>
                        {{$visi_misi->visi}}
                    </p>
                  </div>
                  <div class="col single-detials">
                    <span class="lnr lnr-license"></span>
                    <a href=""><h4>Misi</h4></a>
                    @foreach ($misi_items as $item)
                      <ul class="unordered-list">
                        <li>{{$item}}</li>
                      </ul>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End  Visi-->


        <!-- Start Ekstrakulikuler -->
        <section class="upcoming-event-area section-gap" id="ekstrakulikuler">
          <div class="container">
            <div class="row d-flex justify-content-center">
              <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                  <h1 class="mb-10">Ektrakulikuler</h1>
                  <p>Berikut adalah Ekstrakulikuler sekolah</p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="active-upcoming-event-carusel">
                  @foreach ($ekstrakulikuler as $item )
                  <div class="single-carusel row align-items-center">
                        <div class="col-12 col-md-6 thumb">
                            <img class="img-fluid" src="{{asset('storage/ekskul/'. $item->gambar)}}" alt="">
                        </div>
                        <div class="detials col-12 col-md-6">
                            <p>{{ $item->created_at->translatedFormat('l, d F Y') }}</p>
                            <h4 class="mb-0">{{ $item->title }}</h4>
                            <p>Jenis Ekskul : {{ $item->jenis }}</p>
                            <h6 class="mt-3">{{ $item->nama_kegiatan }}</h6>
                        <p>
                            {{ $item->deskripsi }}
                        </p>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
        </div>
        </section>
        <!-- End Ekstrakulikuler -->

        <!-- Start cta-one Area -->
        <section class="cta-one-area relative section-gap" id="sejarah">
          <div class="container">
            <div class="overlay overlay-bg"></div>
            <div class="row justify-content-center">
              <div class="wrap">
                <h1 class="text-white">Sejarah Sekolah</h1>
                <h6 class="text-white"></h6>
                <p>
                    {{ $sejarah->deskripsi }}
                </p>
              </div>
            </div>
          </div>
        </section>
        <!-- End cta-one Area -->

        <!-- Start blog berita -->
        <section class="blog-area section-gap" id="berita">
          <div class="container">
            <div class="row d-flex justify-content-center">
              <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                  <h1 class="mb-10">Berita Sekolah</h1>
                  <p>Berikut adalah berita Sekolah</p>
                </div>
              </div>
            </div>
            <div class="row">
                @foreach ($berita as $item )
                <div class="col-lg-3 col-md-6 single-blog">
                    <div class="thumb">
                        <img class="img-fluid" src="{{asset('storage/berita/'. $item->gambar)}}" alt="">
                    </div>
                    <p class="meta"> {{ $item->created_at->translatedFormat('l, d F Y') }} | {{ $item->created_by }}</p>
                    <a href="{{ route('berita.show', $item->id) }}">
                        <h5>{{ $item->judul }}</h5>
                    </a>
                    <p>
                        {{ $item->kategori }}
                    </p>
                    <div class="description">
                        <p >
                            {{ $item->title }} <br>
                        </p>
                    </div>
                    <a href="{{ route('berita.show', $item->id) }}" class="details-btn d-flex justify-content-center align-items-center"><span class="details">Details</span><span class="lnr lnr-arrow-right"></span></a>
                </div>
                @endforeach
            </div>
            </div>
        </section>
        <!-- End blog berita -->

          <!-- Start galleri -->
        <section class="popular-course-area section-gap bg-gray" id="galeri">
            <div class="container">
                <div class="row d-flex justify-content-center">
                  <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                      <h1 class="mb-10">Galeri Sekolah</h1>
                      <p>Berikut adalah Galeri Sekolah</p>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="active-popular-carusel">
                    @foreach ($galeri as $item)
                    <div class="single-popular-carusel">
                        <div class="thumb-wrap relative">
                          <div class="thumb relative">
                            <div class="overlay overlay-bg"></div>
                            <img class="img-fluid pb-3" src="{{ asset('storage/galeri/' . $item->gambar) }}" alt="">
                          </div>
                          <div class="meta d-flex justify-content-between">
                          </div>
                        </div>
                        <div class="details">
                            <h4>
                                {{ $item->title }}
                            </h4>
                            <h6>
                                {{ $item->nama_kegiatan }}
                            </h6>
                          <p>
                            {{ $item->deskripsi }}
                          </p>
                        </div>
                      </div>
                      @endforeach
                    </div>
                </div>
              </div>
            </div>
        </section>
          <!-- End galleri -->

        <!-- Start Struktur organisasi -->
        <section class="cta-two-area" id="strukturorganisasi">
            <div class="container">
            <div class="section-top-border">
                <div class="center">
                    <h2 class="text-white text-center">Struktur Organisasi</h2>
                </div>
                <div class="d-flex justify-content-center mt-5">
                    <img src="{{ asset('ClientTemplate/img/struktur-organisai.png') }}" alt="" width="550px" height="550px">
                </div>
            </div>
            </div>
        </section>
        <!-- End Struktur organisasi -->



        <!-- Start slider -->
         <section class="popular-course-area section-gap bg-gray" id="Slider">
            <div class="container">
                <div class="row d-flex justify-content-center">
                  <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                      <h1 class="mb-10">Slider</h1>
                      <p>Berikut adalah Slider Sekolah</p>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="active-popular-carusel">
                    @foreach ($slider as $item)
                    <div class="single-popular-carusel">
                        <div class="thumb-wrap relative">
                          <div class="thumb relative">
                            <div class="overlay overlay-bg"></div>
                            <img class="img-fluid pb-3" src="{{ asset('storage/slider/' . $item->gambar) }}" alt="">
                          </div>
                          <div class="meta d-flex justify-content-between">
                          </div>
                        </div>
                        <div class="details">
                          <a href="">
                            <h4>
                                {{ $item->title }}
                            </h4>
                          </a>
                          <p>
                            {{ $item->deskripsi }}
                          </p>
                        </div>
                      </div>
                      @endforeach
                    </div>
                </div>
              </div>
            </div>
         </section>
          <!-- End slider -->

           <!-- Start FAsilitas -->
        <section class="upcoming-event-area section-gap" id="fasilitas">
            <div class="container">
                <div class="row d-flex justify-content-center">
                <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                    <h1 class="mb-10">Fasilitas</h1>
                    <p>Berikut adalah Fasilitas sekolah</p>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="active-upcoming-event-carusel">
                    @foreach ($fasilitas as $item )
                    <div class="single-carusel row align-items-center">
                            <div class="col-12 col-md-6 thumb">
                                <img class="img-fluid" src="{{asset('storage/fasilitas/'. $item->gambar)}}" alt="">
                            </div>
                            <div class="detials col-12 col-md-6">
                                <p>{{ $item->created_at->translatedFormat('l, d F Y') }}</p>
                                <h4 class="mb-0">{{ $item->nama_fasilitas }}</h4>
                                <p>{{ $item->deskripsi }}</p>
                        </div>
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </section>
          <!-- End FAsilitas -->

@endsection
