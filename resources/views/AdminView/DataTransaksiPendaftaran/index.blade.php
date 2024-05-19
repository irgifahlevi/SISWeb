@extends('Template.Admin.master_admin')
@section('content')
@include('AdminView.DataTransaksiPendaftaran.search')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-md-12">

        {{-- Jika jumlah data banner lebih dari 0 --}}

        @if (count($data) > 0)

          {{-- Tabel --}}
          <div class="card">
            <h5 class="card-header">Data transaksi</h5>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 70px;">No.</th>
                      <th>Wali calon</th>
                      <th>Tel Wali</th>
                      <th>Calon siswa</th>
                      <th>Kode pendaftaran</th>
                      <th>No pendaftaran</th>
                      <th>Gel pendaftaran</th>
                      <th>Tgl pendaftaran</th>
                      <th>Jenis pendaftaran</th>
                      <th>Total pembayaran</th>
                      <th>Channel pembayaran</th>                
                      <th>Status pembayaran</th>
                      <th>Tgl pembayaran</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $nomor = 1 + (($data->currentPage() - 1) * $data->perPage());
                    @endphp
                    @foreach($data as $item)
                    <tr>
                      <td>{{$nomor++}}</td>
                      <td>{{ $item->CalonWaliPendaftaran->Users->username }}</td>
                      <td>{{ formatNoTelpon($item->CalonWaliPendaftaran->no_telepon) }}</td>
                      <td>{{ $item->CalonSiswaPendaftaran->nama_lengkap }}</td>
                      <td>{{ $item->kode_pendaftaran }}</td>
                      <td>{{ $item->no_pendaftaran }}</td>
                      <td>{{ formatGelombang($item->InfoBiayaPendaftaran->gelombang) }}</td>
                      <td>{{ $item->tanggal_pendaftaran }}</td>
                      <td>{{ $item->jenis_pembayaran }}</td>
                      <td>{{ formatRupiah($item->total_bayar)}}</td>
                      <td>{{ $item->channel_pembayaran }}</td>
                      <td>
                        @if ($item->is_bayar == 1)
                          <span class="badge bg-success">Lunas</span>
                        @elseif($item->is_bayar == -1)
                          <span class="badge bg-warning">Belum lunas</span>
                        @endif
                      </td>
                      <td>{{ $item->updated_at }}</td>
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
@endsection