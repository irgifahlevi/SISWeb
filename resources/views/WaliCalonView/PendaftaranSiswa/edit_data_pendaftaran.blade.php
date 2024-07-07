<style>
.visually-hidden {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    border: 0;
}
</style>
{{-- <div class="modal fade" id="edit-data-siswa" tabindex="-1" role="dialog" aria-labelledby="modal-add-kategori" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Edit data pendaftaran</h5>
        <button type="button" class="btn-close close-modal-tambah" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <form id="form-edit-pendaftaran" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <input type="hidden" name="gelombang_id" class="form-control" id="gelombang_id">
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
              <label class="form-label">Nama lengkap<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkaps" placeholder="Nama calon siswa"/>
              <small class="text-danger mt-2 error-messages" id="nama_lengkap-errors"></small>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
              <label class="form-label">NIK<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="nik" id="niks" placeholder="NIK 16 digit"/>
              <small class="text-danger mt-2 error-messages" id="nik-errors"></small>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
              <label class="form-label">No KK<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="no_kk" id="no_kks" placeholder="Nomor KK 16 digit"/>
              <small class="text-danger mt-2 error-messages" id="no_kk-errors"></small>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
              <label class="form-label">No NISN</label>
              <input type="number" class="form-control" name="no_nisn" id="no_nisns" placeholder="NISN calon siswa (opsional)"/>
              <small class="text-danger mt-2 error-messages" id="no_nisn-errors"></small>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
              <label class="form-label" for="no_telepon">No Telepon</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text">(+62)</span>
                  <input type="tel" id="no_telepons" name="no_telepon" class="form-control phone" placeholder="812-3456-7890 (opsional)" oninput="formatPhoneNumber(this)"/>
                </div>
                <small class="text-danger mt-2 error-messages" id="no_telepon-errors"></small>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
              <label class="form-label">Jenis kelamin<span class="text-danger">*</span></label>
              <select class="form-select" name="jenis_kelamin_id" id="jenis_kelamin_ids">
                <option value="">Pilih jenis kelamin</option>
              </select>
              <small class="text-danger mt-2 error-messages" id="jenis_kelamin_id-errors"></small>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
              <label class="form-label">Tempat lahir<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahirs" placeholder="Tempat lahir calon siswa"/>
              <small class="text-danger mt-2 error-messages" id="tempat_lahir-errors"></small>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
              <label class="form-label">Tanggal lahir<span class="text-danger">*</span></label>
              <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahirs"/>
              <small class="text-danger mt-2 error-messages" id="tanggal_lahir-errors"></small>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
              <label class="form-label">Agama<span class="text-danger">*</span></label>
              <select class="form-select" name="agama" id="agamas">
                <option value="">Pilih agama</option>
                <option value="Islam">Islam</option>
              </select>
              <small class="text-danger mt-2 error-messages" id="agama-errors"></small>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
              <label class="form-label">Kelurahan<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="kelurahan" id="kelurahans" placeholder="Masukkan kelurahan"/>
              <small class="text-danger mt-2 error-messages" id="kelurahan-errors"></small>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
              <label class="form-label">Kecamatan<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="kecamatan" id="kecamatans" placeholder="Masukkan kecamatan"/>
              <small class="text-danger mt-2 error-messages" id="kecamatan-errors"></small>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
              <label class="form-label">Kota<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="kota" id="kotas" placeholder="Masukkan kota"/>
              <small class="text-danger mt-2 error-messages" id="kota-errors"></small>
            </div>
          </div>
          <div class="row">
            <div class="col-12 mb-3">
              <label class="form-label">Alamat<span class="text-danger">*</span></label>
              <textarea class="form-control" name="alamat" id="alamats" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
              <small class="text-danger mt-2 error-messages" id="alamat-errors"></small>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
              <label class="form-label">Kode POS<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="kode_pos" id="kode_poss" placeholder="Kode pos 5 digit"/>
              <small class="text-danger mt-2 error-messages" id="kode_pos-errors"></small>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" id="emails" placeholder="Masukkan email (opsional)"/>
              <small class="text-danger mt-2 error-messages" id="email-errors"></small>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
              <label class="form-label">Tempat tinggal</label>
              <input type="text" class="form-control" name="tempat_tinggal" id="tempat_tinggals" placeholder="Tempat tinggal calon siswa"/>
              <small class="text-danger mt-2 error-messages" id="tempat_tinggal-errors"></small>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
              <label class="form-label">Asal sekolah<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="nama_sekolah_asal" id="nama_sekolah_asals" placeholder="Nama asal sekolah"/>
              <small class="text-danger mt-2 error-messages" id="nama_sekolah_asal-errors"></small>
            </div>
          </div>
          <div class="row">
            <div class="col-12 mb-3">
              <label class="form-label">Alamat asal sekolah<span class="text-danger">*</span></label>
              <textarea class="form-control" name="alamat_sekolah_asal" id="alamat_sekolah_asals" rows="3" placeholder="Masukkan alamat lengkap asal sekolah"></textarea>
              <small class="text-danger mt-2 error-messages" id="alamat_sekolah_asal-errors"></small>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
              <label class="form-label">Kota asal sekolah<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="kota_sekolah_asal" id="kota_sekolah_asals" placeholder="Kota asal sekolah"/>
              <small class="text-danger mt-2 error-messages" id="kota_sekolah_asal-errors"></small>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
              <label class="form-label">Tahun lulus<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="tahun_lulus" id="tahun_luluss" placeholder="Tahun lulus calon siswa"/>
              <small class="text-danger mt-2 error-messages" id="tahun_lulus-errors"></small>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
              <label class="form-label">Anak ke<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="anak_ke" id="anak_kes" placeholder="Masukkan anak ke"/>
              <small class="text-danger mt-2 error-messages" id="anak_ke-errors"></small>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
              <label class="form-label">Jumlah saudara<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="jumlah_saudara" id="jumlah_saudaras" placeholder="Jumlah saudara"/>
              <small class="text-danger mt-2 error-messages" id="jumlah_saudara-errors"></small>
            </div>
          </div>
          <div class="row">
            <div class="col-12 mb-3">
              <label class="form-label">NISN Sekolah<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="no_nisn_sekolah_asal" id="no_nisn_sekolah_asals" placeholder="Tahun lulus calon siswa"/>
              <small class="text-danger mt-2 error-messages" id="no_nisn_sekolah_asal-errors"></small>
            </div>
          </div>
          <div class="row">
            <!-- Dokumen 1: Pas Foto -->
            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
              <label class="form-label">Pas Foto<span class="text-danger">*</span></label>
              <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3 input-group">
                  <input type="file" class="form-control" name="pas_foto" id="pas_fotos" multiple>
                  <label for="foto_dokumen" class="input-group-text btn btn-primary upload-button">
                      Upload
                  </label>
              </div>
              <small class="text-danger mt-2 error-messages" id="pas_foto-errors"></small>
            </div>

            <!-- Dokumen 2: SKHUN atau Surat Kelulusan -->
            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
              <label class="form-label">SKHUN / Keterangan Lulus<span class="text-danger">*</span></label>
              <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3 input-group">
                  <input type="file" class="form-control" name="skhun" id="skhuns" multiple>
                  <label for="skhun" class="input-group-text btn btn-primary upload-button">
                      Upload
                  </label>
              </div>
              <small class="text-danger mt-2 error-messages" id="skhun-errors"></small>
            </div>

            <!-- Dokumen 3: Raport Terakhir -->
            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
              <label class="form-label">Raport Terakhir<span class="text-danger">*</span></label>
              <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3 input-group">
                  <input type="file" class="form-control" name="raport_terakhir" id="raport_terakhirs" multiple>
                  <label for="raport_terakhir" class="input-group-text btn btn-primary upload-button">
                      Upload
                  </label>
              </div>
              <small class="text-danger mt-2 error-messages" id="raport_terakhir-errors"></small>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update data</button>
        </div>
      </form>
    </div>
  </div>
</div> --}}

