<div class="modal fade" id="add-biaya-modal" tabindex="-1" role="dialog" aria-labelledby="modal-add" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Tambah data</h5>
        <button type="button" class="btn-close close-modal-tambah" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <form id="form-add-biaya" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
                <label class="form-label">Gelombang<span class="text-danger">*</span></label>
                <select class="form-select" name="info_pendaftaran_id" id="info_pendaftaran_id">
                    <option value="">Pilih gelombang</option>
                </select>
                <small class="text-danger mt-2 error-message" id="info_pendaftaran_id-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Nama biaya<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="nama_biaya" id="nama_biaya"/>
              <small class="text-danger mt-2 error-message" id="nama_biaya-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Nominal biaya<span class="text-danger">*</span></label>
              <input type="text" class="form-control rupiah" name="nominal_biaya" id="nominal_biaya"></input>
              <small class="text-danger mt-2 error-message" id="nominal_biaya-error"></small>
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
      $('body').on('click', '#add-biaya', function () {
        //open modal
        $('#loading-overlay').show();
        setTimeout(() => {
          $.ajax({
            url: '{{route('info.gelombang.pendaftaran')}}',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
              // console.log(response);
              if(response.status == 200) {
                var infoGelombang = '<option value="">Pilih gelombang</option>';
                $.each(response.data, function(index, gel) {
                  infoGelombang += '<option value="' + gel.id + '">' + gel.gelombang + '</option>';
                });

                $('#info_pendaftaran_id').html(infoGelombang);

                $('#loading-overlay').hide();
                $('#add-biaya-modal').modal('show');
              }
            }
          });
        }, 800);
      });

      // Simpan data
      $(document).ready(function(){
        $('#form-add-biaya').on('submit', function(e){
          e.preventDefault();
          // console.log('test');

          $('#info_pendaftaran_id').on('change', function(){
            const inputVal = $(this).val();
            if(inputVal !== ''){
              $('#info_pendaftaran_id-error').text('');
            }
          });

          $('#nama_biaya').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 100;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#nama_biaya-error').text('');
            }
          });

          $('#nominal_biaya').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 100;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#nominal_biaya-error').text('');
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
              url: '{{route('biaya-pendaftaran.store')}}',
              data: formData,
              dataType: 'json',
              processData: false,
              contentType: false,
              success: function(response)
              {
                  if(response.status == 200){
                    
                    // Tutup modal add banner dan kosongkan form
                    $('#loading-overlay').hide();
                    $('#add-biaya-modal').modal('hide');
                    $('#form-add-biaya')[0].reset();

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
                  $('#add-biaya-modal').modal('hide');
                  $('#form-add-biaya')[0].reset();

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
          $('#form-add-biaya')[0].reset(); // Mereset form
        });
        
        // Menambahkan event listener pada modal
        $('#add-biaya-modal').on('hidden.bs.modal', function (e) {
          $('.error-message').text(''); // Menghapus pesan error
          $('#form-add-biaya')[0].reset(); // Mereset form
        });
      });
    </script>
@endsection
