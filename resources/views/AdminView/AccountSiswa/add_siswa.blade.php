<div class="modal fade" id="add-account-siswa" tabindex="-1" role="dialog" aria-labelledby="modal-add-kategori" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Register akun siswa</h5>
        <button type="button" class="btn-close close-modal-tambah" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <form id="form-register" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Username<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="username" id="username"/>
              <small class="text-danger mt-2 error-message" id="username-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Email<span class="text-danger">*</span></label>
              <input type="email" class="form-control" name="email" id="email"></input>
              <small class="text-danger mt-2 error-message" id="email-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Password<span class="text-danger">*</span></label>
              <input type="password" class="form-control" name="password" id="password"></input>
              <small class="text-danger mt-2 error-message" id="password-error"></small>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>


@section('scripts')
    <script>
      $('body').on('click', '#add-siswa', function () {
        //open modal
        $('#loading-overlay').show();
        setTimeout(() => {
          $('#loading-overlay').hide();
          $('#add-account-siswa').modal('show');
        }, 800);
      });

      // Simpan data
      $(document).ready(function(){
        $('#form-register').on('submit', function(e){
          e.preventDefault();
          // console.log('test');

          $('#username').on('input', function() {
            if ($(this).val() !== '') {
              $('#username-error').text('');
            }
          });
          $('#username').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 255;
              if (inputVal.length <= maxLength) {
                  $('#username-error').text('');
              }
          });

          $('#email').on('input', function() {
            if ($(this).val() !== '') {
              $('#email-error').text('');
            }
          });
          $('#email').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 255;
              if (inputVal.length <= maxLength) {
                  $('#email-error').text('');
              }
          });


          $('#password').on('input', function() {
              if ($(this).val() !== '') {
                  $('#password-error').text('');
              }
          });
          $('#password').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 500;
              if (inputVal.length <= maxLength) {
                  $('#password-error').text('');
              }
          });
          
          var formData = new FormData(this);

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          // for debug 
          // for (let data of formData.entries()) {
          //   console.log(data[0] + ': ' + data[1]);
          // }

          $('#loading-overlay').show();

          setTimeout(() => {
            $.ajax({
              type: 'POST',
              url: '{{route('store.register')}}',
              data: formData,
              dataType: 'json',
              processData: false,
              contentType: false,
              success: function(response)
              {
                  if(response.status == 200){
                    
                    // Tutup modal add banner dan kosongkan form
                    $('#loading-overlay').hide();
                    $('#add-account-siswa').modal('hide');
                    $('#form-register')[0].reset();

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
                    let errors = response.responseJSON.errors;
                    for (let key in errors) {
                      let errorMessage = errors[key].join(', ');
                      $('#' + key + '-error').text(errorMessage);
                    }
                }
                if(response.status == 500){
                  var res = response;
                  //console.log(res);
                  
                  $('#loading-overlay').hide();
                  $('#add-account-siswa').modal('hide');
                  $('#form-register')[0].reset();

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
          $('#form-register')[0].reset(); // Mereset form
        });
        
        // Menambahkan event listener pada modal
        $('#add-kategori').on('hidden.bs.modal', function (e) {
          $('.error-message').text(''); // Menghapus pesan error
          $('#form-register')[0].reset(); // Mereset form
        });
      });
    </script>
@endsection
