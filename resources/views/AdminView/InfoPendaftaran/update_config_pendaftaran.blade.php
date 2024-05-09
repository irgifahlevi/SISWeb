<div class="modal fade" id="edit-modal-config" tabindex="-1" role="dialog" aria-labelledby="modal-edit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title me-2" id="modalCenterTitle">Konfigurasi pendaftaran</h5>
        <button type="button" class="btn-close close-edit-data" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <div id="data-container">
        <form id="edit-form-config" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="id" class="form-control" id="id">
            <div class="row">
              <div class="col mb-3">
                  <label class="form-label">Gelombang<span class="text-danger">*</span></label>
                  <select class="form-select" name="gelombang" id="gel">
                      <option value="">Pilih gelombang</option>
                  </select>
                  <small class="text-danger mt-2 error-message" id="query_code-errors"></small>
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

function getData(data)
{
  $.ajax({
    url: '{{route('info.gelombang.pendaftaran')}}',
    method: 'GET',
    dataType: 'json',
      success: function(response) {
        // console.log(response);
        if(response.status == 200){
          let gel = response.data;

          // Tambahkan opsi pada select jenis kelamin
          $('#edit-modal-config #gel').html('');
          $('#edit-modal-config #gel').append(`<option value="">Pilih gelombang</option>`);
          gel.forEach(function(gelList){

            let selected = '';
            if(gelList.gelombang == data.query_code){
              selected = 'selected';
            }
            $('#edit-modal-config #gel').append(`<option value="${gelList.gelombang}" ${selected}>${gelList.gelombang}</option>`);
          });

          $('#edit-modal-config').modal('show');

          $('#edit-modal-config #data-container').hide();
          
          // sembunyikan spinner
          $('#loading-overlay').hide();
          
          // tampilkan data pada form
          $('#edit-modal-config #data-container').show();
        }
      },
      error: function(response){
        console.log(response);
      }
    });
}


$('body').on('click', '#select-gelombang', function(){
    var id = $(this).data('id');
    var key = 'gelombang';
    // kosongkan form
    $('#edit-form-config')[0].reset();
    // tampilkan spinner
    $('#loading-overlay').show();


    setTimeout(() => {
      $.ajax({
      url: `config-pendaftaran/${id}`,
      method: 'GET',
      dataType: 'json',
      success: function (response) {
        if(response.status == 200) {
          let data = response.data;

          getData(data);
          $('#edit-modal-config').find('input[name="id"]').val(data.id);
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
          $('#edit-form-config')[0].reset();
          // sembunyikan spinner
          $('#loading-overlay').hide();
        }
      },
    });
    }, 900);

  });

  $(document).ready(function(){
    $('#edit-form-config').on('submit', function(e){
      e.preventDefault();
      const key = 'gelombang';
      // console.log('test');
      var id = $('#edit-modal-config').find('input[name="id"]').val();
      const query_code = $('#edit-modal-config').find('select[name="gelombang"]').val();

      const formData = new FormData();

      formData.append('_method', 'PUT'); // formData gak fungsi di method PUT
      formData.append('id', id);
      formData.append('query_code', query_code);
      formData.append('key', key);

      // console.log(formData);

      $('#gel').on('change', function(){
        const inputVal = $(this).val();
        if(inputVal !== ''){
          $('#query_code-errors').text('');
        }
      });
      

      $('#loading-overlay').show();
      
      setTimeout(() => {
        $.ajax({
          url: '{{ route('config-pendaftaran.update', ':id') }}'.replace(':id', id),
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
                $('#edit-modal-config').modal('hide');
                $('#edit-form-config')[0].reset();
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
              
              $('#edit-modal-config').modal('hide');
              $('#edit-form-config')[0].reset();
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
      $('.error-message').text('');
    });
    
    // Menambahkan event listener pada modal
    $('#edit-modal-config').on('hidden.bs.modal', function (e) {
      $('.error-message').text('');
    });
  });
</script>