<div class="modal fade" id="edit-modal-galeri" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title me-2" id="modalCenterTitle">Edit Galeri</h5>
          <button type="button" class="btn-close close-edit-data" data-bs-dismiss="modal" aria-label="Close" ></button>
        </div>
        <div id="data-container">
          <form id="edit-form-galeri" enctype="multipart/form-data">
            <div class="modal-body">
              <input type="hidden" name="id" class="form-control" id="id">
              <div class="row">
                <div class="col mb-3">
                  <label class="form-label">Nama Kegiatan<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatans"/>
                  <small class="text-danger mt-2 error-messages" id="title-errors"></small>
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <label class="form-label">Title<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="title" id="titles"/>
                  <small class="text-danger mt-2 error-messages"  id="title-errors"></small>
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <label class="form-label">Deskripsi</label>
                  <textarea class="form-control" name="deskripsi" id="deskripsis"></textarea>
                  <small class="text-danger mt-2 error-messages" id="deskripsi-errors"></small>
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




    $('body').on('click', `#edit-galeri`, function () {
      var id = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
      //id = 11;
      // kosongkan form
      $('#edit-form-galeri')[0].reset();
      // tampilkan spinner
      $('#loading-overlay').show();


      setTimeout(() => {
        $.ajax({
        url: `galeri-content/${id}`,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
          if(response.status == 200) {
            let data = response.data;

            $('#edit-modal-galeri').modal('show');

            $('#edit-modal-galeri #data-container').hide();

            // sembunyikan spinner
            $('#loading-overlay').hide();

            // tampilkan data pada form
            $('#edit-modal-galeri #data-container').show();

            $('#edit-modal-galeri').find('input[name="id"]').val(data.id);
            $('#edit-modal-galeri').find('input[name="nama_kegiatan"]').val(data.nama_kegiatan);
            $('#edit-modal-galeri').find('input[name="title"]').val(data.title);
            $('#edit-modal-galeri').find('textarea[name="deskripsi"]').val(data.deskripsi);
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
            $('#edit-form-galeri')[0].reset();
            // sembunyikan spinner
            $('#loading-overlay').hide();
          }
        },
      });
      }, 900);

    });

    $(document).ready(function(){
      $('#edit-form-galeri').on('submit', function(e){
        e.preventDefault();
        // console.log('test');
        const id = $('#edit-modal-galeri').find('input[name="id"]').val();
        const title = $('#edit-modal-galeri').find('input[name="title"]').val();
        const deskripsi = $('#edit-modal-galeri').find('textarea[name="deskripsi"]').val();
        const gambar = $('#edit-modal-galeri').find('input[name="gambar"]')[0].files[0];

        const formData = new FormData();

        formData.append('_method', 'PUT'); // formData gak fungsi di method PUT
        formData.append('id', id);
        formData.append('nama_kegiatan', nama_kegiatan);
        formData.append('title', title);
        formData.append('deskripsi', deskripsi);
        if(gambar !== undefined){
          formData.append('gambar', gambar);
        }

        // console.log(formData);

        $('#titles').on('input', function() {
          const inputVal = $(this).val();
          const maxLength = 255;
          if (inputVal !== '' || inputVal <= maxLength) {
            $('#title-errors').text('');
          }
        });

        $('#deskripsis').on('input', function() {
          const inputVal = $(this).val();
          const maxLength = 255;
          if (inputVal !== '' || inputVal.length <= maxLength) {
            $('#deskripsi-errors').text('');
          }
        });

        $('#gambars').on('change', function(){
          const inputVal = $(this).val();
          if(inputVal !== ''){
            $('#gambar-errors').text('');
          }
        });


        $('#loading-overlay').show();

        setTimeout(() => {
          $.ajax({
            url: '{{ route('galeri-content.update', ':id') }}'.replace(':id', id),
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
                  $('#edit-modal-galeri').modal('hide');
                  $('#edit-form-galeri')[0].reset();
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

                $('#edit-modal-galeri').modal('hide');
                $('#edit-form-galeri')[0].reset();
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
      $('#edit-modal-galeri').on('hidden.bs.modal', function (e) {
        $('.error-messages').text('');
      });
    });
  </script>
