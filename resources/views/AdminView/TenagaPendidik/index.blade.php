@extends('Template.Admin.master_admin')
@section('content')
@include('AdminView.TenagaPendidik.search')
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
          <button type="button" class="btn btn-primary" id="add-pendidik" >
            Tambah data
          </button>

          <!-- Modal tambah data -->
          @include('AdminView.TenagaPendidik.add_pendidik')
        </div>
          {{-- Tabel --}}
          <div class="card">
            <h5 class="card-header">Data kelas siswa</h5>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 70px;">No.</th>
                      <th>Nama</th>
                      <th>NIP</th>
                      <th>No NUPTK</th>
                      <th>Bidang</th>
                      <th>Jabatan</th>
                      <th>Jenis Kelamin</th>
                      <th>Foto</th>
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
                      <td>{{ $item->ProfilePendidik->nama_lengkap }}</td>
                      <td>{{ $item->ProfilePendidik->nip }}</td>
                      <td>{{ $item->ProfilePendidik->no_nuptk }}</td>
                      <td>{{ $item->ProfilePendidik->mapel }}</td>
                      <td>{{ $item->ProfilePendidik->jabatan }}</td>
                      <td>{{ $item->JenisKelaminPendidik->jenis_kelamin }}</td>
                      <td>
                        <div class="align-items-center">
                          <img src="{{ asset('storage/pendidik/' . $item->foto) }}" alt="{{ $item->foto }}" class="w-px-40 h-auto rounded-circle" />
                        </div>
                      </td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <button class="dropdown-item" type="button" id="detail" data-id="{{$item->id}}">
                              <i class='bx bx-show-alt me-1'></i>
                              Lihat detail
                            </button>
                            <button class="dropdown-item" type="button" id="edit-kelas" data-id="{{$item->id}}">
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
                  {!! $data->appends(Request::except('page'))->render() !!}
                </div>
              </div>
            </div>
          </div>

          {{-- Modal edit data --}}
          @include('AdminView.TenagaPendidik.edit_pendidik')
          
        
        {{-- Jika data banner kosong --}}
        @else
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Belum ada data tenaga pendidik! 😞</h5>
                  <button class="btn btn-sm btn-outline-primary" type="button" id="add-pendidik">Tambah data sekarang</button>
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
          @include('AdminView.TenagaPendidik.add_pendidik')
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
              url: '{{ route('tenaga-pendidik.destroy', [':id']) }}'.replace(':id', id),
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

    
    $('body').on('click', `#detail`, function () {
      var id = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
      // tampilkan spinner
      $('#loading-overlay').show();
      setTimeout(() => {
        $('#loading-overlay').hide();
        const url = `tenaga-pendidik-detail/${id}`
        window.location.href = url;
      }, 900);

    });
</script>
@endsection