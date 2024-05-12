<div class="modal fade" id="add-modal-profile" tabindex="-1" role="dialog" aria-labelledby="modal-add" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Tambah profile</h5>
        <button type="button" class="btn-close close-modal-tambah" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <form id="form-add-profile" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <input type="hidden" name="user_id" class="form-control" id="user_id">
            <div class="col mb-3">
              <label class="form-label">Nama lengkap<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap"/>
              <small class="text-danger mt-2 error-message" id="nama_lengkap-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">NIK<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="nik" id="nik"/>
              <small class="text-danger mt-2 error-message" id="nik-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">No KK<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="no_kk" id="no_kk"/>
              <small class="text-danger mt-2 error-message" id="no_kk-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">No NISN</label>
              <input type="number" class="form-control" name="no_nisn" id="no_nisn"/>
              <small class="text-danger mt-2 error-message" id="no_nisn-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label" for="no_telepon">No Telepon</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text">ID (+62)</span>
                  <input type="tel" id="no_telepon" name="no_telepon" class="form-control phone" oninput="formatPhoneNumber(this)"/>
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
              <label class="form-label">Kelas<span class="text-danger">*</span></label>
              <select class="form-select" name="kelas_id" id="kelas_id">
                <option value="">Pilih kelas</option>
              </select>
              <small class="text-danger mt-2 error-message" id="kelas_id-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Tempat lahir<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"/>
              <small class="text-danger mt-2 error-message" id="tempat_lahir-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Tanggal lahir<span class="text-danger">*</span></label>
              <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"/>
              <small class="text-danger mt-2 error-message" id="tanggal_lahir-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Agama<span class="text-danger">*</span></label>
              <select class="form-select" name="agama" id="agama">
                <option value="">Pilih agama</option>
                <option value="Islam">Islam</option>
              </select>
              <small class="text-danger mt-2 error-message" id="agama-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Kelurahan</label>
              <input type="text" class="form-control" name="kelurahan" id="kelurahan"/>
              <small class="text-danger mt-2 error-message" id="kelurahan-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Kecamatan</label>
              <input type="text" class="form-control" name="kecamatan" id="kecamatan"/>
              <small class="text-danger mt-2 error-message" id="kecamatan-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Kota</label>
              <input type="text" class="form-control" name="kota" id="kota"/>
              <small class="text-danger mt-2 error-message" id="kota-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Kode POS</label>
              <input type="text" class="form-control" name="kode_pos" id="kode_pos"/>
              <small class="text-danger mt-2 error-message" id="kode_pos-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Tempat tinggal</label>
              <input type="text" class="form-control" name="tempat_tinggal" id="tempat_tinggal"/>
              <small class="text-danger mt-2 error-message" id="tempat_tinggal-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Tahun masuk<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="tahun_masuk" id="tahun_masuk"/>
              <small class="text-danger mt-2 error-message" id="tahun_masuk-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Nis lokal<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="nis_lokal" id="nis_lokal"/>
              <small class="text-danger mt-2 error-message" id="nis_lokal-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Anak ke<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="anak_ke" id="anak_ke"/>
              <small class="text-danger mt-2 error-message" id="anak_ke-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Jumlah saudara<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="jumlah_saudara" id="jumlah_saudara"/>
              <small class="text-danger mt-2 error-message" id="jumlah_saudara-error"></small>
            </div>
            <div class="col mb-3">
              <input type="hidden" class="form-control"/>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Alamat<span class="text-danger">*</span></label>
              <textarea class="form-control" name="alamat" id="alamat" rows="3"></textarea>
              <small class="text-danger mt-2 error-message" id="alamat-error"></small>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
  $('body').on('click', '#add-profile', function () {
    var id = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
    // id = 13;
    // kosongkan form
    $('#form-add-profile')[0].reset();
    // tampilkan spinner
    $('#loading-overlay').show();


    setTimeout(() => {
      
      $.ajax({
        url: '{{route('data.kelas')}}',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
              // console.log(response);
          if(response.status == 200) {

            var dataKelas = '<option value="">Pilih kelas</option>';
            $.each(response.data, function(index, kel) {
              dataKelas += '<option value="' + kel.id + '">' + kel.kelas + '</option>';
            });

            $('#kelas_id').html(dataKelas);
          }
        },
        error: function(response) {
          console.log(response);
        }
      });
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
          }
        },
        error: function(response) {
          console.log(response);
        }
      });
      $.ajax({
      url: `show_account/${id}`,
      method: 'GET',
      dataType: 'json',
      success: function (response) {
        if(response.status == 200) {
          let data = response.data;

          $('#add-modal-profile').modal('show');

          $('#add-modal-profile #data-container').hide();
          
          // sembunyikan spinner
          $('#loading-overlay').hide();
          
          // tampilkan data pada form
          $('#add-modal-profile #data-container').show();

          $('#add-modal-profile').find('input[name="user_id"]').val(data.id);
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
          $('#form-add-profile')[0].reset();
          // sembunyikan spinner
          $('#loading-overlay').hide();
        }
      },
    });
    }, 900);
  });

  // Simpan data
  $(document).ready(function(){
    $('#form-add-profile').on('submit', function(e){
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

      $('#kelas_id').on('change', function(){
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#kelas_id-error').text('');
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

      $('#tempat_tinggal').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#tempat_tinggal-error').text('');
        }
      });

      $('#tahun_masuk').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#tahun_masuk-error').text('');
        }
      });

      $('#nis_lokal').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 11;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#nis_lokal-error').text('');
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
          url: '{{route('profile-siswa.store')}}',
          data: formData,
          dataType: 'json',
          processData: false,
          contentType: false,
          success: function(response)
          {
              if(response.status == 200){
                
                // Tutup modal add banner dan kosongkan form
                $('#loading-overlay').hide();
                $('#add-modal-profile').modal('hide');
                $('#form-add-profile')[0].reset();

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
              $('#add-modal-profile').modal('hide');
              $('#form-add-profile')[0].reset();

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
      $('#form-add-profile')[0].reset(); // Mereset form
    });
    
    // Menambahkan event listener pada modal
    $('#add-modal-profile').on('hidden.bs.modal', function (e) {
      $('.error-message').text(''); // Menghapus pesan error
      $('#form-add-profile')[0].reset(); // Mereset form
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
