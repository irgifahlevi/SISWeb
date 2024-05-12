<div class="modal fade" id="edit-modal-profile" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title me-2" id="modalCenterTitle">Edit data</h5>
        <button type="button" class="btn-close close-edit-data" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div id="data-container">
        <form id="edit-form-profile" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="row">
              <input type="hidden" name="id" class="form-control" id="id">
              <div class="col mb-3">
                <label class="form-label">Nama lengkap<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkaps"/>
                <small class="text-danger mt-2 error-messages" id="nama_lengkap-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">NIK<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="nik" id="niks"/>
                <small class="text-danger mt-2 error-messages" id="nik-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">No KK<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="no_kk" id="no_kks"/>
                <small class="text-danger mt-2 error-messages" id="no_kk-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">No NISN</label>
                <input type="number" class="form-control" name="no_nisn" id="no_nisns"/>
                <small class="text-danger mt-2 error-messages" id="no_nisn-errors"></small>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label" for="no_telepon">No Telepon</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text">ID (+62)</span>
                    <input type="tel" id="no_telepons" name="no_telepon" class="form-control phone" oninput="formatPhoneNumber(this)"/>
                  </div>
                  <small class="text-danger mt-2 error-messages" id="no_telepon-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">Jenis kelamin<span class="text-danger">*</span></label>
                <select class="form-select" name="jenis_kelamin_id" id="jenis_kelamin_ids">
                  <option value="">Pilih jenis kelamin</option>
                </select>
                <small class="text-danger mt-2 error-messages" id="jenis_kelamin_id-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">Kelas<span class="text-danger">*</span></label>
                <select class="form-select" name="kelas_id" id="kelas_ids">
                  <option value="">Pilih kelas</option>
                </select>
                <small class="text-danger mt-2 error-messages" id="kelas_id-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">Tempat lahir<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahirs"/>
                <small class="text-danger mt-2 error-messages" id="tempat_lahir-errors"></small>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Tanggal lahir<span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahirs"/>
                <small class="text-danger mt-2 error-messages" id="tanggal_lahir-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">Agama<span class="text-danger">*</span></label>
                <select class="form-select" name="agama" id="agamas">
                  <option value="">Pilih agama</option>
                  <option value="Islam">Islam</option>
                </select>
                <small class="text-danger mt-2 error-messages" id="agama-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">Kelurahan</label>
                <input type="text" class="form-control" name="kelurahan" id="kelurahans"/>
                <small class="text-danger mt-2 error-messages" id="kelurahan-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">Kecamatan</label>
                <input type="text" class="form-control" name="kecamatan" id="kecamatans"/>
                <small class="text-danger mt-2 error-messages" id="kecamatan-errors"></small>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Kota</label>
                <input type="text" class="form-control" name="kota" id="kotas"/>
                <small class="text-danger mt-2 error-messages" id="kota-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">Kode POS</label>
                <input type="text" class="form-control" name="kode_pos" id="kode_poss"/>
                <small class="text-danger mt-2 error-messages" id="kode_pos-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">Tempat tinggal</label>
                <input type="text" class="form-control" name="tempat_tinggal" id="tempat_tinggals"/>
                <small class="text-danger mt-2 error-messages" id="tempat_tinggal-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">Tahun masuk<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="tahun_masuk" id="tahun_masuks"/>
                <small class="text-danger mt-2 error-messages" id="tahun_masuk-errors"></small>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Nis lokal<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="nis_lokal" id="nis_lokals"/>
                <small class="text-danger mt-2 error-messages" id="nis_lokal-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">Anak ke<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="anak_ke" id="anak_kes"/>
                <small class="text-danger mt-2 error-messages" id="anak_ke-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">Jumlah saudara<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="jumlah_saudara" id="jumlah_saudaras"/>
                <small class="text-danger mt-2 error-messages" id="jumlah_saudara-errors"></small>
              </div>
              <div class="col mb-3">
                <input type="hidden" class="form-control"/>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Alamat<span class="text-danger">*</span></label>
                <textarea class="form-control" name="alamat" id="alamats" rows="3"></textarea>
                <small class="text-danger mt-2 error-messages" id="alamat-errors"></small>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>

