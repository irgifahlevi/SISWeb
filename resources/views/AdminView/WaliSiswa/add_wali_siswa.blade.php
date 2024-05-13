<div class="modal fade" id="add-modal-wali" tabindex="-1" role="dialog" aria-labelledby="modal-add" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Tambah data</h5>
        <button type="button" class="btn-close close-modal-tambah" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <form id="form-add-wali" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Nama lengkap<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap"/>
              <small class="text-danger mt-2 error-message" id="nama_lengkap-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">NIK<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="nik" id="nik"/>
              <small class="text-danger mt-2 error-message" id="nik-error"></small>
            </div>
            <div class="col mb-3" style="max-height: 200px; overflow-y: auto;">
              <label class="form-label">Wali dari<span class="text-danger">*</span></label>
              <select class="form-select" name="siswa_id" id="siswa_id">
                <option value="">Pilih siswa</option>
              </select>
              <small class="text-danger mt-2 error-message" id="siswa_id-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Hubungan status<span class="text-danger">*</span></label>
              <select class="form-select" name="hubungan_status" id="hubungan_status">
                <option value="">Pilih hubungan</option>
                <option value="Ayah">Ayah</option>
                <option value="Ibu">Ibu</option>
                <option value="Kakak">Kakak</option>
                <option value="Nenek">Nenek</option>
                <option value="Kakek">Kakek</option>
              </select>
              <small class="text-danger mt-2 error-message" id="hubungan_status-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Pekerjaan<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="pekerjaan" id="pekerjaan"></input>
              <small class="text-danger mt-2 error-message" id="pekerjaan-error"></small>
            </div>
          </div>
          <div class="row">
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
            <div class="col mb-3">
              <label class="form-label">Penghasilan<span class="text-danger">*</span></label>
              <input type="text" class="form-control rupiah" name="penghasilan" id="penghasilan" placeholder="Penghasilan perbulan"></input>
              <small class="text-danger mt-2 error-message" id="penghasilan-error"></small>
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
              <label class="form-label" for="no_telepon">No Telepon</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text">ID (+62)</span>
                  <input type="tel" id="no_telepon" name="no_telepon" class="form-control phone" oninput="formatPhoneNumber(this)"/>
                </div>
                <small class="text-danger mt-2 error-message" id="no_telepon-error"></small>
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
  $('body').on('click', '#add-wali', function () {
    var id = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
    // id = 13;
    // kosongkan form
    $('#form-add-wali')[0].reset();
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
          }
        },
        error: function(response) {
          console.log(response);
        }
      });
      $.ajax({
        url: '{{route('data.siswa')}}',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
              // console.log(response);
          if(response.status == 200) {

            var dataSiswa = '<option value="">Pilih siswa</option>';
            $.each(response.data, function(index, siswa) {
              dataSiswa += '<option value="' + siswa.id + '">' + siswa.nama_lengkap + '</option>';
            });

            $('#siswa_id').html(dataSiswa);
            $('#add-modal-wali').modal('show');
            $('#add-modal-wali #data-container').hide();
            $('#loading-overlay').hide();
            $('#add-modal-wali #data-container').show();
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
    $('#form-add-wali').on('submit', function(e){
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

      $('#siswa_id').on('change', function(){
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#siswa_id-error').text('');
        }
      });

      $('#pendidikan').on('change', function(){
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#pendidikan-error').text('');
        }
      });

      $('#penghasilan').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 100;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#penghasilan-error').text('');
        }
      });

      $('#pekerjaan').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 100;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#pekerjaan-error').text('');
        }
      });

      $('#jenis_kelamin_id').on('change', function(){
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#jenis_kelamin_id-error').text('');
        }
      });

      $('#hubungan_status').on('change', function(){
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#hubungan_status-error').text('');
        }
      });

      $('#no_telepon').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#no_telepon-error').text('');
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
          url: '{{route('wali-siswa.store')}}',
          data: formData,
          dataType: 'json',
          processData: false,
          contentType: false,
          success: function(response)
          {
              if(response.status == 200){
                
                // Tutup modal add banner dan kosongkan form
                $('#loading-overlay').hide();
                $('#add-modal-wali').modal('hide');
                $('#form-add-wali')[0].reset();

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
              $('#add-modal-wali').modal('hide');
              $('#form-add-wali')[0].reset();

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
      $('#form-add-wali')[0].reset(); // Mereset form
    });
    
    // Menambahkan event listener pada modal
    $('#add-modal-wali').on('hidden.bs.modal', function (e) {
      $('.error-message').text(''); // Menghapus pesan error
      $('#form-add-wali')[0].reset(); // Mereset form
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
