<div class="modal fade" id="edit-hasil-modal" tabindex="-1" role="dialog" aria-labelledby="modal-edit-hasil" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Hasil Test</h5>
        <button type="button" class="btn-close close-modal-tambah" data-bs-dismiss="modal" aria-label="Close" ></button>
        </div>
        <form id="form-edit-hasil" enctype="multipart/form-data">
        <div class="modal-body">

            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Hasil<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="hasil" id="hasil"/>
                    <small class="text-danger mt-2 error-message" id="hasil-error"></small>
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
    $('body').on('click', '#hasil', function() {
        // open modal
        $('#loading-overlay').show();
        setTimeout(() => {
            $('#loading-overlay').hide();
            $('#edit-hasil-modal').modal('show');
        }, 800);
    });


    // simpan data
    $(document).ready(function() {
        $('#form-edit-hasil').on('submit', function(e){
            e.preventDefault();


        $('#hasil').on('input', function(){
            const inputVal = $(this).val();
            const maxLength = 255;
            if (inputVal !=='' || inputVal.length<= maxLength){
            $('#hasil-error').text('');
            }
        });

        var formData = new FormData(this);

        $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
        });

        $('#loading-overlay').show();
        setTimeout(() => {
        $.ajax({
            type: 'POST',
            url: '{{route('fasilitas.store')}}',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){
            if(response.status == 200){
                // tutup modal add banner dan kosongkan form
                $('#loading-overlay').hide();
                $('#edit-hasil-modal').modal('hide');
                $('#form-edit-hasil')[0].reset();

                Swal.fire({
                customClass:{
                    container: 'my-swal',
                },
                title: `Created!`,
                text: `${response.message}`,
                icon: `success`
                });

                //    reload halaman
                setTimeout(function(){
                    location.reload();
                },800)
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

                Swal.fire({
                    customClass :{
                        container : 'my-swal',
                    },
                    title: `${res.statusText}`,
                    text: `${res.responseJson.message}`,
                    icon: 'error'
                });
            }
            $('#loading-overlay').hide();
        },
        })
    }, 900);

    });
    });


    // untuk menghapus pesan error ketika modal tertutup dan menghapus form
    $(document).ready(function(){
    // menambahkan event listener pada tombol close
    $('.close-modal-tambah').on('click', function (e){
        $('.error-message').text('');
        $('#form-edit-hasil')[0].reset();
    });

    // menambahkan event listener pada modal
    $('#edit-hasil-modal').on('hidden.bs.modal', function (e){
        $('.error-message').text(''); //menghapus pesan error
        $('#form-edit-hasil')[0].reset()
    })

    });
</script>
@endsection
