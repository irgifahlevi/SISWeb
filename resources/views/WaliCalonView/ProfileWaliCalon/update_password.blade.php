<div class="modal fade" id="new-modal-password" tabindex="-1" role="dialog" aria-labelledby="modal-edit-password" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title me-2" id="modalCenterTitle">Perbarui password</h5>
        <button type="button" class="btn-close close-edit-" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div id="data-container">
        <form id="new-form-password" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="u_id" class="form-control" id="ids">
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Password baru<span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="password" id="passwords" placeholder="Password baru"/>
                <small class="text-danger mt-2 error-message" id="password-errors"></small>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Konfirmasi password baru<span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmations" placeholder="Password baru"/>
                <small class="text-danger mt-2 error-message" id="password_confirmation-errors"></small>
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
  $('body').on('click', `#edit-password`, function () {
    var id = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
    // id = 13;
    // kosongkan form
    $('#new-form-password')[0].reset();
    // tampilkan spinner
    $('#loading-overlay').show();


    setTimeout(() => {
      $.ajax({
      url: `wali-profile/${id}`,
      method: 'GET',
      dataType: 'json',
      success: function (response) {
        if(response.status == 200) {
          let data = response.data;

          $('#new-modal-password').modal('show');
          $('#new-modal-password #data-container').hide();      
          // sembunyikan spinner
          $('#loading-overlay').hide();   
          // tampilkan data pada form
          $('#new-modal-password #data-container').show();

          $('#new-form-password').find('input[name="u_id"]').val(data.user_id);

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
          $('#new-form-password')[0].reset();
          // sembunyikan spinner
          $('#loading-overlay').hide();
        }
      },
    });
    }, 900);

  });

  $(document).ready(function(){
    $('#new-form-password').on('submit', function(e){
      e.preventDefault();
      // console.log('test');
      var id = $('#new-modal-password').find('input[name="u_id"]').val();
      const password = $('#new-modal-password').find('input[name="password"]').val();
      const password_confirmation = $('#new-modal-password').find('input[name="password_confirmation"]').val();

      const formData = new FormData();

      formData.append('_method', 'POST'); // formData gak fungsi di method PUT
      formData.append('id', id);
      formData.append('password', password);
      formData.append('password_confirmation', password_confirmation);


      // console.log(formData);

      $('#passwords').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 8;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#password-errors').text('');
        }
      });

      $('#password_confirmation').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 8;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#password_confirmation-errors').text('');
        }
      });
      

      $('#loading-overlay').show();
      
      setTimeout(() => {
        $.ajax({
          url: '{{ route('wali.update.passwords', ':id') }}'.replace(':id', id),
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
                $('#new-modal-password').modal('hide');
                $('#new-form-password')[0].reset();
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
              
              $('#new-modal-password').modal('hide');
              $('#new-form-password')[0].reset();
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
    $('.close-edit-').on('click', function (e) {
      $('.error-message').text('');
    });
    
    // Menambahkan event listener pada modal
    $('#new-modal-password').on('hidden.bs.modal', function (e) {
      $('.error-message').text('');
    });
  });
</script>