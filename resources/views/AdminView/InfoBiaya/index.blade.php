@extends('Template.Admin.master_admin')
@section('content')
@include('AdminView.InfoBiaya.search')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-md-12">

        {{-- Jika jumlah data banner lebih dari 0 --}}
        @if (count($biaya_pendaftaran) > 0)

        <div class="mb-3">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" id="add-biaya" >
            Tambah data
          </button>

          <!-- Modal tambah data -->
          @include('AdminView.InfoBiaya.add_biaya_pendaftaran')
        </div>
          {{-- Tabel --}}
          <div class="card">
            <h5 class="card-header">Daftar biaya pendaftaran</h5>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Kode</th>
                      <th>Nama biaya</th>
                      <th>Nominal</th>
                      <th>Gelombang</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $nomor = 1 + (($biaya_pendaftaran->currentPage() - 1) * $biaya_pendaftaran->perPage());
                    @endphp
                    @foreach($biaya_pendaftaran as $item)
                    <tr>
                      <td>{{$nomor++}}</td>
                      <td>{{ $item->kode_biaya }}</td>
                      <td>{{ $item->nama_biaya }}</td>
                      <td>{{ formatRupiah($item->nominal_biaya) }}</td>
                      <td>{{ formatGelombang($item->InfoPendaftarans->gelombang) }}</td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <button class="dropdown-item" type="button" id="edit-info" data-id="{{$item->id}}">
                              <i class="bx bx-edit-alt me-1"></i> 
                              Ubah
                            </button>
                            <button class="dropdown-item" type="button" id="hapus-data" data-id="{{$item->id}}">
                              <i class='bx bx-trash me-1'></i>
                              Hapus
                            </button>
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="mt-3">
                  <!-- {{-- {{ $dataBarang->links() }} --}} -->
                  {!! $biaya_pendaftaran->appends(Request::except('page'))->render() !!}
                </div>
              </div>
            </div>
          </div>

          <div id="loading-overlay" style="display: none;">
            @include('Template.loading')
          </div>
          {{-- Modal edit data --}}
          @include('AdminView.InfoBiaya.edit_biaya_pendaftaran')
          
        
        {{-- Jika data banner kosong --}}
        @else
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Belum ada data biaya pendaftaran! 😞</h5>
                  <button class="btn btn-sm btn-outline-primary" type="button" id="add-biaya">Tambah data sekarang</button>
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
          @include('AdminView.InfoBiaya.add_biaya_pendaftaran')
        @endif
      </div>
    </div>
  </div>
  {{-- Footer --}}
  @include('Template.footer')

  <div class="content-backdrop fade"></div>
</div> 
<script>
  $('body').on('click', '#hapus-data', function(){
  var id = $(this).data('id');
  // loading 
  $('#loading-overlay').show();

  setTimeout(() => {
    Swal.fire({
      customClass:{
        container: 'my-swal',
      },
      title: 'Apa anda yakin!',
      text: "Ingin menghapus data ?",
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
          url: '{{ route('biaya-pendaftaran.destroy', [':id']) }}'.replace(':id', id),
          type: 'DELETE',
          success: function(response) {
            if(response.status == 200){

              $('#loading-overlay').hide();
              Swal.fire({
                customClass: {
                  container: 'my-swal',
                },
                title: 'Deleted!',
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