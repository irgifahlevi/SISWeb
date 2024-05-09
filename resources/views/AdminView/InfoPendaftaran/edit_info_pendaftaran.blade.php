<div class="modal fade" id="edit-modal-info" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title me-2" id="modalCenterTitle">Edit data</h5>
        <button type="button" class="btn-close close-edit-data" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div id="data-container">
        <form id="edit-form-info" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="id" class="form-control" id="id">
            <div class="row">
              <div class="col mb-3">
                  <label class="form-label">Gelombang<span class="text-danger">*</span></label>
                  <select class="form-select" name="gelombang" id="gelombangs" disabled>
                      <option value="">Pilih gelombang</option>
                      <option value="I">I</option>
                      <option value="II">II</option>
                      <option value="III">III</option>
                      <option value="IV">IV</option>
                      <option value="V">V</option>
                  </select>
                  <small class="text-danger mt-2 error-messages" id="gelombang-errors"></small>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                  <label class="form-label">Status<span class="text-danger">*</span></label>
                  <select class="form-select" name="status" id="statuss">
                      <option value="">Pilih status</option>
                      <option value="active">Aktif</option>
                      <option value="inactive">Tidak aktif</option>
                  </select>
                  <small class="text-danger mt-2 error-messages" id="status-errors"></small>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsis"></textarea>
                <small class="text-danger mt-2 error-messages" id="deskripsi-errors"></small>
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




  $('body').on('click', `#edit-info`, function () {
    var id = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
    // id = 11;
    // kosongkan form
    $('#edit-form-info')[0].reset();
    // tampilkan spinner
    $('#loading-overlay').show();


    setTimeout(() => {
      $.ajax({
      url: `info-pendaftaran/${id}`,
      method: 'GET',
      dataType: 'json',
      success: function (response) {
        if(response.status == 200) {
          let data = response.data;

          $('#edit-modal-info').modal('show');

          $('#edit-modal-info #data-container').hide();
          
          // sembunyikan spinner
          $('#loading-overlay').hide();
          
          // tampilkan data pada form
          $('#edit-modal-info #data-container').show();

          $('#edit-modal-info').find('input[name="id"]').val(data.id);
          $('#edit-modal-info').find('select[name="gelombang"]').val(data.gelombang);
          $('#edit-modal-info').find('select[name="status"]').val(data.status);
          $('#edit-modal-info').find('textarea[name="deskripsi"]').val(data.deskripsi);
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
          $('#edit-form-info')[0].reset();
          // sembunyikan spinner
          $('#loading-overlay').hide();
        }
      },
    });
    }, 900);

  });

  $(document).ready(function(){
    $('#edit-form-info').on('submit', function(e){
      e.preventDefault();
      // console.log('test');
      var id = $('#edit-modal-info').find('input[name="id"]').val();
      const status = $('#edit-modal-info').find('select[name="status"]').val();
      const deskripsi = $('#edit-modal-info').find('textarea[name="deskripsi"]').val();

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
                $('#edit-modal-info').modal('hide');
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
              
              $('#edit-modal-info').modal('hide');
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
    $('#edit-modal-info').on('hidden.bs.modal', function (e) {
      $('.error-messages').text('');
    });
  });
</script>