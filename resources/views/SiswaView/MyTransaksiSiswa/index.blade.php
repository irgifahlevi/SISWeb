@extends('Template.Siswa.master_siswa')
@section('content')
@include('SiswaView.MyTransaksiSiswa.search')
<div id="loading-overlay" style="display: none;">
  @include('Template.loading')
</div>
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-md-12">

        {{-- Jika jumlah data banner lebih dari 0 --}}
        @if (count($data) > 0)

        <div class="mb-3">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" id="export-data" >
            Export data
          </button>

          <!-- Modal tambah data -->
          @include('SiswaView.MyTransaksiSiswa.export_data')
        </div>
          {{-- Tabel --}}
          <div class="card">
            <h5 class="card-header">Data transaksi</h5>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 70px;">No.</th>
                      <th>No transaksi</th>
                      <th>Kode tagihan</th>
                      <th>Nama</th>
                      <th>Kelas</th>
                      <th>Nominal tagihan</th>
                      <th>Nama tagihan</th>
                      <th>Semester</th>
                      <th>Waktu transaksi</th>
                      <th>Waktu pembayaran</th>
                      <th>Status</th>
                      <th>Channel pembayaran</th>
                      <th>Jenis pembayaran</th>
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
                      <td>{{ $item->no_transaksi }}</td>
                      <td>{{ $item->TransaksiTagihan->kode_tagihan }}</td>
                      <td>{{ $item->TransaksiTagihanSiswa->nama_lengkap }}</td>
                      <td>{{ $item->TransaksiTagihan->TagihanKelas->kelas }}</td>
                      <td>{{ formatRupiah($item->total_pembayaran)}}</td>
                      <td>{{ $item->TransaksiTagihan->nama_tagihan}}</td>
                      <td>{{ formatSemester($item->TransaksiTagihan->semester)}}</td>
                      <td>{{ $item->waktu_transaksi }}</td>
                      <td>{{ $item->waktu_pembayaran }}</td>
                      <td>
                        @if ($item->is_bayar == 1)
                          <span class="badge bg-success">Lunas</span>
                        @endif
                      </td>
                      <td>{{ $item->channel_pembayaran }}</td>
                      <td>{{ $item->TransaksiTagihan->jenis_pembayaran }}</td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            @if ($item->TransaksiTagihan->status =='dibayar')
                              <button class="dropdown-item" type="button" id="invoice" data-id="{{$item->TransaksiTagihan->kode_tagihan}}">
                                <i class='bx bx-show-alt me-1'></i>
                                Lihat invoice
                              </button>
                            @else
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
                    @if (count($data) > 0)
                      <h5 class="card-title text-primary">Data tidak ditemukan! 😞</h5>
                      <p class="mb-4">
                        Data yang Anda cari dengan kata kunci <strong>{{ $kode }}</strong> tidak ditemukan dalam sistem kami.
                      </p>
                      <a href="{{route('tagihan.transaksi')}}" class="btn btn-sm btn-outline-primary">Kembali</a>
                    @else
                      <h5 class="card-title text-primary">Kamu belum memilki transaksi apapun! 😞</h5>
                      <p class="mb-4">
                        Segera lakukan pembayaran tagihan apabila kamu memilki tagihan
                      </p>
                      <a href="{{route('tagihan-saya.index')}}" class="btn btn-sm btn-outline-primary">Tagihan saya</a>
                    @endif
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