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
                      <th>Semester</th>
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
                      <td>{{ formatSemester($item->semester)  }}</td>
                      <td>{{ formatRupiah($item->nominal_tagihan)  }}</td>
                      <td>
                        @if ($item->status == 'dibayar')
                          <span class="badge bg-success">Dibayar</span>
                        @elseif($item->status == 'belum_dibayar')
                          <span class="badge bg-warning">Belum dibayar</span>
                        @elseif($item->status == 'waiting')
                          <span class="badge bg-warning">Waiting</span>
                        @elseif($item->status == 'dibatalkan')
                          <span class="badge bg-danger">Dibatalkan</span>
                        @elseif($item->status == 'Failed')
                          <span class="badge bg-danger">Failed</span>
                        @elseif($item->status == 'Expired')
                          <span class="badge bg-danger">Expired</span>
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
                              @if ($item->status != 'waiting')
                                @if ($item->status == 'belum_dibayar')
                                    <button class="dropdown-item" type="button" id="bayar-tagihan" data-id="{{$item->token_tagihan}}">
                                      <i class='bx bx-barcode me-1'></i>
                                      Bayar
                                    </button>
                                    <button class="dropdown-item" type="button" id="request" data-id="{{$item->id}}">
                                      {{-- <i class='bx bx-show-alt me-1'></i> --}}
                                      <i class='bx bx-reset me-1'></i>
                                      Request token
                                    </button>
                                  @include('SiswaView.MyTagihanSiswa.payment_midtrans')
                                @else
                                  <button class="dropdown-item" type="button" id="request" data-id="{{$item->id}}">
                                    {{-- <i class='bx bx-show-alt me-1'></i> --}}
                                    <i class='bx bx-reset me-1'></i>
                                    Request token
                                  </button>
                                @endif
                              @else
                                <button class="dropdown-item" type="button">
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
                      <a href="{{route('tagihan-saya.index')}}" class="btn btn-sm btn-outline-primary">Kembali</a>
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
  $('body').on('click', '#request', function(){
    var id = $(this).data('id');
    var type = 'tagihan_siswa';

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
            url: '{{ route('request-token-tagihan', [':id', ':type']) }}'.replace(':id', id).replace(':type', type),
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