<div class="modal fade" id="add-modal-pendidik" tabindex="-1" role="dialog" aria-labelledby="modal-add" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Tambah data</h5>
        <button type="button" class="btn-close close-modal-tambah" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <form id="form-add-pendidik" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Nama lengkap<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap"/>
              <small class="text-danger mt-2 error-message" id="nama_lengkap-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">NIP</label>
              <input type="number" class="form-control" name="nip" id="nip"/>
              <small class="text-danger mt-2 error-message" id="nip-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">No NUPTK</label>
              <input type="number" class="form-control" name="no_nuptk" id="no_nuptk"/>
              <small class="text-danger mt-2 error-message" id="no_nuptk-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Bidang pelajaran</label>
              <input type="text" class="form-control" name="mapel" id="mapel"/>
              <small class="text-danger mt-2 error-message" id="mapel-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Jabatan</label>
              <input type="text" class="form-control" name="jabatan" id="jabatan"/>
              <small class="text-danger mt-2 error-message" id="jabatan-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">NIK<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="nik" id="nik"/>
              <small class="text-danger mt-2 error-message" id="nik-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label" for="no_telepon">No Telepon</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text">ID (+62)</span>
                  <input type="tel" id="no_telepon" name="no_telepon" class="form-control phone" oninput="formatPhoneNumber(this)"/>
                </div>
                <small class="text-danger mt-2 error-message" id="no_telepon-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Pendidikan terakhir<span class="text-danger">*</span></label>
              <select class="form-select" name="pendidikan" id="pendidikan">
                <option value="">Pilih pendidikan</option>
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
              <label class="form-label">Tempat lahir<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"/>
              <small class="text-danger mt-2 error-message" id="tempat_lahir-error"></small>
            </div>
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
          </div>
          <div class="row">
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
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" id="email"/>
              <small class="text-danger mt-2 error-message" id="email-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Foto<span class="text-danger">*</span></label>
              <div class="input-group">
                <input type="file" class="form-control" name="foto" id="foto" />
                <label class="input-group-text">Upload</label>
              </div>
              <small class="text-danger mt-2 error-message" id="foto-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Alamat</label>
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
  $('body').on('click', '#add-pendidik', function () {
    var id = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
    // id = 13;
    // kosongkan form
    $('#form-add-pendidik')[0].reset();
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

            $('#add-modal-pendidik').modal('show');

            $('#add-modal-pendidik #data-container').hide();
            
            // sembunyikan spinner
            $('#loading-overlay').hide();
            
            // tampilkan data pada form
            $('#add-modal-pendidik #data-container').show();
          }
        },
        error: function(response) {
          console.log(response);
        }
      });
    }, 900);
  });

  // Simpan data
  $(document).ready(function(){
    $('#form-add-pendidik').on('submit', function(e){
      e.preventDefault();
      // console.log('test');

      $('#nama_lengkap').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 100;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#nama_lengkap-error').text('');
        }
      });

      $('#nip').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#nip-error').text('');
        }
      });

      $('#no_nuptk').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#no_nuptk-error').text('');
        }
      });

      $('#mapel').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 100;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#mapel-error').text('');
        }
      });

      $('#jabatan').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 100;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#jabatan-error').text('');
        }
      });

      $('#nik').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#nik-error').text('');
        }
      });

      $('#no_telepon').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#no_telepon-error').text('');
        }
      });

      $('#pendidikan').on('change', function(){
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#pendidikan-error').text('');
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
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#email-error').text('');
        }
      });

      $('#foto').on('change', function(){
          const inputVal = $(this).val();
          if(inputVal !== ''){
            $('#foto-error').text('');
          }
      });

      $('#alamat').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 255;
        if (inputVal !== '' || inputVal.length <= maxLength) {
          $('#alamat-error').text('');
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
          url: '{{route('tenaga-pendidik.store')}}',
          data: formData,
          dataType: 'json',
          processData: false,
          contentType: false,
          success: function(response)
          {
              if(response.status == 200){
                
                // Tutup modal add banner dan kosongkan form
                $('#loading-overlay').hide();
                $('#add-modal-pendidik').modal('hide');
                $('#form-add-pendidik')[0].reset();

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
              $('#add-modal-pendidik').modal('hide');
              $('#form-add-pendidik')[0].reset();

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
      $('#form-add-pendidik')[0].reset(); // Mereset form
    });
    
    // Menambahkan event listener pada modal
    $('#add-modal-pendidik').on('hidden.bs.modal', function (e) {
      $('.error-message').text(''); // Menghapus pesan error
      $('#form-add-pendidik')[0].reset(); // Mereset form
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
