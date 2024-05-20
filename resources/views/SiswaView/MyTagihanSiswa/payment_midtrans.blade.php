<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{config('midtrans.midtrans_client_key')}}"></script>
<script>
  $('body').on('click', `#bayar-tagihan`, function () {
    var snap_token = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
    console.log(snap_token);
    // tampilkan spinner
    $('#loading-overlay').show();
      setTimeout(() => {
        $('#loading-overlay').hide();
        snap.pay(snap_token, {
          onSuccess: function (result) {
            $('#loading-overlay').show();
            setTimeout(function(){
                location.reload();
            }, 800)
          },
          onPending: function (result) {
            $('#loading-overlay').show();
            setTimeout(function(){
                location.reload();
            }, 800)
          },
          onError: function (result) {
            $('#loading-overlay').show();
            setTimeout(function(){
                location.reload();
            }, 800)
          },
          onClose: function (result) {
            $('#loading-overlay').show();
            setTimeout(() => {
              $('#loading-overlay').hide();
              Swal.fire({
                customClass: {
                  container: 'my-swal',
                },
                title: `Canceled Transaction`,
                text: `Payment transaction is closed `,
                icon: 'error'
            });
            }, 900);
          }
        });
      }, 900);

  });
</script>