@extends('Template.Admin.master_admin')
@section('content')
@include('AdminView.DokumenPendaftaranSiswa.search')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-md-12">

        {{-- Jika jumlah data banner lebih dari 0 --}}

        @if (count($data) > 0)
        {{-- @dd($data); --}}
          {{-- Tabel --}}
          <div class="card">
            <h5 class="card-header">Dokumen calon siswa</h5>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 70px;">No.</th>
                      <th>Nama Wali Siswa</th>
                      <th>Nama siswa</th>
                      <th>ID Pendaftar</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $nomor = 1 + (($data->currentPage() - 1) * $data->perPage());
                    @endphp
                    @foreach($data as $item )
                    <tr>
                        <td>{{$nomor++}}</td>
                        <td>{{ $item->CalonWaliPendaftaran->Users->username }}</td>
                        <td>{{ $item->CalonSiswaPendaftaran->nama_lengkap}}</td>
                        <td>{{ $item->kode_pendaftaran }}</td>
                        <td>{{ $item->catatan }}</td>
                        <td>
                            <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <button class="dropdown-item" type="button" id="catatan">
                            <i class="bx bx-edit-alt me-1"></i>
                            Catatan
                            </button>
                            <button class="dropdown-item" type="button" id="Valid-data">
                                <i class="bx bx bxs-badge-check
                                me-1"></i>
                            Valid
                            </button>
                            <button class="dropdown-item" type="button" id="Invalid-data">
                            <i class="bx bx bxs-x-square me-1"></i>
                            Invalid
                            </button>
                            <button class="dropdown-item" type="button" id="detail" data-kode="{{$item->kode_pendaftaran}}">
                            <i class="bx bx bx-search-alt"></i>
                            Detail
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
                  {{-- {!! $data->appends(Request::except('page'))->render() !!} --}}
                </div>
              </div>
            </div>
          </div>

           {{-- Modal edit data --}}
           @include('AdminView.DokumenPendaftaranSiswa.edit_catatan')

           {{-- Modal edit data
           @include('AdminView.DokumenPendaftaranSiswa.detail_dokumen') --}}

          {{-- Loading data--}}
          <div id="loading-overlay" style="display: none;">
            @include('Template.loading')
          </div>


        {{-- Jika data banner kosong --}}
        @else
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Belum ada transaksi apapun! 😞</h5>
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


<script>
    $('body').on('click', `#detail`, function () {
      var kode_pendaftar = $(this).data('kode'); // menangkap ID dari data attribute 'data-id'
      // tampilkan spinner
      //console.log(kode_pendaftar)
      $('#loading-overlay').show();
      setTimeout(() => {
        $('#loading-overlay').hide();
        const url = `dokumen-pendaftaran-siswa/${kode_pendaftar}`
        window.location.href = url;
      }, 900);

    });
  </script>-
@endsection
