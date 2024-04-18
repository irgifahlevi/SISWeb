@extends('Template.Admin.master_admin')
@section('content')
@include('AdminView.RegistrasiAccount.search')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-md-12">

        {{-- Jika jumlah data banner lebih dari 0 --}}
        @if (count($pendaftar_account) > 0)

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
                      <th>Login</th>
                      <th>Waktu login</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $nomor = 1 + (($pendaftar_account->currentPage() - 1) * $pendaftar_account->perPage());
                    @endphp
                    @foreach($pendaftar_account as $item)
                    <tr>
                      <td>{{$nomor++}}</td>
                      <td>{{ $item->username }}</td>
                      <td>{{ $item->email }}</td>
                      <td>
                        @if ($item->status == 'accepted')
                          <span class="badge bg-success">{{$item->status}}</span>
                        @elseif($item->status == 'pending')
                          <span class="badge bg-primary">{{$item->status}}</span>
                        @elseif($item->status == 'decline')
                          <span class="badge bg-warning">{{$item->status}}</span>
                        @endif
                      </td>
                      <td>
                        @if ($item->login == 'yes')
                          <span class="badge bg-success">{{$item->login}}</span>
                        @elseif($item->login == 'no')
                          <span class="badge bg-primary">{{$item->login}}</span>
                        @endif
                      </td>
                      <td>{{ $item->login_date }}</td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <button class="dropdown-item" type="button" id="accept" data-id="{{$item->id}}">
                              <i class="bx bx-edit-alt me-1"></i> 
                              Accept
                            </button>
                            <button class="dropdown-item" type="button" id="reject" data-id="{{$item->id}}">
                              <i class="bx bx-trash me-1"></i> 
                              Decline
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
                  {!! $pendaftar_account->appends(Request::except('page'))->render() !!}
                </div>
              </div>
            </div>
          </div>

          {{-- Modal edit data --}}
         
          

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
  $('body').on('click', '#reject', function(){
    var id = $(this).data('id');
    var status = 'decline';

    Swal.fire({
      customClass:{
        container: 'my-swal',
      },
      title: 'Apa anda yakin?',
      text: "Request akan di reject dan tidak dapat di ulangi kembali.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Reject'
    }).then((result) => {
      if (result.isConfirmed){
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '{{ route('update.status', [':id', ':status']) }}'.replace(':id', id).replace(':status', status),
          type: 'PUT',
          success: function(response) {
            if(response.status == 200){
              Swal.fire({
                customClass: {
                  container: 'my-swal',
                },
                title: 'Rejected!',
                text: `${response.message}`,
                icon: 'success'
              });

              // Reload halaman
              setTimeout(function(){
                location.reload();
              }, 600);
            }
          },
          error: function(response){
            if(response.status == 500){
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
    });
  })



  $('body').on('click', '#accept', function(){
    var id = $(this).data('id');
    var status = 'accepted';

    Swal.fire({
      customClass:{
        container: 'my-swal',
      },
      title: 'Apa anda yakin?',
      text: "Request akan di approve dan tidak dapat di ulangi kembali.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Accepted'
    }).then((result) => {
      if (result.isConfirmed){
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '{{ route('update.status', [':id', ':status']) }}'.replace(':id', id).replace(':status', status),
          type: 'PUT',
          success: function(response) {
            if(response.status == 200){
              Swal.fire({
                customClass: {
                  container: 'my-swal',
                },
                title: 'Accepted!',
                text: `${response.message}`,
                icon: 'success'
              });

              // Reload halaman
              setTimeout(function(){
                location.reload();
              }, 600);
            }
          },
          error: function(response){
            if(response.status == 500){
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
    });
  })
</script>
@endsection