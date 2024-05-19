@extends('Template.Admin.master_admin')
@section('content')
@include('AdminView.ProfileSiswa.search')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-md-12">

        {{-- Jika jumlah data banner lebih dari 0 --}}
        @if (count($profile_siswa) > 0)
          {{-- Tabel --}}
          <div class="card">
            <h5 class="card-header">Daftar siswa</h5>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama siswa</th>
                      <th>Email</th>
                      <th>NIK</th>
                      <th>No KK</th>
                      <th>No NISN</th>
                      <th>No Telp</th>
                      <th>Jenis Kelamin</th>
                      <th>Kelas</th>
                      <th>Ruangan</th>
                      <th>Tempat lahir</th>
                      <th>Tgl lahir</th>
                      <th>Agama</th>
                      <th>Alamat</th>
                      <th>Kelurahan</th>
                      <th>Kecamatan</th>
                      <th>Kota</th>
                      <th>Kode POS</th>
                      <th>Tempat tinggal</th>
                      <th>Tahun masuk</th>
                      <th>NIS lokal</th>
                      <th>Anak ke</th>
                      <th>Jumlah saudara</th>
                      <th>Updated at</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $nomor = 1 + (($profile_siswa->currentPage() - 1) * $profile_siswa->perPage());
                    @endphp
                    @foreach($profile_siswa as $item)
                    <tr>
                      <td>{{$nomor++}}</td>
                      <td>{{ $item->nama_lengkap }}</td>
                      <td>{{ $item->UserSiswa->email }}</td>
                      <td>{{ $item->nik }}</td>
                      <td>{{ $item->no_kk }}</td>
                      <td>{{ $item->no_nisn }}</td>
                      <td>{{formatNoTelpon($item->no_telepon)}}</td>
                      <td>{{ $item->JenisKelaminSiswa->jenis_kelamin }}</td>
                      <td>{{ $item->KelasSiswa->kelas }}</td>
                      <td>{{ $item->KelasSiswa->ruangan }}</td>
                      <td>{{ $item->tempat_lahir }}</td>
                      <td>{{ $item->tanggal_lahir }}</td>
                      <td>{{ $item->agama }}</td>
                      <td><span class="d-inline-block text-truncate" style="max-width: 164px;">{{ $item->alamat }}</span></td>
                      <td>{{ $item->kelurahan }}</td>
                      <td>{{ $item->kecamatan }}</td>
                      <td>{{ $item->kota }}</td>
                      <td>{{ $item->kode_pos }}</td>
                      <td><span class="d-inline-block text-truncate" style="max-width: 164px;">{{ $item->tempat_tinggal }}</span></td>
                      <td>{{ $item->tahun_masuk }}</td>
                      <td>{{ $item->nis_lokal }}</td>
                      <td>{{ $item->anak_ke }}</td>
                      <td>{{ $item->jumlah_saudara }}</td>
                      <td>{{ $item->updated_at }}</td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <button class="dropdown-item" type="button" id="edit-siswa" data-id="{{$item->id}}">
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
                  {!! $profile_siswa->appends(Request::except('page'))->render() !!}
                </div>
              </div>
            </div>
          </div>

          <div id="loading-overlay" style="display: none;">
            @include('Template.loading')
          </div>
          {{-- Modal edit data --}}
          @include('AdminView.ProfileSiswa.edit_profile_siswa')
          
        
        {{-- Jika data banner kosong --}}
        @else
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Belum ada data siswa! 😞</h5>
                  <a href="{{route('account_siswa.index')}}" class="btn btn-sm btn-outline-primary" type="button" id="add-biaya">Tambah data sekarang</a>
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
          url: '{{ route('profile-siswa.destroy', [':id']) }}'.replace(':id', id),
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