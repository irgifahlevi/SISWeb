<div class="modal fade" id="add-data-siswa" tabindex="-1" role="dialog" aria-labelledby="modal-add-kategori" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Form pendaftaran siswa baru</h5>
        <button type="button" class="btn-close close-modal-tambah" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <form id="form-pendaftaran" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="mb-3 col-12 mb-4">
            <div class="alert alert-warning">
              <h6 class="alert-heading fw-bold mb-1">Perhatian penting !</h6>
              <p class="mb-0">Sebelum menyimpan data, pastikan untuk memeriksa kembali form agar tidak terjadi kesalahan pada pengisian data.</p>
            </div>
          </div>
          <div class="row">
            <input type="hidden" name="gelombang_id" class="form-control" id="gelombang_id">
            <div class="col mb-3">
              <label class="form-label">Nama lengkap<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama calon siswa"/>
              <small class="text-danger mt-2 error-message" id="nama_lengkap-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">NIK<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="nik" id="nik" placeholder="NIK 16 digit"/>
              <small class="text-danger mt-2 error-message" id="nik-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">No KK<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="no_kk" id="no_kk" placeholder="Nomor KK 16 digit"/>
              <small class="text-danger mt-2 error-message" id="no_kk-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">No NISN</label>
              <input type="number" class="form-control" name="no_nisn" id="no_nisn" placeholder="NISN calon siswa (opsional)"/>
              <small class="text-danger mt-2 error-message" id="no_nisn-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label" for="no_telepon">No Telepon</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text">(+62)</span>
                  <input type="tel" id="no_telepon" name="no_telepon" class="form-control phone" placeholder="812-3456-7890 (opsional)" oninput="formatPhoneNumber(this)"/>
                </div>
                <small class="text-danger mt-2 error-message" id="no_telepon-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Jenis kelamin<span class="text-danger">*</span></label>
              <select class="form-select" name="jenis_kelamin_id" id="jenis_kelamin_id">
                <option value="">Pilih jenis kelamin</option>
              </select>
              <small class="text-danger mt-2 error-message" id="jenis_kelamin_id-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Tempat lahir<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat lahir calon siswa"/>
              <small class="text-danger mt-2 error-message" id="tempat_lahir-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Tanggal lahir<span class="text-danger">*</span></label>
              <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"/>
              <small class="text-danger mt-2 error-message" id="tanggal_lahir-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Agama<span class="text-danger">*</span></label>
              <select class="form-select" name="agama" id="agama">
                <option value="">Pilih agama</option>
                <option value="Islam">Islam</option>
              </select>
              <small class="text-danger mt-2 error-message" id="agama-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Kelurahan<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="kelurahan" id="kelurahan" placeholder="Masukkan kelurahan"/>
              <small class="text-danger mt-2 error-message" id="kelurahan-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Kecamatan<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="Masukkan kecamatan"/>
              <small class="text-danger mt-2 error-message" id="kecamatan-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Kota<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="kota" id="kota" placeholder="Masukkan kota"/>
              <small class="text-danger mt-2 error-message" id="kota-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Alamat<span class="text-danger">*</span></label>
              <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
              <small class="text-danger mt-2 error-message" id="alamat-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Kode POS<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="kode_pos" id="kode_pos" placeholder="Kode pos 5 digit"/>
              <small class="text-danger mt-2 error-message" id="kode_pos-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email (opsional)"/>
              <small class="text-danger mt-2 error-message" id="email-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Tempat tinggal</label>
              <input type="text" class="form-control" name="tempat_tinggal" id="tempat_tinggal" placeholder="Tempat tinggal calon siswa"/>
              <small class="text-danger mt-2 error-message" id="tempat_tinggal-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Asal sekolah<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="nama_sekolah_asal" id="nama_sekolah_asal" placeholder="Nama asal sekolah"/>
              <small class="text-danger mt-2 error-message" id="nama_sekolah_asal-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Alamat asal sekolah<span class="text-danger">*</span></label>
              <textarea class="form-control" name="alamat_sekolah_asal" id="alamat_sekolah_asal" rows="3" placeholder="Masukkan alamat lengkap asal sekolah"></textarea>
              <small class="text-danger mt-2 error-message" id="alamat_sekolah_asal-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Kota asal sekolah<span class="text-danger">*</span></label>
              <input type="tet" class="form-control" name="kota_sekolah_asal" id="kota_sekolah_asal" placeholder="Kota asal sekolah"/>
              <small class="text-danger mt-2 error-message" id="kota_sekolah_asal-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Tahun lulus<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="tahun_lulus" id="tahun_lulus" placeholder="Tahun lulus calon siswa"/>
              <small class="text-danger mt-2 error-message" id="tahun_lulus-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Anak ke<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="anak_ke" id="anak_ke" placeholder="Masukkan anak ke"/>
              <small class="text-danger mt-2 error-message" id="anak_ke-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Jumlah saudara<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="jumlah_saudara" id="jumlah_saudara" placeholder="Jumlah saudara"/>
              <small class="text-danger mt-2 error-message" id="jumlah_saudara-error"></small>
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
    const gelombang_id = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
    // console.log(id);
    // kosongkan form
    $('#form-pendaftaran')[0].reset();
    // tampilkan spinner
    $('#loading-overlay').show();


    setTimeout(() => {
      $.ajax({
        url: '{{route('data.jenis.kelamin')}}',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          // console.log(response);
          if(response.status == 200) {

            var jenisKelamin = '<option value="">Pilih jenis kelamin</option>';
            $.each(response.data, function(index, kel) {
              jenisKelamin += '<option value="' + kel.id + '">' + kel.jenis_kelamin + '</option>';
            });

            $('#jenis_kelamin_id').html(jenisKelamin);

            $('#add-data-siswa').modal('show');

            $('#add-data-siswa').find('input[name="gelombang_id"]').val(gelombang_id);
            $('#loading-overlay').hide();
          }
        }
      });
    }, 900);

  });

  // Simpan data
  $(document).ready(function(){
    $('#form-pendaftaran').on('submit', function(e){
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
                    $('#add-data-siswa').modal('hide');
                    $('#form-pendaftaran')[0].reset();

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
                  $('#add-data-siswa').modal('hide');
                  $('#form-pendaftaran')[0].reset();

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
          $('.error-message').text(''); // Menghapus pesan error
          $('#form-pendaftaran')[0].reset(); // Mereset form
        });
        
        // Menambahkan event listener pada modal
        $('#add-data-siswa').on('hidden.bs.modal', function (e) {
          $('.error-message').text(''); // Menghapus pesan error
          $('#form-pendaftaran')[0].reset(); // Mereset form
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
@endsection