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
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Hasil nilai<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="hasil" id="hasil"/>
                <small class="text-danger mt-2 error-message" id="hasil-error"></small>
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
      var id = $('#add-modal-hasil').find('input[name="id"]').val();
      const status = $('#add-modal-hasil').find('select[name="status"]').val();
      const deskripsi = $('#add-modal-hasil').find('textarea[name="deskripsi"]').val();

      const formData = new FormData();

      formData.append('_method', 'PUT'); // formData gak fungsi di method PUT
      formData.append('id', id);
      formData.append('status', status);
      formData.append('deskripsi', deskripsi);

      // console.log(formData);

      $('#statuss').on('change', function(){
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#status-errors').text('');
        }
      });

      $('#deskripsis').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 100;
        if (inputVal !== '' || inputVal.length <= maxLength) {
          $('#deskripsi-errors').text('');
        }
      });
      

      $('#loading-overlay').show();
      
      setTimeout(() => {
        $.ajax({
          url: '{{ route('info-pendaftaran.update', ':id') }}'.replace(':id', id),
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
                $('#add-modal-hasil').modal('hide');
                $('#edit-form-info')[0].reset();
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
              
              $('#add-modal-hasil').modal('hide');
              $('#edit-form-info')[0].reset();
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
    $('#add-modal-hasil').on('hidden.bs.modal', function (e) {
      $('.error-messages').text('');
    });
  });
</script>