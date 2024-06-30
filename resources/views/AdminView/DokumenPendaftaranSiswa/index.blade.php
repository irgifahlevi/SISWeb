@extends('Template.Admin.master_admin')
@section('content')
@include('AdminView.DokumenPendaftaranSiswa.search')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-md-12">

        {{-- Jika jumlah data banner lebih dari 0 --}}

        {{-- @if (count($data) > 0) --}}

          {{-- Tabel --}}
          <div class="card">
            <h5 class="card-header">Dokumen calon siswa</h5>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 70px;">No.</th>
                      <th>Nama siswa</th>
                      <th>ID Pendaftar</th>
                      <th>Foto Dokumen</th>
                      <th>Nama Dokumen</th>
                      <th>Status</th>
                      <th>Catatan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- @php
                        $nomor = 1 + (($data->currentPage() - 1) * $data->perPage());
                    @endphp --}}
                    {{-- @foreach() --}}
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
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
                      </div>
                    </div>
                  </td>
                    </tr>
                    {{-- @endforeach --}}
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

          {{-- Loading data--}}
          {{-- <div id="loading-overlay" style="display: none;">
            @include('Template.loading')
          </div> --}}


        {{-- Jika data banner kosong --}}
        {{-- @else --}}
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
        {{-- @endif --}}
      </div>
    </div>
  </div>
  {{-- Footer --}}
  @include('Template.footer')

  <div class="content-backdrop fade"></div>
</div>

</script>
@endsection
