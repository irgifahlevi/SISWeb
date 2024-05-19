@extends('Template.WaliCalon.master_wali')
@section('content')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
              <div class="invoice-title">
                  <h4 class="float-end font-size-15">
                    No pendaftaran : {{$data->no_pendaftaran}}
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
                          <h5 class="font-size-16 mb-3">Nama pendaftar :</h5>
                          <h5 class="font-size-15 mb-2">{{$data->CalonSiswaPendaftaran->nama_lengkap}}</h5>
                          <p class="mb-1">{{$data->CalonSiswaPendaftaran->nik}}</p>
                          <p class="mb-1">{{$data->CalonSiswaPendaftaran->alamat}}</p>
                          <p>{{formatNoTelpon($data->CalonSiswaPendaftaran->no_telepon)}}</p>
                      </div>
                  </div>
                  {{-- @dd($data->InfoBiayaPendaftaran->BiayaPendaftaran); --}}
                  <!-- end col -->
                  <div class="col-sm-6">
                      <div class="text-muted text-sm-end">
                          <div>
                              <h5 class="font-size-15 mb-1">Order No:</h5>
                              <p>#{{$data->kode_pendaftaran}}</p>
                          </div>
                          <div class="mt-4">
                              <h5 class="font-size-15 mb-1">Waktu dibuat:</h5>
                              <p>{{$data->tanggal_pendaftaran}}</p>
                          </div>
                          <div class="mt-4">
                              <h5 class="font-size-15 mb-1">Waktu pembayaran:</h5>
                              <p>{{$data->updated_at}}</p>
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
                                  <th>Kode</th>
                                  <th>Nama</th>
                                  <th>Gelombang pendaftaran</th>
                                  <th class="text-end" style="width: 200px;">Nominal</th>
                              </tr>
                          </thead><!-- end thead -->
                          <tbody>
                            @php
                                $nomor = 1;
                                $totalBiaya = 0;
                            @endphp
                                @foreach($data->InfoBiayaPendaftaran->BiayaPendaftaran as $biaya)
                                  <tr>
                                    <th scope="row">{{ $nomor++ }}</th>
                                    <td>{{$biaya->kode_biaya}}</td>
                                    <td>{{$biaya->nama_biaya}}</td>
                                    <td>
                                      @if ($biaya->InfoPendaftarans)
                                        {{ formatGelombang($biaya->InfoPendaftarans->gelombang) }}
                                      @endif
                                  </td>
                                    <td class="text-end">{{formatRupiah($biaya->nominal_biaya)}}</td>
                                </tr>
                                @php
                                    $totalBiaya += $biaya->nominal_biaya;
                                @endphp
                                @endforeach
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
                  <em class="text-sm">Catatan: Invoice ini merupakan bukti pembayaran yang sah. Mohon tunjukkan invoice ini kepada staf sekolah saat Anda menyerahkan dokumen persyaratan pendaftaran siswa baru.</em>
                  <div class="d-print-none mt-4">
                      <div class="float-end">
                          <a href="{{route('wali.index')}}" class="btn btn-primary w-md">Kembali</a>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    {{-- Footer --}}
    @include('Template.footer')

    <div class="content-backdrop fade"></div>
</div>

@endsection