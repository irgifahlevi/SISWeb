@extends('Template.Admin.master_admin')
@section('content')
@include('AdminView.RequestToken.search')
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
            <h5 class="card-header">Daftar request token pembayaran</h5>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 70px;">No.</th>
                      <th>Kode pembayaran</th>
                      <th>Type</th>
                      <th>Status</th>
                      <th>Requester</th>
                      <th>Nominal pembayaran</th>
                      <th>Deskripsi</th>
                      <th>Tanggal dibuat</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $nomor = 1 + (($data->currentPage() - 1) * $data->perPage());
                    @endphp
                    @foreach($data as $item)
                      @php
                          $isPendaftaran = $item->type == 'pendaftaran_siswa';
                          $isTagihan = $item->type == 'tagihan_siswa';
                          $tokenType = $isPendaftaran ? 'Pendaftaran' : ($isTagihan ? 'Tagihan' : '');
                          $kodePembayaran = $isPendaftaran ? $item->RequestTokenPendaftaran->kode_pendaftaran : ($isTagihan ? $item->RequestTokenTagihan->kode_tagihan : '');
                          $status = $isPendaftaran ? $item->RequestTokenPendaftaran->status : ($isTagihan ? $item->RequestTokenTagihan->status : '');
                          $nominalPembayaran = $isPendaftaran ? formatRupiah($item->RequestTokenPendaftaran->total_bayar) : ($isTagihan ? formatRupiah($item->RequestTokenTagihan->nominal_tagihan) : '');
                          $createdAt = $isPendaftaran ? $item->RequestTokenPendaftaran->created_at : ($isTagihan ? $item->RequestTokenTagihan->created_at : '');
                          $waitingGenerate = $status == 'Waiting' || $status == 'waiting';
                      @endphp
                      <tr>
                          <td>{{$nomor++}}</td>
                          <td>{{ $kodePembayaran }}</td>
                          <td>{{ $tokenType }}</td>
                          <td>
                              @if ($waitingGenerate)
                                  <span class="badge bg-warning">Waiting generate</span>
                              @endif
                          </td>
                          <td>{{$item->created_by}}</td>
                          <td>{{ $nominalPembayaran }}</td>
                          <td>{{$item->deskripsi}}</td>
                          <td>{{ $createdAt }}</td>
                          <td>
                              @if ($waitingGenerate)
                                  <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                          <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                      <div class="dropdown-menu">
                                        <button class="dropdown-item" type="button" id="buat-ulang-token" data-id="{{ $kodePembayaran }}" data-type="{{ $item->id }}">
                                            <i class="bx bx-edit-alt me-1"></i> Buat ulang
                                        </button>
                                      </div>
                                  </div>
                              @endif
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
                  <h5 class="card-title text-primary">Belum ada request token pembayaran! 😞</h5>
                  <button class="btn btn-sm btn-outline-primary" type="button" >Mengerti</button>
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
    $('body').on('click', '#buat-ulang-token', function(){
      const id = $(this).data('id');
      const type = $(this).data('type');
    $('#loading-overlay').show();

    setTimeout(() => {
      Swal.fire({
        customClass:{
          container: 'my-swal',
        },
        title: 'Apa anda yakin!',
        text: "Ingin buat ulang tagihan ?",
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
            url: '{{ route('update.token.pembayaran', [':id', ':type']) }}'.replace(':id', id).replace(':type', type),
            type: 'PUT',
            success: function(response) {
              if(response.status == 200){

                $('#loading-overlay').hide();
                Swal.fire({
                  customClass: {
                    container: 'my-swal',
                  },
                  title: 'Updated!',
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

      //$('#loading-overlay').hide();
    }, 800);
  })
</script>
@endsection