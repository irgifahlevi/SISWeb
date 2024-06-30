@extends('Template.Siswa.master_siswa')
@section('content')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-md-12">
        @if ($data)

          <div class="card">
            <div class="card-body">
                <div class="invoice-title">
                    <h4 class="float-end font-size-15">
                      No tagihan : {{$data->TransaksiTagihan->no_tagihan}}
                      @if ($data->is_bayar == 1) 
                        <span class="badge bg-success font-size-12 ms-2">Lunas</span>
                      @endif
                    </h4>
                    <div class="mb-4">
                      <h2 class="mb-1 text-muted">MTs. Al-Quraniyah</h2>
                    </div>
                    <div class="text-muted">
                        <p class="mb-1">Jl. H. Ridi Jl. Swadarma Raya No.49, RT 015 RW 003</p>
                        <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i>	NPSN : 20178270</p>
                        <p><i class="uil uil-phone me-1"></i> 012-345-6789</p>
                    </div>
                    
                </div>

                <hr class="my-4">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="text-muted">
                            <h5 class="font-size-16 mb-3">Nama : {{$data->TransaksiTagihanSiswa->nama_lengkap}}</h5>
                            <p class="mb-1">NIS : {{$data->TransaksiTagihanSiswa->nis_lokal}}</p>
                            <p class="mb-1">Kelas : {{$data->TransaksiTagihanSiswa->KelasSiswa->kelas}}</p>
                            <p class="mb-1">Alamat : {{$data->TransaksiTagihanSiswa->alamat}}</p>
                        </div>
                    </div>
                    {{-- @dd($data->InfoBiayaPendaftaran->BiayaPendaftaran); --}}
                    <!-- end col -->
                    <div class="col-sm-6">
                        <div class="text-muted text-sm-end">
                            <div>
                                <h5 class="font-size-15 mb-1">Kode Tagihan : </h5>
                                <p>#{{$data->TransaksiTagihan->kode_tagihan}}</p>
                            </div>
                            <div class="mt-4">
                                <h5 class="font-size-15 mb-1">Waktu transaksi : </h5>
                                <p>{{$data->waktu_transaksi}}</p>
                            </div>
                            <div class="mt-4">
                                <h5 class="font-size-15 mb-1">Waktu pembayaran : </h5>
                                <p>{{$data->waktu_pembayaran}}</p>
                            </div>

                            <div class="mt-4">
                                <h5 class="font-size-15 mb-1">Channel pembayaran : </h5>
                                <p>{{$data->channel_pembayaran}}</p>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
                
                <div class="py-2">
                  <h5 class="font-size-15">Detail pembayaran</h5>

                  <div class="table-responsive">
                      <table class="table align-middle table-nowrap table-centered mb-0">
                          <thead>
                              <tr>
                                  <th style="width: 70px;">No.</th>
                                  <th>No tagihan</th>
                                  <th>Nama tagihan</th>
                                  <th>Kategori</th>
                                  <th class="text-end" style="width: 200px;">Nominal</th>
                              </tr>
                          </thead><!-- end thead -->
                          <tbody>
                            @php
                                $nomor = 1;
                                $totalBiaya = 0;
                            @endphp
                                
                                  <tr>
                                    <th scope="row">{{ $nomor++ }}</th>
                                    <td>{{$data->TransaksiTagihan->no_tagihan}}</td>
                                    <td>{{$data->TransaksiTagihan->nama_tagihan}}</td>
                                    <td>{{setFormatKategoriTagihan($data->TransaksiTagihan->kategori_tagihan)}}</td>
                                    <td class="text-end">{{formatRupiah($data->total_pembayaran)}}</td>
                                </tr>
                                @php
                                    $totalBiaya += $data->total_pembayaran;
                                @endphp
                               
                              <tr>
                                  <th scope="row" colspan="4" class="text-end">Sub Total</th>
                                  <td class="text-end fw-semibold">{{ formatRupiah($totalBiaya) }}</td>
                              </tr>
                              <tr>
                                  <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                  <td class="border-0 text-end"><h4 class="fw-semibold">{{ formatRupiah($totalBiaya) }}</h4></td>
                              </tr>
                              <!-- end tr -->
                          </tbody><!-- end tbody -->
                      </table><!-- end table -->
                  </div><!-- end table responsive -->
                  <hr class="my-4">
                  <em class="text-sm">Catatan: Invoice ini merupakan bukti pembayaran tagihan yang sah.</em>
                  <div class="d-print-none mt-4">
                      <div class="float-end">
                          <a href="{{route('tagihan.transaksi')}}" class="btn btn-primary w-md">Kembali</a>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        @else
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title text-primary">Invoice tidak di temukan! 😞</h5>
                  <p class="mb-4">
                    Data yang Anda cari dengan kata kunci <strong>{{ $kode }}</strong> tidak ditemukan dalam sistem.
                  </p>
                  <a href="{{route('tagihan.transaksi')}}" class="btn btn-sm btn-outline-primary">Kembali</a>
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