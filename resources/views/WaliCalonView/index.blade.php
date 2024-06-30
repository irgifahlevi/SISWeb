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
                            <th style="width: 70px;">No urut.</th>
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
                            <td><span class="d-inline-block text-truncate" style="max-width: 164px;">{{ $item->kode_biaya }}</span></td>
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
                  @include('WaliCalonView.PendaftaranSiswa.add_data_siswa')
                @endif
              </div>
            </div>
            @if (count($list_pendaftaran) > 0)
              <div class="card">
                <h5 class="card-header">Data pendaftar</h5>
                <div class="card-body">
                  <div class="mb-3 table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th>No pendaftar</th>
                              <th>Kode pendaftar</th>
                              <th>Siswa</th>
                              <th>Wali</th>
                              <th>Gelombang</th>
                              <th>Pembayaran</th>
                              <th>Total bayar</th>
                              <th>Tanggal</th>
                              <th>Status</th>
                              <th>Bayar</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          @php
                              $nomor = 1;
                          @endphp
                          @foreach($list_pendaftaran as $item)
                          <tr>
                              <td>{{ $item->no_pendaftaran }}</td>
                              <td><span class="d-inline-block text-truncate" style="max-width: 164px;">{{ $item->kode_pendaftaran }}</span></td>
                              <td>{{ $item->CalonSiswaPendaftaran->nama_lengkap }}</td>
                              <td>{{ $item->CalonWaliPendaftaran->Users->username }}</td>
                              <td>
                                @if ($item->InfoBiayaPendaftaran)
                                    {{ formatGelombang($item->InfoBiayaPendaftaran->gelombang) }}
                                @else
                                    N/A
                                @endif
                              </td>
                              <td>{{ $item->InfoBiayaPendaftaran->deskripsi }}</td>
                              <td>{{ formatRupiah($item->total_bayar) }}</td>                            
                              <td>{{ $item->tanggal_pendaftaran }}</td>
                              <td>
                                @if ($item->status == 'Success')
                                  <span class="badge bg-success">Success</span>
                                @elseif($item->status == 'Pending')
                                  <span class="badge bg-primary">Pending</span>
                                @elseif($item->status == 'Failed')
                                  <span class="badge bg-danger">Failed</span>
                                @elseif($item->status == 'Expired')
                                  <span class="badge bg-danger">Expired</span>
                                @elseif($item->status == 'Waiting')
                                  <span class="badge bg-primary">Waiting</span>
                                @endif
                              </td>
                              <td> 
                                @if ($item->is_bayar == 1)
                                  <span>Sudah Lunas</span>
                                @else
                                  <span>Belum lunas</span>
                                @endif
                              </td>
                              <td>
                                <div class="dropdown">
                                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                  <div class="dropdown-menu">
                                    @if ($item->status =='Success' && $item->is_bayar == 1)
                                      <button class="dropdown-item" type="button" id="invoice" data-id="{{$item->kode_pendaftaran}}">
                                        <i class='bx bx-show-alt me-1'></i>
                                        Lihat invoice
                                      </button>
                                    @else
                                      @if ($item->status != 'Waiting')
                                        @if ($item->status == 'Pending')
                                          <button class="dropdown-item" type="button" id="bayar-pendaftaran" data-id="{{$item->token_pembayaran}}">
                                            <i class='bx bx-barcode me-1'></i>
                                            Bayar
                                          </button>
                                          @include('WaliCalonView.PendaftaranSiswa.payment_midtrans')
                                        @else
                                          <button class="dropdown-item" type="button" id="request" data-id="{{$item->id}}">
                                            {{-- <i class='bx bx-show-alt me-1'></i> --}}
                                            <i class='bx bx-reset me-1'></i>
                                            Request token
                                          </button>
                                        @endif
                                      @else
                                        <button class="dropdown-item" type="button">
                                          {{-- <i class='bx bx-show-alt me-1'></i> --}}
                                          <i class='bx bxs-hourglass-top me-1'></i>
                                          Waiting generate token
                                        </button>
                                      @endif
                                    @endif
                                  </div>
                                </div>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
                  
                  </div>
                </div>
              </div>
            @endif
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

<script>
  $('body').on('click', `#invoice`, function () {
    var id = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
    // tampilkan spinner
    $('#loading-overlay').show();
    setTimeout(() => {
      $('#loading-overlay').hide();
      const url = `pendaftaran-siswa/${id}`
      window.location.href = url;
    }, 900);

  });

  $('body').on('click', '#request', function(){
    var id = $(this).data('id');
    var type = 'pendaftaran_siswa';

    // loading 
    $('#loading-overlay').show();

    setTimeout(() => {
      Swal.fire({
        customClass:{
          container: 'my-swal',
        },
        title: 'Apa anda yakin!',
        text: "Ingin regenerate token pembayaran ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#696cff',
        cancelButtonColor: '#ff3e1d',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed){
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route('request-token-pendaftaran', [':id', ':type']) }}'.replace(':id', id).replace(':type', type),
            type: 'POST',
            success: function(response) {
              if(response.status == 200){

                $('#loading-overlay').hide();
                Swal.fire({
                  customClass: {
                    container: 'my-swal',
                  },
                  title: 'Requested!',
                  text: `${response.message}`,
                  icon: 'success'
                });

                // Reload halaman
                setTimeout(function(){
                  location.reload();
                }, 800);
              }
            },
            error: function(response){
              if(response.status == 500){
                $('#loading-overlay').hide();
                var res = response;
                Swal.fire({
                  customClass: {
                    container: 'my-swal',
                  },
                  title: `${res.statusText}`,
                  text: `${res.responseJSON.message}`,
                  icon: 'error'
                });
              }
            },
          });
        }
        else {
          $('#loading-overlay').hide();
        }
      });
    }, 800);
  })
</script>
@endsection