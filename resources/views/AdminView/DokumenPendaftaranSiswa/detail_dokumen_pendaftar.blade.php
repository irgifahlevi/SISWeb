@extends('Template.Admin.master_admin')
@section('content')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-md-12">

        {{-- Jika jumlah data banner lebih dari 0 --}}

        @if ($data)
          <div class="card">
            <h5 class="card-header">Detail data</h5>
            <hr class="m-0" />
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6 mb-4 mb-xl-0">
                  <div class="demo-inline-spacing mt-3">
                    <div class="list-group">
                      <a  class="list-group-item list-group-item-action active disabled"
                        >Dokumen calon siswa</a
                      >
                    </div>
                    <div class="list-group list-group-flush">
                        <a  class="list-group-item"
                          >Nama lengkap : {{$data->CalonSiswaPendaftaran->nama_lengkap}}</a
                        >

                    </div>
                  </div>
                </div>
                <hr class="m-0"/>
                <div class="float-end mb-5 mt-4">
                  <a href="{{route('dokumen-pendaftaran-siswa.index')}}" class="btn btn-primary w-md">Kembali</a>
                </div>
              </div>
          </div>

        {{-- Jika data banner kosong --}}
        @else
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Ada yang salah! 😞</h5>
                  <p class="mb-4">
                    Silahkan kembali lagi nanti
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
      </div>
    </div>
  </div>
  {{-- Footer --}}
  @include('Template.footer')

  <div class="content-backdrop fade"></div>
</div>
@endsection
