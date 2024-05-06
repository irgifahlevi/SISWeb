<div class="modal fade" id="add-data-siswa" tabindex="-1" role="dialog" aria-labelledby="modal-add-kategori" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Profile orangtua calon siswa</h5>
        <button type="button" class="btn-close close-modal-tambah" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <form id="form-register" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">NIK<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="nik" id="nik" placeholder="Nomor NIK 16 digit"/>
              <small class="text-danger mt-2 error-message" id="nik-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label" for="no_telepon">No Telepon</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text">ID (+62)</span>
                  <input type="tel" id="no_telepon" name="no_telepon" class="form-control phone" placeholder="812-3456-7890" oninput="formatPhoneNumber(this)"/>
                </div>
                <small class="text-danger mt-2 error-message" id="no_telepon-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Hubungan status<span class="text-danger">*</span></label>
                <select class="form-select" name="hubungan_status" id="hubungan_status">
                    <option value="">Pilih status hubungan</option>
                    <option value="Ayah">Ayah</option>
                    <option value="Ibu">Ibu</option>
                    <option value="Kakak">Kakak</option>
                </select>
                <small class="text-danger mt-2 error-message" id="hubungan_status-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Pekerjaan<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan saat ini"/>
              <small class="text-danger mt-2 error-message" id="pekerjaan-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Pendidikan terakhir<span class="text-danger">*</span></label>
              <select class="form-select" name="pendidikan" id="pendidikan">
                <option value="">Pilih pendidikan terakhir</option>
                <option value="Tidak sekolah">Tidak sekolah</option>
                <option value="SD">SD</option>
                <option value="SLTP">SLTP</option>
                <option value="SLTA">SLTA</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
              </select>
              <small class="text-danger mt-2 error-message" id="pendidikan-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Jenis kelamin<span class="text-danger">*</span></label>
              <select class="form-select" name="jenis_kelamin_id" id="jenis_kelamin_id">
                <option value="">Pilih jenis kelamin</option>
              </select>
              <small class="text-danger mt-2 error-message" id="jenis_kelamin_id-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Penghasilan<span class="text-danger">*</span></label>
              <input type="text" class="form-control rupiah" name="penghasilan" id="penghasilan" placeholder="Penghasilan perbulan"></input>
              <small class="text-danger mt-2 error-message" id="penghasilan-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Alamat</label>
              <textarea class="form-control" name="alamat" id="alamat" placeholder="Masukan alamat lengkap"></textarea>
              <small class="text-danger mt-2 error-message" id="alamat-error"></small>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan data</button>
        </div>
      </form>
    </div>
  </div>
</div>

@section('scripts')
<script>
  $('body').on('click', `#form-data-siswa`, function () {
    var id = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
    //id = 1;

    console.log(id);
    // kosongkan form
    $('#form-register')[0].reset();
    // tampilkan spinner
    $('#loading-overlay').show();


    setTimeout(() => {
      $('#add-data-siswa').modal('show');
      // sembunyikan spinner
      $('#loading-overlay').hide();

    }, 900);

  });

</script>
@endsection