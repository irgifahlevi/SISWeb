@extends('Template.Siswa.master_siswa')
@section('content')
@include('SiswaView.MyTagihanSiswa.search')
<div id="loading-overlay" style="display: none;">
  @include('Template.loading')
</div>
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-md-12">

        {{-- Jika jumlah data banner lebih dari 0 --}}
        @if (count($data) > 0)
          {{-- Tabel --}}
          <div class="card mb-3">
            <h5 class="card-header">Daftar tagihan saya</h5>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 70px;">No.</th>
                      <th>No tagihan</th>
                      <th>Kode tagihan</th>
                      <th>Nama tagihan</th>
                      <th>Nama siswa</th>
                      <th>Kelas</th>
                      <th>Tgl Jatuh Tempo</th>
                      <th>Nominal tagihan</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $nomor = 1 + (($data->currentPage() - 1) * $data->perPage());
                    @endphp
                    @foreach($data as $item)
                    <tr>
                      <td>{{$nomor++}}</td>
                      <td>{{ $item->no_tagihan }}</td>
                      <td>{{ $item->kode_tagihan }}</td>
                      <td>{{ $item->nama_tagihan  }}</td>
                      <td>{{ $item->TagihanSiswas->nama_lengkap  }}</td>
                      <td>{{ $item->TagihanKelas->kelas  }}</td>
                      <td>{{ $item->jatuh_tempo  }}</td>
                      <td>{{ formatRupiah($item->nominal_tagihan)  }}</td>
                      <td>
                        @if ($item->status == 'dibayar')
                          <span class="badge bg-success">Dibayar</span>
                        @elseif($item->status == 'belum_dibayar')
                          <span class="badge bg-warning">Belum dibayar</span>
                        @endif
                      </td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            @if ($item->status =='dibayar')
                              <button class="dropdown-item" type="button" id="invoice" data-id="{{$item->kode_tagihan}}">
                                <i class='bx bx-show-alt me-1'></i>
                                Lihat invoice
                              </button>
                            @else
                              <button class="dropdown-item" type="button" id="bayar-tagihan" data-id="{{$item->token_tagihan}}">
                                <i class='bx bx-barcode me-1'></i>
                                Bayar
                              </button>
                              @include('SiswaView.MyTagihanSiswa.payment_midtrans')
                            @endif
                          </div>
                        </div>
                      </td>			
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="mt-3">
                  <!-- {{-- {{ $dataBarang->links() }} --}} -->
                  {!! $data->appends(Request::except('page'))->render() !!}
                </div>
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
                      Data yang Anda cari dengan kata kunci <strong>{{ $search_tagihan }}</strong> tidak ditemukan dalam sistem.
                    </p>
                    <a href="{{route('tagihan-saya.index')}}" class="btn btn-sm btn-outline-primary">Tagihan saya</a>
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
  $('body').on('click', `#invoice`, function () {
    var id = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
    // tampilkan spinner
    $('#loading-overlay').show();
    setTimeout(() => {
      $('#loading-overlay').hide();
      const url = `tagihan-saya/${id}`
      window.location.href = url;
    }, 900);

  });
</script>
@endsection