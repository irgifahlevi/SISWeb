@extends('Template.Admin.master_admin')
@section('content')
<div id="loading-overlay" style="display: none;">
  @include('Template.loading')
</div>
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-md-12">
        @if ($data)
        <div class="card mb-4">
          <h5 class="card-header">Data detail pendaftar</h5>
          <!-- Account -->
          
          <hr class="my-0" />
          <div class="card-body">
              <div class="row">
                <div class="col-lg-6 mb-4 mb-xl-0">
                  <div class="demo-inline-spacing mt-3">
                    <div class="list-group">
                      <a  class="list-group-item list-group-item-action active disabled"
                        >Profile calon siswa</a
                      >
                    </div>
                    <div class="list-group list-group-flush">
                        <a  class="list-group-item"
                          >Nama lengkap : {{$data->CalonSiswaPendaftaran->nama_lengkap}}</a
                        >
                        <a  class="list-group-item"
                          >NIK : {{$data->CalonSiswaPendaftaran->nik}}</a
                        >
                        <a  class="list-group-item"
                          >No KK : {{$data->CalonSiswaPendaftaran->no_kk}}</a
                        >
                        <a  class="list-group-item"
                          >No NISN : {{$data->CalonSiswaPendaftaran->no_nisn}}</a
                        >
                        <a  class="list-group-item"
                          >No Telepon : {{formatNoTelpon($data->CalonSiswaPendaftaran->no_telepon)}}</a
                        >
                        <a  class="list-group-item"
                          >Jenis Kelamin : {{$data->CalonSiswaPendaftaran->JenisKelaminCalonSiswa->jenis_kelamin}}</a
                        >
                        <a  class="list-group-item"
                          >Tempat lahir : {{$data->CalonSiswaPendaftaran->tempat_lahir}}</a
                        >
                        <a  class="list-group-item"
                          >Tanggal lahir : {{$data->CalonSiswaPendaftaran->tanggal_lahir}}</a
                        >
                        <a  class="list-group-item"
                          >Agama : {{$data->CalonSiswaPendaftaran->agama}}</a
                        >
                        <a  class="list-group-item"
                          >Kelurahan : {{$data->CalonSiswaPendaftaran->kelurahan}}</a
                        >
                        <a  class="list-group-item"
                          >Kecamatan : {{$data->CalonSiswaPendaftaran->kecamatan}}</a
                        >
                        <a  class="list-group-item"
                          >Kota : {{$data->CalonSiswaPendaftaran->kota}}</a
                        >
                        <a  class="list-group-item"
                          >Kode pos : {{$data->CalonSiswaPendaftaran->kode_pos}}</a
                        >
                        <a  class="list-group-item"
                          >Email : {{$data->CalonSiswaPendaftaran->email}}</a
                        >
                        <a  class="list-group-item"
                          >Anak ke : {{$data->CalonSiswaPendaftaran->anak_ke}}</a
                        >
                        <a  class="list-group-item"
                          >Jumlah Saudara : {{$data->CalonSiswaPendaftaran->jumlah_saudara}}</a
                        >
                        <a  class="list-group-item"
                          >Alamat : {{$data->CalonSiswaPendaftaran->alamat}}</a
                        >
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="demo-inline-spacing mt-3">
                    <div class="list-group">
                      <a  class="list-group-item list-group-item-action active disabled"
                        >Wali siswa</a
                      >
                    </div>
                    <div class="list-group list-group-flush">
                        <a  class="list-group-item"
                          >Nama lengkap : {{$data->CalonWaliPendaftaran->Users->username}}</a
                        >
                        <a  class="list-group-item"
                          >NIK : {{$data->CalonWaliPendaftaran->nik}}</a
                        >
                        <a  class="list-group-item"
                          >No KK : {{$data->CalonSiswaPendaftaran->no_kk}}</a
                        >
                        <a  class="list-group-item"
                          >No Telepon : {{formatNoTelpon($data->CalonWaliPendaftaran->no_telepon)}}</a
                        >
                        <a  class="list-group-item"
                          >Jenis Kelamin : {{$data->CalonWaliPendaftaran->JenisKelamin->jenis_kelamin}}</a
                        >
                        <a  class="list-group-item"
                          >Status Hubungan : {{$data->CalonWaliPendaftaran->hubungan_status}}</a
                        >
                        <a  class="list-group-item"
                          >Pekerjaan : {{$data->CalonWaliPendaftaran->pekerjaan}}</a
                        >
                        <a  class="list-group-item"
                          >Penghasilan : {{formatRupiah($data->CalonWaliPendaftaran->penghasilan)}}</a
                        >
                        <a  class="list-group-item"
                          >Pendidikan terakhir : {{$data->CalonWaliPendaftaran->pendidikan}}</a
                        >
                        <a  class="list-group-item"
                          >Alamat : {{$data->CalonWaliPendaftaran->alamat}}</a
                        >
                    </div>
                    <div class="list-group">
                      <a  class="list-group-item list-group-item-action active disabled"
                        >Data asal sekolah calon siswa</a
                      >
                    </div>
                    <div class="list-group list-group-flush">
                        <a  class="list-group-item"
                          >Asal sekolah : {{$data->CalonSiswaPendaftaran->nama_sekolah_asal}}</a
                        >
                        <a  class="list-group-item"
                          >Kota : {{$data->CalonSiswaPendaftaran->kota_sekolah_asal}}</a
                        >
                        <a  class="list-group-item"
                          >Tahun lulus : {{$data->CalonSiswaPendaftaran->tahun_lulus}}</a
                        >
                        <a  class="list-group-item"
                          >Alamat : {{$data->CalonSiswaPendaftaran->alamat_sekolah_asal}}</a
                        >
                        <a  class="list-group-item"
                          >NISN Sekolah Asal : {{$data->CalonSiswaPendaftaran->no_nisn_sekolah_asal}}</a
                        >
                      </div>
                    </div>
                  </div>
                  <!--/ List group with Badges & Pills -->
                </div>
                <hr class="m-0"/>

                <div class="card-body">
                  @foreach ($data->DokumenCalonSiswa as $item)
                      <div class="row mb-3">
                        <div class="col-12 col-sm-6">
                          <div class="d-flex align-items-start align-items-sm-center gap-4">
                                  <img src="{{ asset('storage/dokument_calon_siswa/' . $item->foto_dokumen) }}" alt="{{$item->foto_dokumen}}" class="d-block rounded" height="100" width="100"/>
                                  <div class="button-wrapper">
                                      <button type="button" class="btn btn-primary account-image-reset mb-4" id="validasi" data-id="{{$item->id}}" data-code="{{$data->kode_pendaftaran}}"  @if($item->status == 'valid') disabled @endif>
                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Validasi</span>
                                      </button>
                                      <p class="text-muted mb-0">Nama dokumen : {{$item->nama_dokumen}}</p>
                                      <p class="text-muted mb-0">Catatan : {{$item->catatan}}</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                  @endforeach
                  @include('AdminView.DokumenPendaftaranSiswa.add_validasi_dokumen')
                </div>
                
                <div class="float-end mb-5 mt-4">
                  <a href="{{route('dokumen-pendaftaran-siswa.index')}}" type="submit" class="btn btn-primary">Kembali</a>
                </div>
              </div>
          </div>

          
          <!-- /Account -->
        </div>
        @else
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title text-primary">Data tidak ditemukan! 😞</h5>
                  <p class="mb-4">
                    Data yang Anda cari dengan kata kunci <strong>{{ $kode }}</strong> tidak ditemukan dalam sistem.
                  </p>
                  <a href="{{route('dokumen-pendaftaran-siswa.index')}}" class="btn btn-sm btn-outline-primary">Kembali</a>
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
  <!-- / Content -->

  {{-- Footer --}}
  @include('Template.footer')

  <div class="content-backdrop fade"></div>
</div>
@endsection