@section('scripts')
<script>

// function getDataInfo(data)
// {
//     $.ajax({
//     url: '{{route('data.jenis.kelamin')}}',
//     method: 'GET',
//     dataType: 'json',
//       success: function(response) {
//         // console.log(response);
//         if(response.status == 200){
//           let dataJenisKelamin = response.data;

//           // Tambahkan opsi pada select jenis kelamin
//           $('#edit-data-siswa #jenis_kelamin_ids').html('');
//           $('#edit-data-siswa #jenis_kelamin_ids').append(`<option value="">Pilih jenis kelamin</option>`);
//           dataJenisKelamin.forEach(function(kelamin){
//             let selected = '';
//             if(kelamin.id == data.jenis_kelamin_id){
//               selected = 'selected';
//             }
//             $('#edit-data-siswa #jenis_kelamin_ids').append(`<option value="${kelamin.id}" ${selected}>${kelamin.jenis_kelamin}</option>`);
//           });

//           $('#edit-data-siswa').modal('show');
//           $('#edit-data-siswa #data-container').hide();      
//           // sembunyikan spinner
//           $('#loading-overlay').hide();   
//           // tampilkan data pada form
//           $('#edit-data-siswa #data-container').show();
//         }
//       },
//       error: function(response){
//         console.log(response);
//       }
//     });
// }
  
  
  $('body').on('click', `#edit-documents`, function () {
    const id = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
    console.log(id);
    // kosongkan form
    $('#edit-')[0].reset();
    // tampilkan spinner
    $('#loading-overlay').show();


    setTimeout(() => {
      $.ajax({
      url: `pendaftaran-siswa/${id}/edit`,
      method: 'GET',
      dataType: 'json',
      success: function (response) {
        if(response.status == 200) {
          let data = response.data;
          getDataInfo(data);

          $('#edit-data-siswa').find('input[name="id"]').val(data.id);
          $('#edit-data-siswa').find('input[name="nama_lengkap"]').val(data.nama_lengkap);
          $('#edit-data-siswa').find('input[name="nik"]').val(data.nik);
          $('#edit-data-siswa').find('input[name="no_kk"]').val(data.no_kk);
          $('#edit-data-siswa').find('input[name="no_nisn"]').val(data.no_nisn);
          $('#edit-data-siswa').find('input[name="no_telepon"]').val(data.no_telepon);
          $('#edit-data-siswa').find('input[name="tempat_lahir"]').val(data.tempat_lahir);
          $('#edit-data-siswa').find('input[name="tanggal_lahir"]').val(data.tanggal_lahir);
          $('#edit-data-siswa').find('select[name="agama"]').val(data.agama);
          $('#edit-data-siswa').find('textarea[name="alamat"]').val(data.alamat);
          $('#edit-data-siswa').find('input[name="kelurahan"]').val(data.kelurahan);
          $('#edit-data-siswa').find('input[name="kecamatan"]').val(data.kecamatan);
          $('#edit-data-siswa').find('input[name="kota"]').val(data.kota);
          $('#edit-data-siswa').find('input[name="kode_pos"]').val(data.kode_pos);
          $('#edit-data-siswa').find('input[name="tempat_tinggal"]').val(data.tempat_tinggal);
          $('#edit-data-siswa').find('input[name="tahun_masuk"]').val(data.tahun_masuk);
          $('#edit-data-siswa').find('input[name="nis_lokal"]').val(data.nis_lokal);
          $('#edit-data-siswa').find('input[name="anak_ke"]').val(data.anak_ke);
          $('#edit-data-siswa').find('input[name="jumlah_saudara"]').val(data.jumlah_saudara);
        }
      },
      error: function(response)
      {
        if(response.status == 500){
          var res = response;
          //console.log(res);
          Swal.fire({
            customClass: {
              container: 'my-swal',
            },
            title: `${res.statusText}`,
            text: `${res.responseJSON.message}`,
            icon: 'error'
          });
          $('#edit-form-profile')[0].reset();
          // sembunyikan spinner
          $('#loading-overlay').hide();
        }
      },
    });
    }, 900);

  });

  // Simpan data
  $(document).ready(function(){


    $('#pas_foto').change(function() {
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#pas_foto-error').text('');
        }
        var fileName = $(this).val().split('\\').pop();
        if (fileName) {
            // Mengubah isi dari tombol "Upload" menjadi ikon ceklis
            $(this).siblings('.upload-button').html('<i class="bx bx-check"></i> Uploaded');
        } else {
            // Jika tidak ada file yang dipilih, kembalikan ke teks "Upload"
            $(this).siblings('.upload-button').html('Upload');
        }
    });

    // Saat input file berubah untuk SKHUN atau Surat Kelulusan
    $('#skhun').change(function() {
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#skhun-error').text('');
        }
        var fileName = $(this).val().split('\\').pop();
        if (fileName) {
            // Mengubah isi dari tombol "Upload" menjadi ikon ceklis
            $(this).siblings('.upload-button').html('<i class="bx bx-check"></i> Uploaded');
        } else {
            // Jika tidak ada file yang dipilih, kembalikan ke teks "Upload"
            $(this).siblings('.upload-button').html('Upload');
        }
    });

    // Saat input file berubah untuk Raport Terakhir
    $('#raport_terakhir').change(function() {
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#raport_terakhir-error').text('');
        }
        var fileName = $(this).val().split('\\').pop();
        if (fileName) {
            // Mengubah isi dari tombol "Upload" menjadi ikon ceklis
            $(this).siblings('.upload-button').html('<i class="bx bx-check"></i> Uploaded');
        } else {
            // Jika tidak ada file yang dipilih, kembalikan ke teks "Upload"
            $(this).siblings('.upload-button').html('Upload');
        }
    });

    $('#edit-').on('submit', function(e){
      e.preventDefault();
          // console.log('test');
          $('#nama_lengkap').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 100;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#nama_lengkap-error').text('');
            }
          });

          $('#nik').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 20;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#nik-error').text('');
            }
          });

          $('#no_kk').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 20;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#no_kk-error').text('');
            }
          });

          $('#no_nisn').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 20;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#no_nisn-error').text('');
            }
          });

          $('#no_telepon').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 20;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#no_telepon-error').text('');
            }
          });

          $('#jenis_kelamin_id').on('change', function(){
            const inputVal = $(this).val();
            if(inputVal !== ''){
              $('#jenis_kelamin_id-error').text('');
            }
          });

          $('#tempat_lahir').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 200;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#tempat_lahir-error').text('');
            }
          });

          $('#tanggal_lahir').on('change', function() {
            const inputVal = $(this).val();
            if(inputVal !== ''){
              $('#tanggal_lahir-error').text('');
            }
          });

          $('#agama').on('change', function() {
            const inputVal = $(this).val();
            if(inputVal !== ''){
              $('#agama-error').text('');
            }
          });

          $('#alamat').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 255;
            if (inputVal !== '' || inputVal.length <= maxLength) {
              $('#alamat-error').text('');
            }
          });

          $('#kelurahan').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 20;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#kelurahan-error').text('');
            }
          });

          $('#kecamatan').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 20;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#kecamatan-error').text('');
            }
          });

          $('#kota').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 20;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#kota-error').text('');
            }
          });

          $('#kode_pos').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 20;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#kode_pos-error').text('');
            }
          });

          $('#email').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 100;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#email-error').text('');
            }
          });

          $('#tempat_tinggal').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 20;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#tempat_tinggal-error').text('');
            }
          });

          $('#nama_sekolah_asal').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 100;
            if (inputVal !== '' || inputVal.length <= maxLength) {
              $('#nama_sekolah_asal-error').text('');
            }
          });

          $('#alamat_sekolah_asal').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 500;
            if (inputVal !== '' || inputVal.length <= maxLength) {
              $('#alamat_sekolah_asal-error').text('');
            }
          });

          $('#kota_sekolah_asal').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 20;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#kota_sekolah_asal-error').text('');
            }
          });

          $('#tahun_lulus').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 20;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#tahun_lulus-error').text('');
            }
          });

          $('#no_nisn_sekolah_asal').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 20;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#no_nisn_sekolah_asal-error').text('');
            }
          });

          $('#anak_ke').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 4;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#anak_ke-error').text('');
            }
          });

          $('#jumlah_saudara').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 4;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#jumlah_saudara-error').text('');
            }
          });

          $('#pas_foto').on('change', function(){
            const inputVal = $(this).val();
            if(inputVal !== ''){
              $('#pas_foto-error').text('');
            }
          });

          $('#skhun').on('change', function(){
            const inputVal = $(this).val();
            if(inputVal !== ''){
              $('#skhun-error').text('');
            }
          });

          $('#raport_terakhir').on('change', function(){
            const inputVal = $(this).val();
            if(inputVal !== ''){
              $('#raport_terakhir-error').text('');
            }
          });

          var formData = new FormData(this);

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          //for debug
          // for (let data of formData.entries()) {
          //   console.log(data[0] + ': ' + data[1]);
          // }

          $('#loading-overlay').show();

          setTimeout(() => {
            $.ajax({
              type: 'POST',
              url: '{{route('pendaftaran-siswa.store')}}',
              data: formData,
              dataType: 'json',
              processData: false,
              contentType: false,
              success: function(response)
              {
                  if(response.status == 200){

                    // Tutup modal add banner dan kosongkan form
                    $('#loading-overlay').hide();
                    $('#edit-data-siswa').modal('hide');
                    $('#edit-')[0].reset();

                    Swal.fire({
                      customClass: {
                        container: 'my-swal',
                      },
                      title: 'Created!',
                      text: `${response.message}`,
                      icon: 'success'
                    });

                    // Reload halaman
                    setTimeout(function(){
                      location.reload();
                    }, 800)
                  }
              },
              error: function(response)
              {
                if(response.status == 400){
                    let errors = response.responseJSON.message;
                    for (let key in errors) {
                      let errorMessage = errors[key].join(', ');
                      $('#' + key + '-error').text(errorMessage);
                    }
                }
                if(response.status == 500){
                  var res = response;
                  //console.log(res);

                  $('#loading-overlay').hide();
                  $('#edit-data-siswa').modal('hide');
                  $('#edit-')[0].reset();

                  Swal.fire({
                    customClass: {
                      container: 'my-swal',
                    },
                    title: `${res.statusText}`,
                    text: `${res.responseJSON.message}`,
                    icon: 'error'
                  });
                }
                $('#loading-overlay').hide();
              },
            })
          }, 900);

        });
      });

      // untuk menghapus pesan error ketika mmodal tertutup dan menghapus form
      $(document).ready(function () {
        // Menambahkan event listener pada tombol close
        $('.close-modal-tambah').on('click', function (e) {
          $('.error-messages').text(''); // Menghapus pesan error
          $('#edit-')[0].reset(); // Mereset form
        });

        // Menambahkan event listener pada modal
        $('#edit-data-siswa').on('hidden.bs.modal', function (e) {
          $('.error-messages').text(''); // Menghapus pesan error
          $('#edit-')[0].reset(); // Mereset form
        });
      });

      // input no telepon
      function formatPhoneNumber(input) {
        // Menghapus semua karakter kecuali angka
        let phoneNumber = input.value.replace(/\D/g, '');

        // Jika nomor dimulai dengan 0, hapus digit pertama
        if (phoneNumber.charAt(0) === '0') {
          phoneNumber = phoneNumber.slice(1);
        }

        // Memisahkan nomor telepon menjadi format yang diinginkan
        let formattedPhoneNumber = phoneNumber;

        // Menetapkan nilai kembali ke input
        input.value = formattedPhoneNumber;
      }

