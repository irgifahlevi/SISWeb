@extends('Template.Admin.master_admin')
@section('content')
@include('AdminView.InfoPendaftaran.search')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-md-12">

        {{-- Jika jumlah data banner lebih dari 0 --}}
        @if (count($info_pendaftaran) > 0)

        <div class="mb-3">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" id="add-info" >
            Tambah data
          </button>

          <!-- Modal tambah data -->
          @include('AdminView.InfoPendaftaran.add_info_pendaftaran')
        </div>
          {{-- Tabel --}}
          <div class="card">
            <h5 class="card-header">Data gelombang</h5>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 70px;">No.</th>
                      <th>Kode</th>
                      <th>Deskripsi</th>
                      <th>Gelombang</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $nomor = 1 + (($info_pendaftaran->currentPage() - 1) * $info_pendaftaran->perPage());
                    @endphp
                    @foreach($info_pendaftaran as $item)
                    <tr>
                      <td>{{$nomor++}}</td>
                      <td><span class="d-inline-block text-truncate" style="max-width: 164px;">{{ $item->kode_gelombang }}</span></td>
                      <td><span class="d-inline-block text-truncate" style="max-width: 164px;">{{ $item->deskripsi }}</span></td>
                      <td><span class="d-inline-block text-truncate" style="max-width: 164px;"> {{ formatGelombang($item->gelombang) }}</span></td>
                      <td>
                        @if ($item->status == 'active')
                          <span class="badge bg-success">Aktif</span>
                        @elseif($item->status == 'inactive')
                          <span class="badge bg-primary">Tidak aktif</span>
                        @endif
                      </td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <button class="dropdown-item" type="button" id="edit-info" data-id="{{$item->id}}">
                              <i class="bx bx-edit-alt me-1"></i> 
                              Ubah
                            </button>
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="mt-3">
                  <!-- {{-- {{ $dataBarang->links() }} --}} -->
                  {!! $info_pendaftaran->appends(Request::except('page'))->render() !!}
                </div>
              </div>
            </div>
          </div>

          <div class="card mt-3">
            <h5 class="card-header">Konfigurasi</h5>
            <div class="card-body">
              <div class="mb-3 col-12 mb-0">
                <div class="alert alert-warning">
                  <h6 class="alert-heading fw-bold mb-1">Silahkan lakukan konfigurasi untuk menentukan gelombang pendaftaran siswa baru!</h6>
                  <p class="mb-0">Note : jika tidak melakukan konfigurasi maka sistem akan secara otomatis menampilkan biaya pendaftaran gelombang I (satu) di menu pendaftar</p>
                </div>
              </div>
              <button type="submit" class="btn btn-danger deactivate-account" id="select-gelombang" data-id="{{$key_id->id}}">Pilih gelombang</button>
            </div>
          </div>

          <div id="loading-overlay" style="display: none;">
            @include('Template.loading')
          </div>
          {{-- Modal edit data --}}
          @include('AdminView.InfoPendaftaran.edit_info_pendaftaran')
          @include('AdminView.InfoPendaftaran.update_config_pendaftaran')
          
        
        {{-- Jika data banner kosong --}}
        @else
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Belum ada data info pendaftaran! 😞</h5>
                  <button class="btn btn-sm btn-outline-primary" type="button" id="add-info">Tambah data sekarang</button>
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
          @include('AdminView.InfoPendaftaran.add_info_pendaftaran')
        @endif
      </div>
    </div>
  </div>
  {{-- Footer --}}
  @include('Template.footer')

  <div class="content-backdrop fade"></div>
</div> 
@endsection