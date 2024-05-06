@extends('Template.WaliCalon.master_wali')
@section('content')
<div id="loading-overlay" style="display: none;">
  @include('Template.loading')
</div>
@include('WaliCalonView.ProfileWaliCalon.update_password')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <h5 class="card-header">Profile detail</h5>
          <hr class="my-0" />
          <div class="card-body">
            <div class="mb-3 col-12 mb-0">
              <div class="alert alert-success bg-label-dark">
                <div class="mx-3 my-3">
                  <div class="row">
                    <dt class="col-sm-3">Nama</dt>
                    <dd class="col-sm-3">{{ $data->Users->username }}</dd>
                  </div>
                  <div class="row">
                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-3">{{ $data->Users->email }}</dd>
                  </div>
                  <div class="row">
                    <dt class="col-sm-3">NIK</dt>
                    <dd class="col-sm-3">{{$data->nik}}</dd>
                  </div>
                  <div class="row">
                    <dt class="col-sm-3">Hubungan status</dt>
                    <dd class="col-sm-3">{{$data->hubungan_status}}</dd>
                  </div>
                  <div class="row">
                    <dt class="col-sm-3">Pekerjaan</dt>
                    <dd class="col-sm-3">{{$data->pekerjaan}}</dd>
                  </div>
                  <div class="row">
                    <dt class="col-sm-3">Penghasilan</dt>
                    <dd class="col-sm-3">{{formatRupiah($data->penghasilan)}}</dd>
                  </div>
                  <div class="row">
                    <dt class="col-sm-3">Pendidikan</dt>
                    <dd class="col-sm-3">{{$data->pendidikan}}</dd>
                  </div>
                  <div class="row">
                    <dt class="col-sm-3">Jenis kelamin</dt>
                    <dd class="col-sm-3">{{$data->JenisKelamin->jenis_kelamin}}</dd>
                  </div>
                  <div class="row">
                    <dt class="col-sm-3">No telepon</dt>
                    <dd class="col-sm-3">{{formatNoTelpon($data->no_telepon)}}</dd>
                  </div>
                  <div class="row">
                    <dt class="col-sm-3">Alamat</dt>
                    <dd class="col-sm-3">{{$data->alamat}}</dd>
                  </div>
                  <div class="row">
                    <dt class="col-sm-3">Register date</dt>
                    <dd class="col-sm-3">{{$data->Users->created_at}}</dd>
                  </div>
                  <div class="row">
                    <dt class="col-sm-3">Password update date</dt>
                    <dd class="col-sm-3">
                        @if($data->Users->updated_at)
                            {{ $data->Users->updated_at }}
                        @else
                            -
                        @endif
                    </dd>
                  </div>
                </div>
              </div>
            </div>
            <div class="alert alert-warning mb-0" role="alert">
              <em class="text-sm">*Segera perbarui kata sandi Anda untuk keamanan akun. Atau abaikan pesan ini jika password anda sudah di perbarui</em>
            </div>
            <div class="mt-3 mb-3">
              <button type="submit" class="btn btn-primary me-2" id="edit-profile" data-id="{{$data->id}}">Edit data profile</button>
              <button type="submit" class="btn btn-outline-danger" id="edit-password" data-id="{{$data->id}}">Change password</button>
            </div>
            @include('WaliCalonView.ProfileWaliCalon.edit_profile_wali')
          </div>
        </div>
      </div>
    </div>
  </div>
    {{-- Footer --}}
    @include('Template.footer')

    <div class="content-backdrop fade"></div>
</div>

@endsection