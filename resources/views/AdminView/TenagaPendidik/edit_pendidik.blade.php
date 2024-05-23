<div class="modal fade" id="edit-modal-pendidik" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title me-2" id="modalCenterTitle">Edit account siswa</h5>
        <button type="button" class="btn-close close-edit-data" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div id="data-container">
        <form id="edit-form-pendidik" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="row">
              <input type="hidden" name="profile_pendidik_id" class="form-control" id="id">
              <input type="hidden" name="tenaga_pendidik_id" class="form-control">
              <div class="col mb-3">
                <label class="form-label">Nama lengkap<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkaps"/>
                <small class="text-danger mt-2 error-messages" id="nama_lengkap-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">NIP</label>
                <input type="number" class="form-control" name="nip" id="nips"/>
                <small class="text-danger mt-2 error-messages" id="nip-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">No NUPTK</label>
                <input type="number" class="form-control" name="no_nuptk" id="no_nuptks"/>
                <small class="text-danger mt-2 error-messages" id="no_nuptk-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">Bidang pelajaran</label>
                <input type="text" class="form-control" name="mapel" id="mapels"/>
                <small class="text-danger mt-2 error-messages" id="mapel-errors"></small>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Jabatan</label>
                <input type="text" class="form-control" name="jabatan" id="jabatans"/>
                <small class="text-danger mt-2 error-messages" id="jabatan-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">NIK<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="nik" id="niks"/>
                <small class="text-danger mt-2 error-messages" id="nik-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label" for="no_telepon">No Telepon</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text">ID (+62)</span>
                    <input type="tel" id="no_telepons" name="no_telepon" class="form-control phone" oninput="formatPhoneNumber(this)"/>
                  </div>
                  <small class="text-danger mt-2 error-messages" id="no_telepon-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">Pendidikan terakhir<span class="text-danger">*</span></label>
                <select class="form-select" name="pendidikan" id="pendidikans">
                  <option value="">Pilih pendidikan</option>
                  <option value="Tidak sekolah">Tidak sekolah</option>
                  <option value="SD">SD</option>
                  <option value="SLTP">SLTP</option>
                  <option value="SLTA">SLTA</option>
                  <option value="S1">S1</option>
                  <option value="S2">S2</option>
                </select>
                <small class="text-danger mt-2 error-messages" id="pendidikan-errors"></small>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Jenis kelamin<span class="text-danger">*</span></label>
                <select class="form-select" name="jenis_kelamin_id" id="jenis_kelamin_ids">
                  <option value="">Pilih jenis kelamin</option>
                </select>
                <small class="text-danger mt-2 error-messages" id="jenis_kelamin_id-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">Tempat lahir<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahirs"/>
                <small class="text-danger mt-2 error-messages" id="tempat_lahir-errors"></small>
              </div>
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
            </div>
            <div class="row">
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
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="emails"/>
                <small class="text-danger mt-2 error-messages" id="email-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">Foto<span class="text-danger">*</span></label>
                <div class="input-group">
                  <input type="file" class="form-control" name="foto" id="fotos" />
                  <label class="input-group-text">Upload</label>
                </div>
                <small class="text-danger mt-2 error-messages" id="foto-errors"></small>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Alamat</label>
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
          $('#edit-modal-pendidik #jenis_kelamin_ids').html('');
          $('#edit-modal-pendidik #jenis_kelamin_ids').append(`<option value="">Pilih jenis kelamin</option>`);
          dataJenisKelamin.forEach(function(kelamin){
            let selected = '';
            if(kelamin.id == data.jenis_kelamin_id){
              selected = 'selected';
            }
            $('#edit-modal-pendidik #jenis_kelamin_ids').append(`<option value="${kelamin.id}" ${selected}>${kelamin.jenis_kelamin}</option>`);
          });

          $('#edit-modal-pendidik').modal('show');
          $('#edit-modal-pendidik #data-container').hide();      
          // sembunyikan spinner
          $('#loading-overlay').hide();   
          // tampilkan data pada form
          $('#edit-modal-pendidik #data-container').show();
        }
      },
      error: function(response){
        console.log(response);
      }
    });
}


  $('body').on('click', `#edit-kelas`, function () {
    var id = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
    //id = 11;
    // kosongkan form
    $('#edit-form-pendidik')[0].reset();
    // tampilkan spinner
    $('#loading-overlay').show();


    setTimeout(() => {
      $.ajax({
      url: `tenaga-pendidik/${id}`,
      method: 'GET',
      dataType: 'json',
      success: function (response) {
        if(response.status == 200) {
          let data = response.data;
          console.log(data);
          getDataInfo(data);

          $('#edit-modal-pendidik').find('input[name="profile_pendidik_id"]').val(data.id);
          $('#edit-modal-pendidik').find('input[name="tenaga_pendidik_id"]').val(data.profile_pendidik.id);
          $('#edit-modal-pendidik').find('input[name="nama_lengkap"]').val(data.profile_pendidik.nama_lengkap);
          $('#edit-modal-pendidik').find('input[name="nip"]').val(data.profile_pendidik.nip);
          $('#edit-modal-pendidik').find('input[name="no_nuptk"]').val(data.profile_pendidik.no_nuptk);
          $('#edit-modal-pendidik').find('input[name="mapel"]').val(data.profile_pendidik.mapel);
          $('#edit-modal-pendidik').find('input[name="jabatan"]').val(data.profile_pendidik.jabatan);
          $('#edit-modal-pendidik').find('input[name="nik"]').val(data.nik);
          $('#edit-modal-pendidik').find('input[name="no_telepon"]').val(data.no_telepon);
          $('#edit-modal-pendidik').find('select[name="pendidikan"]').val(data.pendidikan);
          $('#edit-modal-pendidik').find('input[name="tempat_lahir"]').val(data.tempat_lahir);
          $('#edit-modal-pendidik').find('input[name="tanggal_lahir"]').val(data.tanggal_lahir);
          $('#edit-modal-pendidik').find('select[name="agama"]').val(data.agama);
          $('#edit-modal-pendidik').find('textarea[name="alamat"]').val(data.alamat);
          $('#edit-modal-pendidik').find('input[name="kelurahan"]').val(data.kelurahan);
          $('#edit-modal-pendidik').find('input[name="kecamatan"]').val(data.kecamatan);
          $('#edit-modal-pendidik').find('input[name="kota"]').val(data.kota);
          $('#edit-modal-pendidik').find('input[name="kode_pos"]').val(data.kode_pos);
          $('#edit-modal-pendidik').find('input[name="email"]').val(data.email);
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
          $('#edit-form-pendidik')[0].reset();
          // sembunyikan spinner
          $('#loading-overlay').hide();
        }
      },
    });
    }, 900);

  });

  $(document).ready(function(){
    $('#edit-form-pendidik').on('submit', function(e){
      e.preventDefault();
      // console.log('test');
      const id = $('#edit-modal-pendidik').find('input[name="profile_pendidik_id"]').val();
      const tenaga_pendidik_id = $('#edit-modal-pendidik').find('input[name="tenaga_pendidik_id"]').val();
      const nama_lengkap = $('#edit-modal-pendidik').find('input[name="nama_lengkap"]').val();
      const nip = $('#edit-modal-pendidik').find('input[name="nip"]').val();
      const no_nuptk = $('#edit-modal-pendidik').find('input[name="no_nuptk"]').val();
      const mapel = $('#edit-modal-pendidik').find('input[name="mapel"]').val();
      const jabatan = $('#edit-modal-pendidik').find('input[name="jabatan"]').val();
      const nik = $('#edit-modal-pendidik').find('input[name="nik"]').val();
      const no_telepon = $('#edit-modal-pendidik').find('input[name="no_telepon"]').val();
      const pendidikan = $('#edit-modal-pendidik').find('select[name="pendidikan"]').val();
      const jenis_kelamin_id = $('#edit-modal-pendidik').find('select[name="jenis_kelamin_id"]').val();
      const tempat_lahir = $('#edit-modal-pendidik').find('input[name="tempat_lahir"]').val();
      const tanggal_lahir = $('#edit-modal-pendidik').find('input[name="tanggal_lahir"]').val();
      const agama = $('#edit-modal-pendidik').find('select[name="agama"]').val();
      const alamat = $('#edit-modal-pendidik').find('textarea[name="alamat"]').val();
      const kelurahan = $('#edit-modal-pendidik').find('input[name="kelurahan"]').val();
      const kecamatan = $('#edit-modal-pendidik').find('input[name="kecamatan"]').val();
      const kota = $('#edit-modal-pendidik').find('input[name="kota"]').val();
      const kode_pos = $('#edit-modal-pendidik').find('input[name="kode_pos"]').val();
      const email = $('#edit-modal-pendidik').find('input[name="email"]').val();

      const foto = $('#edit-modal-pendidik').find('input[name="foto"]')[0].files[0];

      const formData = new FormData();

      formData.append('_method', 'PUT'); // formData gak fungsi di method PUT
      formData.append('id', id);
      formData.append('tenaga_pendidik_id', tenaga_pendidik_id);
      formData.append('nama_lengkap', nama_lengkap);
      formData.append('nip', nip);
      formData.append('no_nuptk', no_nuptk);
      formData.append('mapel', mapel);
      formData.append('jabatan', jabatan);
      formData.append('nik', nik);
      formData.append('jenis_kelamin_id', jenis_kelamin_id);
      formData.append('no_telepon', no_telepon);
      formData.append('pendidikan', pendidikan);
      formData.append('tempat_lahir', tempat_lahir);
      formData.append('tanggal_lahir', tanggal_lahir);
      formData.append('agama', agama);
      formData.append('alamat', alamat);
      formData.append('kelurahan', kelurahan);
      formData.append('kecamatan', kecamatan);
      formData.append('kota', kota);
      formData.append('kode_pos', kode_pos);
      formData.append('email', email);

      if(foto !== undefined){
        formData.append('foto', foto);
      }

      // console.log(formData);

      $('#nama_lengkaps').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 100;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#nama_lengkap-errors').text('');
        }
      });

      $('#nips').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#nip-errors').text('');
        }
      });

      $('#no_nuptks').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#no_nuptk-errors').text('');
        }
      });

      $('#mapels').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 100;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#mapel-errors').text('');
        }
      });

      $('#jabatans').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 100;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#jabatan-errors').text('');
        }
      });

      $('#niks').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#nik-errors').text('');
        }
      });

      $('#no_telepons').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#no_telepon-errors').text('');
        }
      });

      $('#pendidikans').on('change', function(){
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#pendidikan-errors').text('');
        }
      });

      $('#jenis_kelamin_ids').on('change', function(){
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#jenis_kelamin_id-errors').text('');
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

      $('#emails').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#email-errors').text('');
        }
      });

      $('#fotos').on('change', function(){
          const inputVal = $(this).val();
          if(inputVal !== ''){
            $('#foto-errors').text('');
          }
      });

      $('#alamats').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 255;
        if (inputVal !== '' || inputVal.length <= maxLength) {
          $('#alamat-errors').text('');
        }
      });

      $('#loading-overlay').show();
      
      setTimeout(() => {
        $.ajax({
          url: '{{ route('tenaga-pendidik.update', ':id') }}'.replace(':id', id),
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
                $('#edit-modal-pendidik').modal('hide');
                $('#edit-form-pendidik')[0].reset();
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
              
              $('#edit-modal-pendidik').modal('hide');
              $('#edit-form-pendidik')[0].reset();
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
    $('#edit-modal-pendidik').on('hidden.bs.modal', function (e) {
      $('.error-messages').text('');
    });
  });
</script>