<div class="modal fade" id="edit-modal-wali" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title me-2" id="modalCenterTitle">Edit data</h5>
        <button type="button" class="btn-close close-edit-data" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div id="data-container">
        <form id="edit-form-wali" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="id" class="form-control" id="id">
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Nama lengkap<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkaps"/>
                <small class="text-danger mt-2 error-messages" id="nama_lengkap-errors"></small>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">NIK<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="nik" id="niks"/>
                <small class="text-danger mt-2 error-messages" id="nik-errors"></small>
              </div>
              <div class="col mb-3" style="max-height: 200px; overflow-y: auto;">
                <label class="form-label">Wali dari<span class="text-danger">*</span></label>
                <select class="form-select" name="siswa_id" id="siswa_ids">
                  <option value="">Pilih siswa</option>
                </select>
                <small class="text-danger mt-2 error-messages" id="siswa_id-errors"></small>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Hubungan status<span class="text-danger">*</span></label>
                <select class="form-select" name="hubungan_status" id="hubungan_statuss">
                  <option value="">Pilih hubungan</option>
                  <option value="Ayah">Ayah</option>
                  <option value="Ibu">Ibu</option>
                  <option value="Kakak">Kakak</option>
                  <option value="Nenek">Nenek</option>
                  <option value="Kakek">Kakek</option>
                </select>
                <small class="text-danger mt-2 error-messages" id="hubungan_status-errors"></small>
              </div>
              <div class="col mb-3">
                <label class="form-label">Pekerjaan<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="pekerjaan" id="pekerjaans"></input>
                <small class="text-danger mt-2 error-messages" id="pekerjaan-errors"></small>
              </div>
            </div>
            <div class="row">
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
              <div class="col mb-3">
                <label class="form-label">Penghasilan<span class="text-danger">*</span></label>
                <input type="text" class="form-control rupiah" name="penghasilan" id="penghasilans"></input>
                <small class="text-danger mt-2 error-messages" id="penghasilan-errors"></small>
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
                <label class="form-label" for="no_telepon">No Telepon</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text">ID (+62)</span>
                    <input type="tel" id="no_telepons" name="no_telepon" class="form-control phone" oninput="formatPhoneNumber(this)"/>
                  </div>
                  <small class="text-danger mt-2 error-messages" id="no_telepon-errors"></small>
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
          $('#edit-modal-wali #jenis_kelamin_ids').html('');
          $('#edit-modal-wali #jenis_kelamin_ids').append(`<option value="">Pilih jenis kelamin</option>`);
          dataJenisKelamin.forEach(function(kelamin){
            let selected = '';
            if(kelamin.id == data.jenis_kelamin_id){
              selected = 'selected';
            }
            $('#edit-modal-wali #jenis_kelamin_ids').append(`<option value="${kelamin.id}" ${selected}>${kelamin.jenis_kelamin}</option>`);
          });
        }
      },
      error: function(response){
        console.log(response);
      }
    });

    $.ajax({
    url: '{{route('data.siswa')}}',
    method: 'GET',
    dataType: 'json',
      success: function(response) {
        // console.log(response);
        if(response.status == 200){
          let dataSiswa = response.data;

          // Tambahkan opsi pada select jenis kelamin
          $('#edit-modal-wali #siswa_ids').html('');
          $('#edit-modal-wali #siswa_ids').append(`<option value="">Pilih siswa</option>`);
          dataSiswa.forEach(function(siswa){
            let selected = '';
            if(siswa.id == data.siswa_id){
              selected = 'selected';
            }
            $('#edit-modal-wali #siswa_ids').append(`<option value="${siswa.id}" ${selected}>${siswa.nama_lengkap}</option>`);
          });

          $('#edit-modal-wali').modal('show');
          $('#edit-modal-wali #data-container').hide();      
          // sembunyikan spinner
          $('#loading-overlay').hide();   
          // tampilkan data pada form
          $('#edit-modal-wali #data-container').show();
        }
      },
      error: function(response){
        console.log(response);
      }
    });
  }


  $('body').on('click', `#edit-wali`, function () {
    var id = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
    // id = 11;
    // kosongkan form
    $('#edit-form-wali')[0].reset();
    // tampilkan spinner
    $('#loading-overlay').show();


    setTimeout(() => {
      $.ajax({
      url: `wali-siswa/${id}`,
      method: 'GET',
      dataType: 'json',
      success: function (response) {
        if(response.status == 200) {
          let data = response.data;
          getDataInfo(data);

          $('#edit-modal-wali').find('input[name="id"]').val(data.id);
          $('#edit-modal-wali').find('input[name="nama_lengkap"]').val(data.nama_lengkap);
          $('#edit-modal-wali').find('input[name="nik"]').val(data.nik);
          $('#edit-modal-wali').find('input[name="no_telepon"]').val(data.no_telepon);
          $('#edit-modal-wali').find('textarea[name="alamat"]').val(data.alamat);
          $('#edit-modal-wali').find('select[name="hubungan_status"]').val(data.hubungan_status);
          $('#edit-modal-wali').find('input[name="pekerjaan"]').val(data.pekerjaan);
          $('#edit-modal-wali').find('input[name="penghasilan"]').val(data.penghasilan);
          $('#edit-modal-wali').find('select[name="pendidikan"]').val(data.pendidikan);
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
          $('#edit-form-wali')[0].reset();
          // sembunyikan spinner
          $('#loading-overlay').hide();
        }
      },
    });
    }, 900);

  });

  $(document).ready(function(){
    $('#edit-form-wali').on('submit', function(e){
      e.preventDefault();
      // console.log('test');
      const id = $('#edit-modal-wali').find('input[name="id"]').val();
      var nama_lengkap = $('#edit-modal-wali').find('input[name="nama_lengkap"]').val();
      var nik = $('#edit-modal-wali').find('input[name="nik"]').val();
      var no_telepon = $('#edit-modal-wali').find('input[name="no_telepon"]').val();
      var alamat = $('#edit-modal-wali').find('textarea[name="alamat"]').val();
      var hubungan_status = $('#edit-modal-wali').find('select[name="hubungan_status"]').val();
      var pekerjaan = $('#edit-modal-wali').find('input[name="pekerjaan"]').val();
      var penghasilan =  $('#edit-modal-wali').find('input[name="penghasilan"]').val();
      var pendidikan = $('#edit-modal-wali').find('select[name="pendidikan"]').val();
      var jenis_kelamin_id = $('#edit-modal-wali').find('select[name="jenis_kelamin_id"]').val();
      var siswa_id = $('#edit-modal-wali').find('select[name="siswa_id"]').val();

      const formData = new FormData();

      formData.append('_method', 'PUT'); // formData gak fungsi di method PUT
      formData.append('id', id);
      formData.append('nama_lengkap', nama_lengkap);
      formData.append('nik', nik);
      formData.append('no_telepon', no_telepon);
      formData.append('alamat', alamat);
      formData.append('hubungan_status', hubungan_status);
      formData.append('pekerjaan', pekerjaan);
      formData.append('penghasilan', penghasilan);
      formData.append('pendidikan', pendidikan);
      formData.append('jenis_kelamin_id', jenis_kelamin_id);
      formData.append('siswa_id', siswa_id);

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

      $('#no_telepons').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 20;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#no_telepon-errors').text('');
        }
      });

      $('#alamats').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 255;
        if (inputVal !== '' || inputVal.length <= maxLength) {
          $('#alamat-errors').text('');
        }
      });

      $('#hubungan_statuss').on('change', function(){
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#hubungan_status-errors').text('');
        }
      });

      $('#pendidikans').on('change', function(){
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#pendidikan-errors').text('');
        }
      });

      $('#penghasilans').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 100;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#penghasilan-errors').text('');
        }
      });

      $('#pekerjaans').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 100;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#pekerjaan-errors').text('');
        }
      });

      $('#jenis_kelamin_ids').on('change', function(){
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#jenis_kelamin_id-errors').text('');
        }
      });

      $('#siswa_ids').on('change', function(){
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#siswa_id-errors').text('');
        }
      });

      $('#loading-overlay').show();
      
      setTimeout(() => {
        $.ajax({
          url: '{{ route('wali-siswa.update', ':id') }}'.replace(':id', id),
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
                $('#edit-modal-wali').modal('hide');
                $('#edit-form-wali')[0].reset();
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
              
              $('#edit-modal-wali').modal('hide');
              $('#edit-form-wali')[0].reset();
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
    $('#edit-modal-wali').on('hidden.bs.modal', function (e) {
      $('.error-messages').text('');
    });
  });
</script>