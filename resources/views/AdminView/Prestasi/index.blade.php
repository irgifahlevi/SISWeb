@extends('Template.Admin.master_admin')
@section('content')
@include('AdminView.Prestasi.search')
<div id="loading-overlay" style="display: none;">
  @include('Template.loading')
</div>
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-md-12">

        {{-- Jika jumlah data banner lebih dari 0 --}}
        @if (count($prestasi) > 0)

        <div class="mb-3">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" id="add-prestasi" >
            Tambah data
          </button>

          <!-- Modal tambah data -->
          @include('AdminView.Prestasi.add_prestasi')
        </div>
          {{-- Tabel --}}
          <div class="card">
            <h5 class="card-header">Data prestasi sekolah</h5>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 70px;">No.</th>
                      <th>Title</th>
                      <th>Nama</th>
                      <th>Deskripsi</th>
                      <th>Gambar</th>
                      <th>Update date</th>
                      <th>Created by</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $nomor = 1 + (($prestasi->currentPage() - 1) * $prestasi->perPage());
                    @endphp
                    @foreach($prestasi as $item)
                    <tr>
                      <td>{{$nomor++}}</td>
                      <td><span class="d-inline-block text-truncate" style="max-width: 164px;">{{ $item->title }}</span></td>
                      <td><span class="d-inline-block text-truncate" style="max-width: 164px;">{{ $item->nama }}</span></td>
                      <td><span class="d-inline-block text-truncate" style="max-width: 164px;">{{ $item->deskripsi }}</span></td>
                      <td>
                        <div class="align-items-center">
                          @if ($item->gambar)
                            <img src="{{ asset('storage/kurikulum_prestasi/' . $item->gambar) }}" alt="{{ $item->gambar }}" class="w-px-40 h-auto rounded-circle" />
                          @endif
                        </div>
                      </td>
                      <td>{{ $item->updated_at }}</td>
                      <td>{{ $item->created_by }}</td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <button class="dropdown-item" type="button" id="edit-prestasi" data-id="{{$item->id}}">
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
                  {!! $prestasi->appends(Request::except('page'))->render() !!}
                </div>
              </div>
            </div>
          </div>

          {{-- Modal edit data --}}
          @include('AdminView.Prestasi.edit_prestasi')
          
        
        {{-- Jika data banner kosong --}}
        @else
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Belum ada data prestasi! 😞</h5>
                  <button class="btn btn-sm btn-outline-primary" type="button" id="add-prestasi">Tambah data sekarang</button>
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
          @include('AdminView.Prestasi.add_prestasi')
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
            url: '{{ route('prestasi-sekolah.destroy', [':id']) }}'.replace(':id', id),
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