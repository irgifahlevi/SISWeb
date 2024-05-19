<div class="modal fade" id="add-modal-tagihan" tabindex="-1" role="dialog" aria-labelledby="modal-add-kategori" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Tambah data</h5>
        <button type="button" class="btn-close close-modal-tambah" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>
      <form id="form-add-tagihan" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Kelas<span class="text-danger">*</span></label>
              <select class="form-select" name="kelas_id" id="kelas_id">
                <option value="">Pilih kelas</option>
              </select>
              <small class="text-danger mt-2 error-message" id="kelas_id-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Nama tagihan<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="nama_tagihan" id="nama_tagihan"/>
              <small class="text-danger mt-2 error-message" id="nama_tagihan-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Tanggal jatuh tempo<span class="text-danger">*</span></label>
              <input type="date" class="form-control" name="jatuh_tempo" id="jatuh_tempo"/>
              <small class="text-danger mt-2 error-message" id="jatuh_tempo-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Kategori tagihan<span class="text-danger">*</span></label>
              <select class="form-select" name="kategori_tagihan" id="kategori_tagihan">
                <option value="">Pilih kategori</option>
                <option value="spp">SPP</option>
                <option value="iuran">Iuran</option>
                <option value="uas">UAS</option>
                <option value="uts">UTS</option>
                <option value="kursus">Kursus</option>
                <option value="buku">Buku</option>
              </select>
              <small class="text-danger mt-2 error-message" id="kategori_tagihan-error"></small>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Nominal tagihan<span class="text-danger">*</span></label>
              <input type="text" class="form-control rupiah" name="nominal_tagihan" id="nominal_tagihan"></input>
              <small class="text-danger mt-2 error-message" id="nominal_tagihan-error"></small>
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
      $('body').on('click', '#add-tagihan', function () {
        //open modal
        $('#loading-overlay').show();
        setTimeout(() => {
          $.ajax({
            url: '{{route('data.kelas.siswa')}}',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                  // console.log(response);
              if(response.status == 200) {

                var dataKelas = '<option value="">Pilih kelas</option>';
                $.each(response.data, function(index, kel) {
                  dataKelas += '<option value="' + kel.id + '">' + kel.kelas + '</option>';
                });

                $('#kelas_id').html(dataKelas);
                
                $('#loading-overlay').hide();
                $('#add-modal-tagihan').modal('show');
              }
            },
            error: function(response) {
              console.log(response);
            }
          });
        }, 800);
      });

      // Simpan data
      $(document).ready(function(){
        $('#form-add-tagihan').on('submit', function(e){
          e.preventDefault();
          // console.log('test');
          $('#kelas_id').on('change', function(){
            const inputVal = $(this).val();
            if(inputVal !== ''){
              $('#kelas_id-error').text('');
            }
          });

          $('#kategori_tagihan').on('change', function(){
            const inputVal = $(this).val();
            if(inputVal !== ''){
              $('#kategori_tagihan-error').text('');
            }
          });

          $('#nama_tagihan').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 100;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#nama_tagihan-error').text('');
            }
          });

          $('#jatuh_tempo').on('change', function() {
            const inputVal = $(this).val();
            if(inputVal !== ''){
              $('#jatuh_tempo-error').text('');
            }
          });

          $('#nominal_tagihan').on('input', function() {
            const inputVal = $(this).val();
            const maxLength = 100;
            if (inputVal !== '' || inputVal <= maxLength) {
              $('#nominal_tagihan-error').text('');
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
              url: '{{route('tagihan-siswa.store')}}',
              data: formData,
              dataType: 'json',
              processData: false,
              contentType: false,
              success: function(response)
              {
                  if(response.status == 200){
                    
                    // Tutup modal add banner dan kosongkan form
                    $('#loading-overlay').hide();
                    $('#add-modal-tagihan').modal('hide');
                    $('#form-add-tagihan')[0].reset();

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
                  $('#add-modal-tagihan').modal('hide');
                  $('#form-add-tagihan')[0].reset();

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
          $('#form-add-tagihan')[0].reset(); // Mereset form
        });
        
        // Menambahkan event listener pada modal
        $('#add-modal-tagihan').on('hidden.bs.modal', function (e) {
          $('.error-message').text(''); // Menghapus pesan error
          $('#form-add-tagihan')[0].reset(); // Mereset form
        });
      });
    </script>
@endsection
