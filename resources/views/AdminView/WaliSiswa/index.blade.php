@extends('Template.Admin.master_admin')
@section('content')
@include('AdminView.WaliSiswa.search')
<div id="loading-overlay" style="display: none;">
  @include('Template.loading')
</div>
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-md-12">

        {{-- Jika jumlah data banner lebih dari 0 --}}
        @if (count($wali_siswa) > 0)

        <div class="mb-3">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" id="add-wali" >
            Tambah data
          </button>

          <!-- Modal tambah data -->
          @include('AdminView.WaliSiswa.add_wali_siswa')
        </div>
          {{-- Tabel --}}
          <div class="card">
            <h5 class="card-header">Daftar wali siswa</h5>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>NIK</th>
                      <th>No Telp</th>
                      <th>Alamat</th>
                      <th>Hubungan status</th>
                      <th>Wali dari</th>
                      <th>Siswa kelas</th>
                      <th>Pekerjaan</th>
                      <th>Penghasilan</th>
                      <th>Pendidikan</th>
                      <th>Jenis Kelamin</th>
                      <th>Updated at</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $nomor = 1 + (($wali_siswa->currentPage() - 1) * $wali_siswa->perPage());
                    @endphp
                    @foreach($wali_siswa as $item)
                    <tr>
                      <td>{{$nomor++}}</td>
                      <td>{{ $item->nama_lengkap }}</td>
                      <td>{{ $item->nik }}</td>
                      <td>{{formatNoTelpon($item->no_telepon)}}</td>
                      <td><span class="d-inline-block text-truncate" style="max-width: 164px;">{{ $item->alamat }}</span></td>
                      <td>{{ $item->hubungan_status }}</td>
                      <td>{{ $item->Siswa->nama_lengkap }}</td>
                      <td>{{ $item->Siswa->KelasSiswa->kelas }}</td>
                      <td>{{ $item->pekerjaan }}</td>
                      <td>{{formatRupiah($item->penghasilan)}}</td>
                      <td>{{ $item->pendidikan }}</td>
                      <td>{{ $item->JenisKelaminWali->jenis_kelamin }}</td>
                      <td>{{ $item->updated_at }}</td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <button class="dropdown-item" type="button" id="edit-wali" data-id="{{$item->id}}">
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
                  {!! $wali_siswa->appends(Request::except('page'))->render() !!}
                </div>
              </div>
            </div>
          </div>

          {{-- Modal edit data --}}
          @include('AdminView.WaliSiswa.edit_wali_siswa')
          
        
        {{-- Jika data banner kosong --}}
        @else
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Belum ada data wali siswa! 😞</h5>
                  <button class="btn btn-sm btn-outline-primary" type="button" id="add-wali">Tambah data sekarang</button>
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
          @include('AdminView.WaliSiswa.add_wali_siswa')
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
          url: '{{ route('wali-siswa.destroy', [':id']) }}'.replace(':id', id),
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