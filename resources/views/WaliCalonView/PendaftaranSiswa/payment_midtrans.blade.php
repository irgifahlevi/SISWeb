<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{config('midtrans.midtrans_client_key')}}"></script>
<script>
  // var payButton = document.getElementById('bayar-pendaftaran');
  //     payButton.addEventListener('click', function () {
  //       var snap_token = $(this).data('snap_token');
  //       console.log(snap_token);
  //       // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
  //       //window.snap.pay('TRANSACTION_TOKEN_HERE');
  //       // customer will be redirected after completing payment pop-up
  //     });

  $('body').on('click', `#bayar-pendaftaran`, function () {
    var snap_token = $(this).data('id'); // menangkap ID dari data attribute 'data-id'
    // tampilkan spinner
    $('#loading-overlay').show();
      setTimeout(() => {
        $('#loading-overlay').hide();
        snap.pay(snap_token, {
          onSuccess: function (result) {
            $('#loading-overlay').show();
            location.reload();
          },
          onPending: function (result) {
            $('#loading-overlay').show();
            location.reload();
          },
          onError: function (result) {
            $('#loading-overlay').show();
            location.reload();
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