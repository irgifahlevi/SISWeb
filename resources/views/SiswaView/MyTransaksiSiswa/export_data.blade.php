<div class="modal fade" id="add-modal-export" tabindex="-1" role="dialog" aria-labelledby="modal-add-kategori" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Export document</h5>
        <button type="button" class="btn-close close-modal-tambah" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form-add-export" action="{{ route('export.document') }}" method="POST" target="_blank" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="col mb-3">
            <label class="form-label">Masukan semester tagihan</label>
            <select class="form-select" name="semester">
                <option value="ganjil">Ganjil</option>
                <option value="genap">Genap</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Export</button>
        </div>
      </form>
    </div>
  </div>
</div>

@section('scripts')
<script>
  $(document).ready(function(){
    $('body').on('click', '#export-data', function () {
      $('#loading-overlay').show();
      setTimeout(() => {
        $('#loading-overlay').hide();
        $('#add-modal-export').modal('show');
      }, 800);
    });

    // untuk menghapus pesan error ketika modal tertutup dan menghapus form
    $('.close-modal-tambah').on('click', function () {
      $('#form-add-export')[0].reset();
    });
    
    $('#add-modal-export').on('hidden.bs.modal', function () {
      $('#form-add-export')[0].reset();
    });
  });
</script>
@endsection