function getDataInfo(data)
  {
    $.ajax({
    url: '{{route('data.jenis.kelamin')}}',
    method: 'GET',
    dataType: 'json',
      success: function(response) {
        // console.log(response);
        if(response.status == 200){
          let dataJenisKelamin = response.data;

          // Tambahkan opsi pada select jenis kelamin
          $('#edit-modal-profile #jenis_kelamin_ids').html('');
          $('#edit-modal-profile #jenis_kelamin_ids').append(`<option value="">Pilih jenis kelamin</option>`);
          dataJenisKelamin.forEach(function(kelamin){
            let selected = '';
            if(kelamin.id == data.jenis_kelamin_id){
              selected = 'selected';
            }
            $('#edit-modal-profile #jenis_kelamin_ids').append(`<option value="${kelamin.id}" ${selected}>${kelamin.jenis_kelamin}</option>`);
          });
        }
      },
      error: function(response){
        console.log(response);
      }
    });

    $.ajax({
    url: '{{route('data.kelas')}}',
    method: 'GET',
    dataType: 'json',
      success: function(response) {
        // console.log(response);
        if(response.status == 200){
          let dataKelas = response.data;

          // Tambahkan opsi pada select jenis kelamin
          $('#edit-modal-profile #kelas_ids').html('');
          $('#edit-modal-profile #kelas_ids').append(`<option value="">Pilih kelas</option>`);
          dataKelas.forEach(function(kel){
            let selected = '';
            if(kel.id == data.kelas_id){
              selected = 'selected';
            }
            $('#edit-modal-profile #kelas_ids').append(`<option value="${kel.id}" ${selected}>${kel.kelas}</option>`);
          });

          $('#edit-modal-profile').modal('show');
          $('#edit-modal-profile #data-container').hide();      
          // sembunyikan spinner
          $('#loading-overlay').hide();   
          // tampilkan data pada form
          $('#edit-modal-profile #data-container').show();
        }
      },
      error: function(response){
        console.log(response);
      }
    });
  }


  $('body').on('click', `#edit-siswa`, function () {
    var id = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
    // id = 11;
    // kosongkan form
    $('#edit-form-profile')[0].reset();
    // tampilkan spinner
    $('#loading-overlay').show();


    setTimeout(() => {
      $.ajax({
      url: `profile-siswa/${id}`,
      method: 'GET',
      dataType: 'json',
      success: function (response) {
        if(response.status == 200) {
          let data = response.data;
          getDataInfo(data);

          $('#edit-modal-profile').find('input[name="id"]').val(data.id);
          $('#edit-modal-profile').find('input[name="nama_lengkap"]').val(data.nama_lengkap);
          $('#edit-modal-profile').find('input[name="nik"]').val(data.nik);
          $('#edit-modal-profile').find('input[name="no_kk"]').val(data.no_kk);
          $('#edit-modal-profile').find('input[name="no_nisn"]').val(data.no_nisn);
          $('#edit-modal-profile').find('input[name="no_telepon"]').val(data.no_telepon);
          $('#edit-modal-profile').find('input[name="tempat_lahir"]').val(data.tempat_lahir);
          $('#edit-modal-profile').find('input[name="tanggal_lahir"]').val(data.tanggal_lahir);
          $('#edit-modal-profile').find('select[name="agama"]').val(data.agama);
          $('#edit-modal-profile').find('textarea[name="alamat"]').val(data.alamat);
          $('#edit-modal-profile').find('input[name="kelurahan"]').val(data.kelurahan);
          $('#edit-modal-profile').find('input[name="kecamatan"]').val(data.kecamatan);
          $('#edit-modal-profile').find('input[name="kota"]').val(data.kota);
          $('#edit-modal-profile').find('input[name="kode_pos"]').val(data.kode_pos);
          $('#edit-modal-profile').find('input[name="tempat_tinggal"]').val(data.tempat_tinggal);
          $('#edit-modal-profile').find('input[name="tahun_masuk"]').val(data.tahun_masuk);
          $('#edit-modal-profile').find('input[name="nis_lokal"]').val(data.nis_lokal);
          $('#edit-modal-profile').find('input[name="anak_ke"]').val(data.anak_ke);
          $('#edit-modal-profile').find('input[name="jumlah_saudara"]').val(data.jumlah_saudara);
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

  $(document).ready(function(){
    $('#edit-form-profile').on('submit', function(e){
      e.preventDefault();
      // console.log('test');
      const id = $('#edit-modal-profile').find('input[name="id"]').val();
      var nama_lengkap = $('#edit-modal-profile').find('input[name="nama_lengkap"]').val();
      var nik = $('#edit-modal-profile').find('input[name="nik"]').val();
      var no_kk = $('#edit-modal-profile').find('input[name="no_kk"]').val();
      var no_nisn = $('#edit-modal-profile').find('input[name="no_nisn"]').val();
      var no_telepon = $('#edit-modal-profile').find('input[name="no_telepon"]').val();
      var jenis_kelamin_id = $('#edit-modal-profile').find('select[name="jenis_kelamin_id"]').val();
      var kelas_id = $('#edit-modal-profile').find('select[name="kelas_id"]').val();
      var tempat_lahir = $('#edit-modal-profile').find('input[name="tempat_lahir"]').val();
      var tanggal_lahir = $('#edit-modal-profile').find('input[name="tanggal_lahir"]').val();
      var agama = $('#edit-modal-profile').find('select[name="agama"]').val();
      var alamat = $('#edit-modal-profile').find('textarea[name="alamat"]').val();
      var kelurahan = $('#edit-modal-profile').find('input[name="kelurahan"]').val();
      var kecamatan = $('#edit-modal-profile').find('input[name="kecamatan"]').val();
      var kota = $('#edit-modal-profile').find('input[name="kota"]').val();
      var kode_pos = $('#edit-modal-profile').find('input[name="kode_pos"]').val();
      var tempat_tinggal = $('#edit-modal-profile').find('input[name="tempat_tinggal"]').val();
      var tahun_masuk = $('#edit-modal-profile').find('input[name="tahun_masuk"]').val();
      var nis_lokal = $('#edit-modal-profile').find('input[name="nis_lokal"]').val();
      var anak_ke = $('#edit-modal-profile').find('input[name="anak_ke"]').val();
      var jumlah_saudara = $('#edit-modal-profile').find('input[name="jumlah_saudara"]').val();

      const formData = new FormData();

      formData.append('_method', 'PUT'); // formData gak fungsi di method PUT
      formData.append('id', id);
      formData.append('nama_lengkap', nama_lengkap);
      formData.append('nik', nik);
      formData.append('no_kk', no_kk);
      formData.append('no_nisn', no_nisn);
      formData.append('no_telepon', no_telepon);
      formData.append('jenis_kelamin_id', jenis_kelamin_id);
      formData.append('kelas_id', kelas_id);
      formData.append('tempat_lahir', tempat_lahir);
      formData.append('tanggal_lahir', tanggal_lahir);
      formData.append('agama', agama);
      formData.append('alamat', alamat);
      formData.append('kelurahan', kelurahan);
      formData.append('kecamatan', kecamatan);
      formData.append('kota', kota);
      formData.append('kode_pos', kode_pos);
      formData.append('tempat_tinggal', tempat_tinggal);
      formData.append('tahun_masuk', tahun_masuk);
      formData.append('nis_lokal', nis_lokal);
      formData.append('anak_ke', anak_ke);
      formData.append('jumlah_saudara', jumlah_saudara);

      // console.log(formData);

      $('#nama_lengkaps').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 100;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#nama_lengkap-errors').text('');
        }
      });

      $('#niks').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#nik-errors').text('');
        }
      });

      $('#no_kks').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#no_kk-errors').text('');
        }
      });

      $('#no_nisns').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#no_nisn-errors').text('');
        }
      });

      $('#no_telepons').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#no_telepon-errors').text('');
        }
      });

      $('#jenis_kelamin_ids').on('change', function(){
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#jenis_kelamin_id-errors').text('');
        }
      });

      $('#kelas_ids').on('change', function(){
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#kelas_id-errors').text('');
        }
      });

      $('#tempat_lahirs').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 200;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#tempat_lahir-errors').text('');
        }
      });

      $('#tanggal_lahirs').on('change', function() {
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#tanggal_lahir-errors').text('');
        }
      });

      $('#agamas').on('change', function() {
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#agama-errors').text('');
        }
      });

      $('#alamats').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 255;
        if (inputVal !== '' || inputVal.length <= maxLength) {
          $('#alamat-errors').text('');
        }
      });

      $('#kelurahans').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#kelurahan-errors').text('');
        }
      });

      $('#kecamatans').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#kecamatan-errors').text('');
        }
      });

      $('#kotas').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#kota-errors').text('');
        }
      });

      $('#kode_poss').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#kode_pos-errors').text('');
        }
      });

      $('#tempat_tinggals').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#tempat_tinggal-errors').text('');
        }
      });

      $('#tahun_masuks').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#tahun_masuk-errors').text('');
        }
      });

      $('#nis_lokals').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 11;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#nis_lokal-errors').text('');
        }
      });

      $('#anak_kes').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 4;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#anak_ke-errors').text('');
        }
      });

      $('#jumlah_saudaras').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 4;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#jumlah_saudara-errors').text('');
        }
      });
      

      $('#loading-overlay').show();
      
      setTimeout(() => {
        $.ajax({
          url: '{{ route('profile-siswa.update', ':id') }}'.replace(':id', id),
          type: 'POST',
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: formData,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response){
            if(response.status == 200){
                // Tutup modal edit banner dan reset form
                $('#edit-modal-profile').modal('hide');
                $('#edit-form-profile')[0].reset();
                $('#loading-overlay').hide();

                Swal.fire({
                  customClass: {
                    container: 'my-swal',
                  },
                  title: 'Updated!',
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
                $('#' + key + '-errors').text(errorMessage);
              }
            }
            if(response.status == 500){
              var res = response;
              //console.log(res);
              
              $('#edit-modal-profile').modal('hide');
              $('#edit-form-profile')[0].reset();
              $('#loading-overlay').hide();

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




  // untuk menghapus pesan error ketika mmodal tertutup
  $(document).ready(function () {

    // Menambahkan event listener pada tombol close
    $('.close-edit-data').on('click', function (e) {
      $('.error-messages').text('');
    });
    
    // Menambahkan event listener pada modal
    $('#edit-modal-profile').on('hidden.bs.modal', function (e) {
      $('.error-messages').text('');
    });
  });
</script>