<div class="modal fade" id="edit-siswa" tabindex="-1" role="dialog" aria-labelledby="modalEditsiswa" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title me-2" id="modalCenterTitle">Edit account siswa</h5>
        <button type="button" class="btn-close close-edit-siswa" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div id="data-container">
        <form id="edit-form-siswa" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="id" class="form-control" id="id">
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="usernames"/>
                <small class="text-danger mt-2 error-messages" id="username-errors"></small>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="passwords"/>
                <small class="text-danger mt-2 error-messages" id="password-errors"></small>
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




  $('body').on('click', `#edit-siswa-modal`, function () {
    var id = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
    //id = 1;
    // kosongkan form
    $('#edit-form-siswa')[0].reset();
    // tampilkan spinner
    $('#loading-overlay').show();


    setTimeout(() => {
      $.ajax({
      url: `show_account/${id}`,
      method: 'GET',
      dataType: 'json',
      success: function (response) {
        if(response.status == 200) {
          let data = response.data;

          $('#edit-siswa').modal('show');

          $('#edit-siswa #data-container').hide();
          
          // sembunyikan spinner
          $('#loading-overlay').hide();
          
          // tampilkan data pada form
          $('#edit-siswa #data-container').show();

          $('#edit-siswa').find('input[name="id"]').val(data.id);
          $('#edit-siswa').find('input[name="username"]').val(data.username);
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
          $('#edit-form-siswa')[0].reset();
          // sembunyikan spinner
          $('#loading-overlay').hide();
        }
      },
    });
    }, 900);

  });

  $(document).ready(function(){
    $('#edit-form-siswa').on('submit', function(e){
      e.preventDefault();
      // console.log('test');
      const id = $('#edit-siswa').find('input[name="id"]').val();
      const username = $('#edit-siswa').find('input[name="username"]').val();
      const password = $('#edit-siswa').find('input[name="password"]').val();

      const formData = new FormData();

      formData.append('_method', 'POST'); // formData gak fungsi di method PUT
      formData.append('id', id);
      formData.append('username', username);
      formData.append('password', password);

      // console.log(formData);

      $('#usernames').on('input', function() {
        if ($(this).val() !== '') {
          $('#username-errors').text('');
        }

        const inputVal = $(this).val();
        const maxLength = 255;
          if (inputVal.length <= maxLength) {
            $('#username-errors').text('');
          }
      });

      $('#passwords').on('input', function() {
          if ($(this).val() !== '') {
              $('#password-errors').text('');
          }
          const inputVal = $(this).val();
          const maxLength = 500;
            if (inputVal.length <= maxLength) {
                $('#password-errors').text('');
            }
      });
      

      $('#loading-overlay').show();
      
      setTimeout(() => {
        $.ajax({
          url: '{{ route('update.account') }}',
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
                $('#edit-siswa').modal('hide');
                $('#edit-form-siswa')[0].reset();
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
              
              $('#edit-siswa').modal('hide');
              $('#edit-form-siswa')[0].reset();
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
    $('.close-edit-siswa').on('click', function (e) {
      $('.error-messages').text('');
    });
    
    // Menambahkan event listener pada modal
    $('#edit-siswa').on('hidden.bs.modal', function (e) {
      $('.error-messages').text('');
    });
  });
</script>