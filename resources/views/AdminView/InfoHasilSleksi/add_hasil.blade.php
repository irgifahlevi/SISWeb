<div class="modal fade" id="add-modal-hasil" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title me-2" id="modalCenterTitle">Hasil seleksi calon siswa</h5>
        <button type="button" class="btn-close close-edit-data" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div id="data-container">
        <form id="edit-form-info" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Kode pendaftaran</label>
                <input type="text" class="form-control" name="kode_pendaftaran" id="kode_pendaftaran" disabled/>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Nama calon siswa</label>
                <input type="text" class="form-control" name="nama_calon_siswa" id="nama_calon_siswa" disabled/>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Wali siswa</label>
                <input type="text" class="form-control" name="wali_calon_siswa" id="wali_calon_siswa" disabled/>
              </div>
            </div>
            <div class="col mb-3">
              <label class="form-label">Membaca AL-Quran<span class="text-danger">*</span></label>
              <select class="form-select" name="membaca" id="membaca">
                <option value="">Pilih nilai</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
              <small class="text-danger mt-2 error-message" id="membaca-error"></small>
            </div>
            <div class="col mb-3">
              <label class="form-label">Penulisan bahasa arab<span class="text-danger">*</span></label>
              <select class="form-select" name="menulis" id="menulis">
                <option value="">Pilih nilai</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
              <small class="text-danger mt-2 error-message" id="menulis-error"></small>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>




  $('body').on('click', `#add-hasil-nilai`, function () {
    const code = $(this).data('code');
    const siswa = $(this).data('siswa');
    const wali = $(this).data('wali');
    // kosongkan form
    $('#edit-form-info')[0].reset();
    // tampilkan spinner
    $('#loading-overlay').show();

    
    $('#add-modal-hasil').find('input[name="kode_pendaftaran"]').val(code);
    $('#add-modal-hasil').find('input[name="nama_calon_siswa"]').val(siswa);
    $('#add-modal-hasil').find('input[name="wali_calon_siswa"]').val(wali);


    setTimeout(() => {
      $('#add-modal-hasil').modal('show');

      $('#add-modal-hasil #data-container').hide();

      // sembunyikan spinner
      $('#loading-overlay').hide();

      // tampilkan data pada form
      $('#add-modal-hasil #data-container').show();
    }, 900);

  });

  $(document).ready(function(){
    $('#edit-form-info').on('submit', function(e){
      e.preventDefault();
      // console.log('test');

      const kode_pendaftaran = $('#add-modal-hasil').find('input[name="kode_pendaftaran"]').val();
      const calon_siswa = $('#add-modal-hasil').find('input[name="nama_calon_siswa"]').val();
      const wali_siswa = $('#add-modal-hasil').find('input[name="wali_calon_siswa"]').val();
      // console.log(formData);

      $('#membaca').on('change', function() {
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#membaca-error').text('');
        }
      });

      $('#menulis').on('change', function() {
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#menulis-error').text('');
        }
      });
      
      var formData = new FormData(this);

      formData.append('kode_pendaftaran', kode_pendaftaran);
      formData.append('calon_siswa', calon_siswa);
      formData.append('wali_siswa', wali_siswa);

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('#loading-overlay').show();
      

      //for debug 
      // for (let data of formData.entries()) {
      //   console.log(data[0] + ': ' + data[1]);
      // }

      setTimeout(() => {
      Swal.fire({
        customClass:{
          container: 'my-swal',
        },
        title: 'Apa anda yakin ingin menyimpan data ?',
        text: "Data yang disimpan tidak dapat di ubah kembali",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#696cff',
        cancelButtonColor: '#ff3e1d',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed){
          setTimeout(() => {
            $.ajax({
              type: 'POST',
              url: '{{route('info-sleksi-calon-siswa.store')}}',
              data: formData,
              dataType: 'json',
              processData: false,
              contentType: false,
              success: function(response)
              {
                if(response.status == 200){
                        
                  // Tutup modal add banner dan kosongkan form
                  $('#loading-overlay').hide();
                  $('#add-modal-hasil').modal('hide');
                  $('#edit-form-info')[0].reset();

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
                  $('#add-modal-hasil').modal('hide');
                  $('#edit-form-info')[0].reset();

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
        }
        else {
          $('#loading-overlay').hide();
        }
      });

      //$('#loading-overlay').hide();
    }, 800);
    });
  });




  // untuk menghapus pesan error ketika mmodal tertutup
  $(document).ready(function () {

    // Menambahkan event listener pada tombol close
    $('.close-edit-data').on('click', function (e) {
      $('.error-message').text('');
    });
    
    // Menambahkan event listener pada modal
    $('#add-modal-hasil').on('hidden.bs.modal', function (e) {
      $('.error-message').text('');
    });
  });
</script>