<div class="modal fade" id="validasi-dokumen" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title me-2" id="modalCenterTitle">Validasi dokumen</h5>
        <button type="button" class="btn-close close-edit-data" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div id="data-container">
        <form id="form-validasi-dokumen" enctype="multipart/form-data">
          <div class="modal-body">
            <img id="images" class="img-fluid mb-3 d-block rounded" src="" alt="Card image cap" />
            <input type="hidden" name="dokumen_id" class="form-control" id="dokumen_id">
            <input type="hidden" name="pendaftaran_id" class="form-control" id="pendaftaran_id">
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Nama dokumen</label>
                <input type="text" class="form-control" name="nama_dokumen" id="nama_dokumen" disabled/>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Status<span class="text-danger">*</span></label>
                <select class="form-select" name="status" id="status">
                    <option value="">Pilih status</option>
                    <option value="valid">Valid</option>
                    <option value="invalid">Invalid</option>
                </select>
                <small class="text-danger mt-2 error-message" id="status-error"></small>
            </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label class="form-label">Catatan</label>
                <textarea class="form-control" name="catatan" id="catatan"></textarea>
                <small class="text-danger mt-2 error-message" id="catatan-error"></small>
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
</div>

<script>




  $('body').on('click', `#validasi`, function () {
    var id = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
    var code = $(this).data('code');
    //id = 11;
    // kosongkan form
    // $('#form-validasi-dokumen')[0].reset();
    // tampilkan spinner
    $('#loading-overlay').show();


    setTimeout(() => {
      $.ajax({
      url: `/admin/dokumen-pendaftaran-siswa/${code}/${id}`,
      method: 'GET',
      dataType: 'json',
      success: function (response) {
        if(response.status == 200) {
          let data = response.data;

          $('#validasi-dokumen').modal('show');

          $('#validasi-dokumen #data-container').hide();

          // sembunyikan spinner
          $('#loading-overlay').hide();

          // tampilkan data pada form
          $('#validasi-dokumen #data-container').show();

          $('#validasi-dokumen').find('input[name="dokumen_id"]').val(data.id);
          $('#validasi-dokumen').find('input[name="pendaftaran_id"]').val(data.pendaftaran_id);
          $('#validasi-dokumen').find('input[name="nama_dokumen"]').val(data.nama_dokumen);

          var imageUrl = "{{ asset('storage/dokument_calon_siswa/') }}" + '/' + data.foto_dokumen;
          $('#validasi-dokumen #images').attr('src', imageUrl);
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
          // $('#form-validasi-dokumen')[0].reset();
          // sembunyikan spinner
          $('#loading-overlay').hide();
        }
      },
    });
    }, 900);

  });


  $(document).ready(function(){
    $('#form-validasi-dokumen').on('submit', function(e){
      e.preventDefault();
       console.log('test');

      const dokumen_id = $('#validasi-dokumen').find('input[name="dokumen_id"]').val();
      const pendaftaran_id = $('#validasi-dokumen').find('input[name="pendaftaran_id"]').val();
     
      // console.log(formData);

      $('#status').on('change', function() {
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#status-error').text('');
        }
      });

      $('#catatan').on('input', function(){
          const inputVal = $(this).val();
          const maxLength = 255;
          if (inputVal !=='' || inputVal.length<= maxLength){
          $('#catatan-error').text('');
        }
      });
      
      var formData = new FormData(this);

      formData.append('dokumen_id', dokumen_id);
      formData.append('pendaftaran_id', pendaftaran_id);

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('#loading-overlay').show();
      

      //for debug 
      // for (let data of formData.entries()) {
      //   console.log(data[0] + ': ' + data[1]);
      // }

      setTimeout(() => {
      Swal.fire({
        customClass:{
          container: 'my-swal',
        },
        title: 'Apa anda yakin ingin menyimpan data ?',
        text: "Data yang disimpan tidak dapat di ubah kembali",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#696cff',
        cancelButtonColor: '#ff3e1d',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed){
          setTimeout(() => {
            $.ajax({
              type: 'POST',
              url: '{{route('dokumen-pendaftaran-siswa.store')}}',
              data: formData,
              dataType: 'json',
              processData: false,
              contentType: false,
              success: function(response)
              {
                if(response.status == 200){
                        
                  // Tutup modal add banner dan kosongkan form
                  $('#loading-overlay').hide();
                  $('#add-modal-hasil').modal('hide');
                  // $('#form-validasi-dokumen')[0].reset();

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
                  $('#add-modal-hasil').modal('hide');
                  // $('#form-validasi-dokumen')[0].reset();

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
        }
        else {
          $('#loading-overlay').hide();
        }
      });

      //$('#loading-overlay').hide();
    }, 800);
    });
  });


  // untuk menghapus pesan error ketika mmodal tertutup
  $(document).ready(function () {

    // Menambahkan event listener pada tombol close
    $('.close-edit-data').on('click', function (e) {
      $('.error-messages').text('');
    });

    // Menambahkan event listener pada modal
    $('#validasi-dokumen').on('hidden.bs.modal', function (e) {
      $('.error-messages').text('');
    });
  });
</script>
