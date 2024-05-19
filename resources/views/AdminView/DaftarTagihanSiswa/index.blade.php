@extends('Template.Admin.master_admin')
@section('content')
@include('AdminView.DaftarTagihanSiswa.search')
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
          <button type="button" class="btn btn-primary" id="add-tagihan" >
            Tambah data
          </button>

          <!-- Modal tambah data -->
          @include('AdminView.DaftarTagihanSiswa.add_tagihan')
        </div>
          {{-- Tabel --}}
          <div class="card mb-3">
            <h5 class="card-header">Daftar tagihan siswa</h5>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 70px;">No.</th>
                      <th>No tagihan</th>
                      <th>Kode tagihan</th>
                      <th>Nama tagihan</th>
                      <th>Kelas</th>
                      <th>Nama siswa</th>
                      <th>Tgl Jatuh Tempo</th>
                      <th>Kategori tagihan</th>
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
                      <td>{{ $item->TagihanKelas->kelas  }}</td>
                      <td>{{ $item->TagihanSiswas->nama_lengkap  }}</td>
                      <td>{{ $item->jatuh_tempo  }}</td>
                      <td>{{ setFormatKategoriTagihan($item->kategori_tagihan)  }}</td>
                      <td>{{ formatRupiah($item->nominal_tagihan)  }}</td>
                      <td>
                        @if ($item->status == 'dibayar')
                          <span class="badge bg-success">Dibayar</span>
                        @elseif($item->status == 'belum_dibayar')
                          <span class="badge bg-warning">Belum dibayar</span>
                        @endif
                      </td>
                      <td>
                        @if ($item->status == 'belum_dibayar' || $item->status == 'dibatalkan')
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <button class="dropdown-item" type="button" id="buat-ulang" data-id="{{$item->kode_tagihan}}">
                              <i class="bx bx-edit-alt me-1"></i> 
                                Buat ulang
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
                  <h5 class="card-title text-primary">Belum ada data tagihan! 😞</h5>
                  <button class="btn btn-sm btn-outline-primary" type="button" id="add-tagihan">Tambah data sekarang</button>
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
          @include('AdminView.DaftarTagihanSiswa.add_tagihan')
        @endif
      </div>
    </div>
  </div>
  {{-- Footer --}}
  @include('Template.footer')

  <div class="content-backdrop fade"></div>
</div> 


<script>
    $('body').on('click', '#buat-ulang', function(){
    var id = $(this).data('id');
    
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
            url: '{{ route('regenerate.tagihan', [':id']) }}'.replace(':id', id),
            type: 'PUT',
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