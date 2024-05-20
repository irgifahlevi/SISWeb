@extends('Template.Siswa.master_siswa')
@section('content')
<div id="loading-overlay" style="display: none;">
  @include('Template.loading')
</div>
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-md-12">
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
                        >Profile siswa</a
                      >
                    </div>
                    <div class="list-group list-group-flush">
                        <a  class="list-group-item">Nama lengkap : {{$data->nama_lengkap}}</a>
                        <a  class="list-group-item">NIK : {{$data->nik}}</a>
                        <a  class="list-group-item">No KK : {{$data->no_kk}}</a>
                        <a  class="list-group-item">
                          No Telepon : 
                          @if ($data->no_telepon)
                            {{formatNoTelpon($data->no_telepon)}}
                          @endif
                        </a>
                        <a  class="list-group-item">Jenis Kelamin : {{$data->JenisKelaminSiswa->jenis_kelamin}}</a>
                        <a  class="list-group-item">Tempat lahir : {{$data->tempat_lahir}}</a>
                        <a  class="list-group-item">Tanggal lahir : {{$data->tanggal_lahir}}</a>
                        <a  class="list-group-item">Tanggal lahir : {{$data->tempat_tinggal}}</a>
                        <a  class="list-group-item">Agama : {{$data->agama}}</a>
                        <a  class="list-group-item">Kelurahan : {{$data->kelurahan}}</a>
                        <a  class="list-group-item">Kecamatan : {{$data->kecamatan}}</a>
                        <a  class="list-group-item">Kota : {{$data->kota}}</a>
                        <a  class="list-group-item">Kode pos : {{$data->kode_pos}}</a>
                        <a  class="list-group-item">Email : {{$data->email}}</a>
                        <a  class="list-group-item">Anak ke : {{$data->anak_ke}}</a>
                        <a  class="list-group-item">Jumlah Saudara : {{$data->jumlah_saudara}}</a>
                        <a  class="list-group-item">Alamat : {{$data->alamat}}</a>
                    </div>
                    <div class="list-group">
                      <a  class="list-group-item list-group-item-action active disabled"
                        >Akademik</a
                      >
                    </div>
                    <div class="list-group list-group-flush">
                      <a  class="list-group-item">Kelas : {{$data->KelasSiswa->kelas}}</a>
                      <a  class="list-group-item">Ruangan : {{$data->KelasSiswa->ruangan}}</a>
                      <a  class="list-group-item">NIS Lokal : {{$data->nis_lokal}}</a>
                      <a  class="list-group-item">Tahun masuk : {{$data->tahun_masuk}}</a>
                      <a  class="list-group-item">NISN : {{$data->no_nisn}}</a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="demo-inline-spacing mt-3">
                    <div class="list-group">
                      <a  class="list-group-item list-group-item-action active disabled"
                        >Wali murid / Orangtua</a
                      >
                    </div>
                    @if (count($data->SiswaWali) > 0)
                      @foreach ($data->SiswaWali as $item)
                        <div class="list-group list-group-flush">
                          <a  class="list-group-item">Nama lengkap : {{$item->nama_lengkap}}</a>
                          <a  class="list-group-item">Hubungan : {{$item->hubungan_status}}</a>
                          <a  class="list-group-item">No Telepon : 
                              @if ($item->no_telepon)
                                {{formatNoTelpon($item->no_telepon)}}
                              @endif
                            </a>
                          <a  class="list-group-item">Jenis Kelamin : {{$item->JenisKelaminWali->jenis_kelamin}}</a>
                          <a  class="list-group-item">Pekerjaan : {{$item->pekerjaan}}</a>
                          <a  class="list-group-item">Alamat : {{$item->alamat}}</a>
                        </div>
                      @endforeach   
                    @endif
                    
                    
                  </div>
                  <!--/ List group with Badges & Pills -->
                </div>
                <hr class="m-0"/>
                <div class="float-end mb-5 mt-4">
                  <a href="{{route('siswa.index')}}" class="btn btn-primary w-md">Kembali</a>
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