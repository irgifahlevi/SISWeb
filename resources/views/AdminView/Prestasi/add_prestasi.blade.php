<div class="modal fade" id="add-modal-prestasi" tabindex="-1" role="dialog" aria-labelledby="modal-add-kategori" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Tambah data</h5>
        <button type="button" class="btn-close close-modal-tambah" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <form id="form-add-prestasi" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
              <div class="col mb-3">
                  <label class="form-label">Title</label>
                  <input type="text" class="form-control" name="title" id="title"/>
                  <small class="text-danger mt-2 error-message" id="title-error"></small>
              </div>
          </div>
          <div class="row">
            <div class="col mb-3">
                <label class="form-label">Nama<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama" id="nama"/>
                <small class="text-danger mt-2 error-message" id="nama-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
                <label class="form-label">Deskripsi<span class="text-danger">*</span></label>
                <textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>
                <small class="text-danger mt-2 error-message" id="deskripsi-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
                <label class="form-label">Tahun</label>
                <input type="text" class="form-control" name="tahun" id="tahun"/>
                <small class="text-danger mt-2 error-message" id="tahun-error"></small>
            </div>
          </div>
          <div class="row">
          <div class="col mb-3">
              <label class="form-label">Gambar</label>
              <div class="input-group">
              <input type="file" class="form-control" name="gambar" id="gambar" />
              <label class="input-group-text">Upload</label>
              </div>
              <small class="text-danger mt-2 error-message" id="gambar-error"></small>
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
      $('body').on('click', '#add-prestasi', function () {
        //open modal
        $('#loading-overlay').show();
        setTimeout(() => {
          $('#loading-overlay').hide();
          $('#add-modal-prestasi').modal('show');
        }, 800);
      });

      // Simpan data
      $(document).ready(function(){
        $('#form-add-prestasi').on('submit', function(e){
          e.preventDefault();
          // console.log('test');

          $('#nama').on('input', function(){
              const inputVal = $(this).val();
              const maxLength = 255;
              if(inputVal !== '' || inputVal <= maxLength){
                  $('#nama-error').text('');
              }
          });

          $('#title').on('input', function(){
              const inputVal = $(this).val();
              const maxLength = 255;
              if(inputVal !== '' || inputVal <= maxLength){
                  $('#title-error').text('');
              }
          });

          $('#tahun').on('input', function(){
              const inputVal = $(this).val();
              const maxLength = 4;
              if(inputVal !== '' || inputVal <= maxLength){
                  $('#tahun-error').text('');
              }
          });

          $('#deskripsi').on('input', function(){
              const inputVal = $(this).val();
              const maxLength = 1000;
              if (inputVal !=='' || inputVal.length<= maxLength){
              $('#deskripsi-error').text('');
            }
          });

          $('#gambar').on('change', function(){
            if(inputVal !== ''){
                $('#gambar-error').text('')
            }
          });
          
          var formData = new FormData(this);

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          //for debug 
          // for (let data of formData.entries()) {
          //   console.log(data[0] + ': ' + data[1]);
          // }

          $('#loading-overlay').show();

          setTimeout(() => {
            $.ajax({
              type: 'POST',
              url: '{{route('prestasi-sekolah.store')}}',
              data: formData,
              dataType: 'json',
              processData: false,
              contentType: false,
              success: function(response)
              {
                  if(response.status == 200){
                    
                    // Tutup modal add banner dan kosongkan form
                    $('#loading-overlay').hide();
                    $('#add-modal-prestasi').modal('hide');
                    $('#form-add-prestasi')[0].reset();

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
                  $('#add-modal-prestasi').modal('hide');
                  $('#form-add-prestasi')[0].reset();

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
          $('#form-add-prestasi')[0].reset(); // Mereset form
        });
        
        // Menambahkan event listener pada modal
        $('#add-modal-prestasi').on('hidden.bs.modal', function (e) {
          $('.error-message').text(''); // Menghapus pesan error
          $('#form-add-prestasi')[0].reset(); // Mereset form
        });
      });
    </script>
@endsection
