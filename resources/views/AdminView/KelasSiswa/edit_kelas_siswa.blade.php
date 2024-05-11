<div class="modal fade" id="edit-modal-kelas" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title me-2" id="modalCenterTitle">Edit account siswa</h5>
        <button type="button" class="btn-close close-edit-data" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div id="data-container">
        <form id="edit-form-kelas" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="id" class="form-control" id="id">
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Kelas<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="kelas" id="kelass"/>
                <small class="text-danger mt-2 error-messages" id="kelas-errors"></small>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Ruangan<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="ruangan" id="ruangans"/>
                <small class="text-danger mt-2 error-messages" id="ruangan-errors"></small>
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




  $('body').on('click', `#edit-kelas`, function () {
    var id = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
    //id = 11;
    // kosongkan form
    $('#edit-form-kelas')[0].reset();
    // tampilkan spinner
    $('#loading-overlay').show();


    setTimeout(() => {
      $.ajax({
      url: `kelas-siswa/${id}`,
      method: 'GET',
      dataType: 'json',
      success: function (response) {
        if(response.status == 200) {
          let data = response.data;

          $('#edit-modal-kelas').modal('show');

          $('#edit-modal-kelas #data-container').hide();
          
          // sembunyikan spinner
          $('#loading-overlay').hide();
          
          // tampilkan data pada form
          $('#edit-modal-kelas #data-container').show();

          $('#edit-modal-kelas').find('input[name="id"]').val(data.id);
          $('#edit-modal-kelas').find('input[name="kelas"]').val(data.kelas);
          $('#edit-modal-kelas').find('input[name="ruangan"]').val(data.ruangan);
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
          $('#edit-form-kelas')[0].reset();
          // sembunyikan spinner
          $('#loading-overlay').hide();
        }
      },
    });
    }, 900);

  });

  $(document).ready(function(){
    $('#edit-form-kelas').on('submit', function(e){
      e.preventDefault();
      // console.log('test');
      const id = $('#edit-modal-kelas').find('input[name="id"]').val();
      const kelas = $('#edit-modal-kelas').find('input[name="kelas"]').val();
      const ruangan = $('#edit-modal-kelas').find('input[name="ruangan"]').val();

      const formData = new FormData();

      formData.append('_method', 'PUT'); // formData gak fungsi di method PUT
      formData.append('id', id);
      formData.append('kelas', kelas);
      formData.append('ruangan', ruangan);

      // console.log(formData);

      $('#kelass').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 10;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#kelas-errors').text('');
        }
      });

      $('#ruangans').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 10;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#ruangan-errors').text('');
        }
      });

      $('#loading-overlay').show();
      
      setTimeout(() => {
        $.ajax({
          url: '{{ route('kelas-siswa.update', ':id') }}'.replace(':id', id),
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
                $('#edit-modal-kelas').modal('hide');
                $('#edit-form-kelas')[0].reset();
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
              
              $('#edit-modal-kelas').modal('hide');
              $('#edit-form-kelas')[0].reset();
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
    $('#edit-modal-kelas').on('hidden.bs.modal', function (e) {
      $('.error-messages').text('');
    });
  });
</script>