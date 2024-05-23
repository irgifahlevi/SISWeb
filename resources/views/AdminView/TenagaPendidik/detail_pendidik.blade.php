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
                        >Profile pendidik</a
                      >
                    </div>
                    <div class="list-group list-group-flush">
                        <a  class="list-group-item"
                          >Nama lengkap : {{$data->ProfilePendidik->nama_lengkap}}</a
                        >
                        <a  class="list-group-item"
                          >NIP : {{$data->ProfilePendidik->nip}}</a
                        >
                        <a  class="list-group-item"
                          >No NUPTK : {{$data->ProfilePendidik->no_nuptk}}</a
                        >
                        <a  class="list-group-item"
                          >Mengajar bidang : {{$data->ProfilePendidik->mapel}}</a
                        >
                        <a  class="list-group-item"
                          >Jabatan : {{$data->ProfilePendidik->jabatan}}</a
                        >
                        <a  class="list-group-item"
                          >NIK : {{$data->nik}}</a
                        >
                        <a  class="list-group-item"
                          >No Telepon : {{formatNoTelpon($data->no_telepon)}}</a
                        >
                        <a  class="list-group-item"
                          >Jenis Kelamin : {{$data->JenisKelaminPendidik->jenis_kelamin}}</a
                        >
                        <a  class="list-group-item"
                          >Email : {{$data->email}}</a
                        >
                        <a  class="list-group-item"
                          >Alamat lengkap : {{$data->alamat}}</a
                        >
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="demo-inline-spacing mt-3">
                    <div class="list-group">
                    </div>
                    <div class="list-group list-group-flush">
                        <a  class="list-group-item"
                          >Pendidikan terakhir : {{$data->pendidikan}}</a
                        >
                        <a  class="list-group-item"
                          >Tempat lahir : {{$data->tempat_lahir}}</a
                        >
                        <a  class="list-group-item"
                          >Tanggal lahir : {{$data->tanggal_lahir}}</a
                        >
                        <a  class="list-group-item"
                          >Agama : {{$data->agama}}</a
                        >
                        <a  class="list-group-item"
                          >Kelurahan : {{$data->kelurahan}}</a
                        >
                        <a  class="list-group-item"
                          >Kecamatan : {{$data->kecamatan}}</a
                        >
                        <a  class="list-group-item"
                          >Kota : {{$data->kota}}</a
                        >
                        <a  class="list-group-item"
                          >Kode pos : {{$data->kode_pos}}</a
                        >
                        <a  class="list-group-item"
                          >Foto :
                          <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img
                              src="{{ asset('storage/pendidik/' . $data->foto) }}"
                              alt="user-avatar"
                              class="d-block rounded"
                              height="100"
                              width="100"
                              id="uploadedAvatar"
                            />
                          </div>
                          </a
                          
                        >
                        
                    </div>
                  </div>
                  <!--/ List group with Badges & Pills -->
                </div>
                <hr class="m-0"/>
                <div class="float-end mb-5 mt-4">
                  <a href="{{route('tenaga-pendidik.index')}}" class="btn btn-primary w-md">Kembali</a>
                </div>
              </div>
          </div>
        
        {{-- Jika data banner kosong --}}
        @else
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Data tidak di temukan! 😞</h5>
                    <p class="mb-4">
                      Data yang Anda cari dengan kata kunci <strong>{{ $id }}</strong> tidak ditemukan dalam sistem.
                    </p>
                    <a href="{{route('tenaga-pendidik.index')}}" class="btn btn-sm btn-outline-primary">Kembali</a>
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