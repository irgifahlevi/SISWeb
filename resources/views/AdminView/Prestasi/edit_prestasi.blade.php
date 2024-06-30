<div class="modal fade" id="edit-modal-prestasi" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title me-2" id="modalCenterTitle">Edit data</h5>
        <button type="button" class="btn-close close-edit-data" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div id="data-container">
        <form id="edit-form-prestasi" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="id" class="form-control" id="id">
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="titles"/>
                    <small class="text-danger mt-2 error-messages" id="title-errors"></small>
                </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                  <label class="form-label">Nama<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="nama" id="namas"/>
                  <small class="text-danger mt-2 error-messages" id="nama-errors"></small>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                  <label class="form-label">Deskripsi<span class="text-danger">*</span></label>
                  <textarea class="form-control" name="deskripsi" id="deskripsis"></textarea>
                  <small class="text-danger mt-2 error-messages" id="deskripsi-errors"></small>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                  <label class="form-label">Tahun</label>
                  <input type="text" class="form-control" name="tahun" id="tahuns"/>
                  <small class="text-danger mt-2 error-messages" id="tahun-errors"></small>
              </div>
            </div>
            <div class="row">
            <div class="col mb-3">
                <label class="form-label">Gambar</label>
                <div class="input-group">
                <input type="file" class="form-control" name="gambar" id="gambars" />
                <label class="input-group-text">Upload</label>
                </div>
                <small class="text-danger mt-2 error-messages" id="gambar-errors"></small>
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




  $('body').on('click', `#edit-prestasi`, function () {
    var id = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
    //id = 11;
    // kosongkan form
    $('#edit-form-prestasi')[0].reset();
    // tampilkan spinner
    $('#loading-overlay').show();


    setTimeout(() => {
      $.ajax({
      url: `prestasi-sekolah/${id}`,
      method: 'GET',
      dataType: 'json',
      success: function (response) {
        if(response.status == 200) {
          let data = response.data;

          $('#edit-modal-prestasi').modal('show');

          $('#edit-modal-prestasi #data-container').hide();
          
          // sembunyikan spinner
          $('#loading-overlay').hide();
          
          // tampilkan data pada form
          $('#edit-modal-prestasi #data-container').show();

          $('#edit-modal-prestasi').find('input[name="id"]').val(data.id);
          $('#edit-modal-prestasi').find('input[name="title"]').val(data.title);
          $('#edit-modal-prestasi').find('input[name="nama"]').val(data.nama);
          $('#edit-modal-prestasi').find('textarea[name="deskripsi"]').val(data.deskripsi);
          $('#edit-modal-prestasi').find('input[name="tahun"]').val(data.tahun);
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
          $('#edit-form-prestasi')[0].reset();
          // sembunyikan spinner
          $('#loading-overlay').hide();
        }
      },
    });
    }, 900);

  });

  $(document).ready(function(){
    $('#edit-form-prestasi').on('submit', function(e){
      e.preventDefault();
      // console.log('test');
      const id = $('#edit-modal-prestasi').find('input[name="id"]').val();
      const title = $('#edit-modal-prestasi').find('input[name="title"]').val();
      const nama = $('#edit-modal-prestasi').find('input[name="nama"]').val();
      const tahun = $('#edit-modal-prestasi').find('input[name="tahun"]').val();
      const deskripsi = $('#edit-modal-prestasi').find('textarea[name="deskripsi"]').val();
      const gambar = $('#edit-modal-prestasi').find('input[name="gambar"]')[0].files[0];

      const formData = new FormData();

      formData.append('_method', 'PUT'); // formData gak fungsi di method PUT
      formData.append('id', id);
      formData.append('nama', nama);
      formData.append('title', title);
      formData.append('deskripsi', deskripsi);
      formData.append('tahun', tahun);
      if(gambar !== undefined){
        formData.append('gambar', gambar);
      }

      // console.log(formData);

      $('#namas').on('input', function(){
          const inputVal = $(this).val();
          const maxLength = 255;
          if(inputVal !== '' || inputVal <= maxLength){
              $('#nama-errors').text('');
          }
      });

      $('#titles').on('input', function(){
          const inputVal = $(this).val();
          const maxLength = 255;
          if(inputVal !== '' || inputVal <= maxLength){
              $('#title-errors').text('');
          }
      });

      $('#tahuns').on('input', function(){
          const inputVal = $(this).val();
          const maxLength = 4;
          if(inputVal !== '' || inputVal <= maxLength){
              $('#tahun-errors').text('');
          }
      });

      $('#deskripsis').on('input', function(){
          const inputVal = $(this).val();
          const maxLength = 1000;
          if (inputVal !=='' || inputVal.length<= maxLength){
          $('#deskripsi-error').text('');
        }
      });

      $('#gambars').on('change', function(){
        if(inputVal !== ''){
            $('#gambar-errors').text('')
        }
      });

      $('#loading-overlay').show();
      
      setTimeout(() => {
        $.ajax({
          url: '{{ route('prestasi-sekolah.update', ':id') }}'.replace(':id', id),
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
                $('#edit-modal-prestasi').modal('hide');
                $('#edit-form-prestasi')[0].reset();
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
              
              $('#edit-modal-prestasi').modal('hide');
              $('#edit-form-prestasi')[0].reset();
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
    $('#edit-modal-prestasi').on('hidden.bs.modal', function (e) {
      $('.error-messages').text('');
    });
  });
</script>