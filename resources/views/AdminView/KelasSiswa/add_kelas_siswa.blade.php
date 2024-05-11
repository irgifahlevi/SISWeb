<div class="modal fade" id="add-modal-kelas" tabindex="-1" role="dialog" aria-labelledby="modal-add-kategori" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Tambah data</h5>
        <button type="button" class="btn-close close-modal-tambah" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <form id="form-add-kelas" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Kelas<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="kelas" id="kelas"/>
              <small class="text-danger mt-2 error-message" id="kelas-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Ruangan<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="ruangan" id="ruangan"/>
              <small class="text-danger mt-2 error-message" id="ruangan-error"></small>
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


@section('scripts')
    <script>
      $('body').on('click', '#add-kelas', function () {
        //open modal
        $('#loading-overlay').show();
        setTimeout(() => {
          $('#loading-overlay').hide();
          $('#add-modal-kelas').modal('show');
        }, 800);
      });

      // Simpan data
      $(document).ready(function(){
        $('#form-add-kelas').on('submit', function(e){
          e.preventDefault();
          // console.log('test');

          $('#kelas').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 50;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#kelas-error').text('');
            }
          });

          $('#ruangan').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 50;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#ruangan-error').text('');
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
              url: '{{route('kelas-siswa.store')}}',
              data: formData,
              dataType: 'json',
              processData: false,
              contentType: false,
              success: function(response)
              {
                  if(response.status == 200){
                    
                    // Tutup modal add banner dan kosongkan form
                    $('#loading-overlay').hide();
                    $('#add-modal-kelas').modal('hide');
                    $('#form-add-kelas')[0].reset();

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
                  $('#add-modal-kelas').modal('hide');
                  $('#form-add-kelas')[0].reset();

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
          $('#form-add-kelas')[0].reset(); // Mereset form
        });
        
        // Menambahkan event listener pada modal
        $('#add-modal-kelas').on('hidden.bs.modal', function (e) {
          $('.error-message').text(''); // Menghapus pesan error
          $('#form-add-kelas')[0].reset(); // Mereset form
        });
      });
    </script>
@endsection