</script>

<script>
    $(document).ready(function() {
        // Saat input file berubah untuk foto siswa
        $('#foto_dokumen').change(function() {
            var fileName = $(this).val().split('\\').pop();
            if (fileName) {
                $('#foto_dokumen_1').next().next('.upload-button').html('<i class="menu-icon tf-icons bx bx-check"></i>');
            } else {
                $('#foto_dokumen_1').next().next('.upload-button').html('Upload');
            }
        });

        // // Saat input file berubah untuk SKHUN atau Surat Kelulusan
        // $('#foto_dokumen_2').change(function() {
        //     var fileName = $(this).val().split('\\').pop();
        //     if (fileName) {
        //         $('#foto_dokumen_2').next().next('.upload-button').html('<i class="menu-icon tf-icons bx bx-check"></i>');
        //     } else {
        //         $('#foto_dokumen_2').next().next('.upload-button').html('Upload');
        //     }
        // });

        // // Saat input file berubah untuk raport terakhir
        // $('#foto_dokumen_3').change(function() {
        //     var fileName = $(this).val().split('\\').pop();
        //     if (fileName) {
        //         $('#foto_dokumen_3').next().next('.upload-button').html('<i class="menu-icon tf-icons bx bx-check"></i>');
        //     } else {
        //         $('#foto_dokumen_3').next().next('.upload-button').html('Upload');
        //     }
        // });
    });
    </script>
@endsection
