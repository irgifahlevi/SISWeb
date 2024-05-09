<div class="modal fade" id="edit-modal-biaya" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title me-2" id="modalCenterTitle">Edit data</h5>
        <button type="button" class="btn-close close-edit-data" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div id="data-container">
        <form id="edit-form-biaya" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="id" class="form-control" id="id">
            <div class="row">
              <div class="col mb-3">
                  <label class="form-label">Gelombang<span class="text-danger">*</span></label>
                  <select class="form-select" name="info_pendaftaran_id" id="info_pendaftaran_ids">
                      <option value="">Pilih gelombang</option>
                  </select>
                  <small class="text-danger mt-2 error-messages" id="info_pendaftaran_id-errors"></small>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Nama biaya<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_biaya" id="nama_biayas"/>
                <small class="text-danger mt-2 error-messages" id="nama_biaya-errors"></small>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Nominal biaya<span class="text-danger">*</span></label>
                <input type="text" class="form-control rupiah" name="nominal_biaya" id="nominal_biayas"></input>
                <small class="text-danger mt-2 error-messages" id="nominal_biaya-errors"></small>
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

function getDataInfo(data)
  {
    $.ajax({
    url: '{{route('info.gelombang.pendaftaran')}}',
    method: 'GET',
    dataType: 'json',
      success: function(response) {
        // console.log(response);
        if(response.status == 200){
          let info_pendaftaran = response.data;

          // Tambahkan opsi pada select jenis kelamin
          $('#edit-modal-biaya #info_pendaftaran_ids').html('');
          $('#edit-modal-biaya #info_pendaftaran_ids').append(`<option value="">Pilih gelombang</option>`);
          info_pendaftaran.forEach(function(gel){
            let selected = '';
            if(gel.id == data.info_pendaftaran_id){
              selected = 'selected';
            }
            $('#edit-modal-biaya #info_pendaftaran_ids').append(`<option value="${gel.id}" ${selected}>${gel.gelombang}</option>`);
          });

          $('#edit-modal-biaya').modal('show');
          $('#edit-modal-biaya #data-container').hide();      
          // sembunyikan spinner
          $('#loading-overlay').hide();   
          // tampilkan data pada form
          $('#edit-modal-biaya #data-container').show();
        }
      },
      error: function(response){
        console.log(response);
      }
    });
  }


  $('body').on('click', `#edit-info`, function () {
    var id = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
    // id = 11;
    // kosongkan form
    $('#edit-form-biaya')[0].reset();
    // tampilkan spinner
    $('#loading-overlay').show();


    setTimeout(() => {
      $.ajax({
      url: `biaya-pendaftaran/${id}`,
      method: 'GET',
      dataType: 'json',
      success: function (response) {
        if(response.status == 200) {
          let data = response.data;
          getDataInfo(data);

          $('#edit-modal-biaya').find('input[name="id"]').val(data.id);
          $('#edit-modal-biaya').find('input[name="nama_biaya"]').val(data.nama_biaya);
          $('#edit-modal-biaya').find('input[name="nominal_biaya"]').val(data.nominal_biaya);
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
          $('#edit-form-biaya')[0].reset();
          // sembunyikan spinner
          $('#loading-overlay').hide();
        }
      },
    });
    }, 900);

  });

  $(document).ready(function(){
    $('#edit-form-biaya').on('submit', function(e){
      e.preventDefault();
      // console.log('test');
      var id = $('#edit-modal-biaya').find('input[name="id"]').val();
      var nama_biaya = $('#edit-modal-biaya').find('input[name="nama_biaya"]').val();
      var nominal_biaya = $('#edit-modal-biaya').find('input[name="nominal_biaya"]').val();
      const info_pendaftaran_id = $('#edit-modal-biaya').find('select[name="info_pendaftaran_id"]').val();

      const formData = new FormData();

      formData.append('_method', 'PUT'); // formData gak fungsi di method PUT
      formData.append('id', id);
      formData.append('nama_biaya', nama_biaya);
      formData.append('nominal_biaya', nominal_biaya);
      formData.append('info_pendaftaran_id', info_pendaftaran_id);

      // console.log(formData);

      $('#info_pendaftaran_ids').on('change', function(){
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#info_pendaftaran_id-errors').text('');
        }
      });

      $('#nama_biayas').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 100;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#nama_biaya-errors').text('');
        }
      });

      $('#nominal_biayas').on('input', function() {
        const inputVal = $(this).val();
        const maxLength = 100;
        if (inputVal !== '' || inputVal <= maxLength) {
          $('#nominal_biaya-errors').text('');
        }
      });
      

      $('#loading-overlay').show();
      
      setTimeout(() => {
        $.ajax({
          url: '{{ route('biaya-pendaftaran.update', ':id') }}'.replace(':id', id),
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
                $('#edit-modal-biaya').modal('hide');
                $('#edit-form-biaya')[0].reset();
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
              
              $('#edit-modal-biaya').modal('hide');
              $('#edit-form-biaya')[0].reset();
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
    $('#edit-modal-biaya').on('hidden.bs.modal', function (e) {
      $('.error-messages').text('');
    });
  });
</script>