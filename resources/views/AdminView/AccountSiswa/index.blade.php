@extends('Template.Admin.master_admin')
@section('content')
@include('AdminView.RegistrasiAccount.search')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-md-12">

        {{-- Jika jumlah data banner lebih dari 0 --}}
        @if (count($account_siswa) > 0)

        <div class="mb-3">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" id="add-siswa" >
            Add account siswa
          </button>

          <!-- Modal tambah data -->
          @include('AdminView.AccountSiswa.add_siswa')
        </div>
          {{-- Tabel --}}
          <div class="card">
            <h5 class="card-header">Data pendaftaran account login</h5>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Role</th>
                      <th>Created By</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $nomor = 1 + (($account_siswa->currentPage() - 1) * $account_siswa->perPage());
                    @endphp
                    @foreach($account_siswa as $item)
                    <tr>
                      <td>{{$nomor++}}</td>
                      <td>{{ $item->username }}</td>
                      <td>{{ $item->email }}</td>
                      <td>
                        @if ($item->row_status == '0')
                          <span class="badge bg-success">Active</span>
                        @elseif($item->row_status == '-1')
                          <span class="badge bg-primary">Inactive</span>
                        @endif
                      </td>
                      <td>{{ $item->role }}</td>
                      <td>{{ $item->created_by }}</td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <button class="dropdown-item" type="button" id="edit-siswa-modal" data-id="{{$item->id}}">
                              <i class="bx bx-edit-alt me-1"></i> 
                              Edit
                            </button>
                            <button class="dropdown-item" type="button" id="active" data-id="{{$item->id}}">
                              <i class='bx bx-refresh me-1'></i>
                              Active
                            </button>
                            <button class="dropdown-item" type="button" id="inactive" data-id="{{$item->id}}">
                              <i class='bx bx-refresh me-1'></i>
                              Inactive
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
                  {!! $account_siswa->appends(Request::except('page'))->render() !!}
                </div>
              </div>
            </div>
          </div>

          <div id="loading-overlay" style="display: none;">
            @include('Template.loading')
          </div>
          {{-- Modal edit data --}}
          @include('AdminView.AccountSiswa.edit_siswa')
          
        
        {{-- Jika data banner kosong --}}
        @else
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Belum ada data request pendaftaran account! 😞</h5>
                  <p class="mb-4">
                    Silahkan kembali lagi nanti
                  </p>
                  <button class="btn btn-sm btn-outline-primary" type="button" id="add-siswa">Tambah account siswa</button>
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
          @include('AdminView.AccountSiswa.add_siswa')
        @endif
      </div>
    </div>
  </div>
  {{-- Footer --}}
  @include('Template.footer')

  <div class="content-backdrop fade"></div>
</div> 


<script>

  $('body').on('click', '#inactive', function(){
    var id = $(this).data('id');
    var status = '-1';

    // loading 
    $('#loading-overlay').show();

    setTimeout(() => {
      Swal.fire({
        customClass:{
          container: 'my-swal',
        },
        title: 'Apa anda yakin!',
        text: "Ingin menonaktifkan account ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Inactive'
      }).then((result) => {
        if (result.isConfirmed){
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route('update.status.account', [':id', ':status']) }}'.replace(':id', id).replace(':status', status),
            type: 'PUT',
            success: function(response) {
              if(response.status == 200){

                $('#loading-overlay').hide();
                Swal.fire({
                  customClass: {
                    container: 'my-swal',
                  },
                  title: 'Inactived!',
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



  $('body').on('click', '#active', function(){
    var id = $(this).data('id');
    var status = '0';

    // loading 
    $('#loading-overlay').show();

    setTimeout(() => {
      Swal.fire({
        customClass:{
          container: 'my-swal',
        },
        title: 'Apa anda yakin!',
        text: "Ingin mengaktifkan account ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Active'
      }).then((result) => {
        console.log(result);
        if (result.isConfirmed){
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route('update.status.account', [':id', ':status']) }}'.replace(':id', id).replace(':status', status),
            type: 'PUT',
            success: function(response) {
              if(response.status == 200){

                $('#loading-overlay').hide();
                Swal.fire({
                  customClass: {
                    container: 'my-swal',
                  },
                  title: 'Activated!',
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
        } else {
          $('#loading-overlay').hide();
        }
      });


    }, 800);
  })
</script>
@endsection