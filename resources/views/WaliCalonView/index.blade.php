@extends('Template.WaliCalon.master_wali')
@section('content')
@include('Template.navbar')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div>
      <div id="loading-overlay" style="display: none;">
        @include('Template.loading')
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 mb-4">
          @if ($data)
            <div class="card mb-4">
              <h5 class="card-header">Daftar biaya pendaftaran</h5>
              <div class="card-body">
                <div class="mb-3 table-responsive text-nowrap">
                  <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No urut.</th>
                            <th>Kode pembayaran</th>
                            <th>Pembayaran</th>
                            <th>Biaya</th>
                            <th>Gelombang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nomor = 1;
                            $totalBiaya = 0;
                        @endphp
                        @foreach($list_biaya as $item)
                        <tr>
                            <td>{{ $nomor++ }}</td>
                            <td>{{ $item->kode_biaya }}</td>
                            <td>{{ $item->nama_biaya }}</td>
                            <td>{{ formatRupiah($item->nominal_biaya) }}</td>
                            <td>
                                @if ($item->InfoPendaftarans)
                                    {{ formatGelombang($item->InfoPendaftarans->gelombang) }}
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        @php
                            $totalBiaya += $item->nominal_biaya;
                        @endphp
                        @endforeach
                        <tr>
                            <td colspan="3"></td>
                            <td><strong>Total : </strong></td>
                            <td>{{ formatRupiah($totalBiaya) }}</td>
                        </tr>
                    </tbody>
                </table>
                
                </div>
                @if(count($list_biaya) > 0)
                <button type="submit" class="btn btn-success deactivate-account" id="form-data-siswa" data-id="{{$info_pendaftaran_id}}">Daftar sekarang</button>
                @endif
              </div>
            </div>
            @include('WaliCalonView.PendaftaranSiswa.add_data_siswa')
          @else
            
          <div class="card">
            <h5 class="card-header">Selamat datang di sistem informasi Pendaftaran Peserta Didik Baru (PPDB) MTs. Al-Quraniyah</h5>
            <div class="card-body">
              <div class="mb-3 col-12 mb-0">
                <div class="alert alert-warning">
                  <h6 class="alert-heading fw-bold mb-1">Akunmu belum lengkap!</h6>
                  <p class="mb-0">Sebelum melakukan pendaftaran, kami perlu meminta Anda untuk melengkapi profil Anda.</p>
                </div>
              </div>
              <button type="submit" class="btn btn-danger deactivate-account" id="add-profile">Lengkapi profil</button>
            </div>
          </div>
          @endif        
        </div>
      </div>
    </div>
  </div>
  {{-- Footer --}}
  @include('Template.footer')
  
  @include('WaliCalonView.ProfileWaliCalon.add_profile_wali_calon')
  <div class="content-backdrop fade"></div>
</div>
@endsection