<!-- Modal Update harga -->
<div class="modal fade" id="editmodal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content bg-secondary">
      <div class="modal-header">
        <h4 class="modal-title">Detail Pesanan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="../proses/pesananpro.php?action=cekout" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="staff_id" value="<?= $id_staff ?>">
            <label for="id_order">Id Order</label>
            <input name="id_order" class="form-control" type="text" id="id_order" value="" readonly>
          </div>
          <div class="form-group">
            <label for="nama_customer">Nama Customer</label>
            <input name="nama_customer" class="form-control" type="text" id="nama_customer" value="" readonly>
          </div>
          <div class="form-group">
            <label for="telp">Telp</label>
            <input name="telp" class="form-control" type="text" id="telp2" value="" readonly>
          </div>
          <div class="form-group">
            <label for="notes">Notes</label>
            <textarea name="notes" id="notes" class="form-control" readonly></textarea>
          </div>
          <div class="form-group">
            <label for="order">Waktu Order</label>
            <input name="order" class="form-control" type="text" id="order" value="" readonly>
          </div>
          <div class="form-group">
            <label for="pickup">Pengambilan Order</label>
            <input name="pickup" class="form-control" type="text" id="pickup" value="" readonly>
          </div>
          <div class="form-group">
            <label for="total">Total</label>
            <input name="total" class="form-control" type="number" id="total" value="" readonly>
          </div>
          <div class="payment">
            <hr>
            <h4 class="modal-title">CheckOut Payment</h4>
            <br>
            <div class="form-group">
              <label for="total2" style="color: green">Total</label>
              <input name="total2" style="color: green" class="form-control" type="number" id="total2" value="" readonly>
            </div>
            <div class="form-group">
              <label for="">Metode Pembayaran</label>
              <select name="tipe_pembayaran" value="" class="form-control" required>
                <option value="">--------Pilih---------</option> 
                  <?php while($row = $data->fetch()): ?>
                    <option value="<?= $row['metode_pembayaran_id']?>"><?= $row['jenis_pembayaran']?></option>
                  <?php endwhile; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary checkout">Check Out</button>
          <button type="button" class="btn btn-danger batal">Cancel</button>
          <button type="submit" class="btn btn-success pay">Pay Now</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <script type="text/javascript">
    $(document).ready(function(){

      $('.payment').hide();
      $('.batal').hide();
      $('.pay').hide();

      $('.checkout').on('click', function(){
        $('.payment').show();
        $('.batal').show();
        $('.pay').show();
        $('.checkout').hide();
      });

      $('.batal').on('click', function(){
        $('.payment').hide();
        $('.batal').hide();
        $('.pay').hide();
        $('.checkout').show();
      });    

      $('.editbtn').on('click', function(){
        $('#editmodal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
          return $(this).text();
        }).get();

        console.log(data);

        $('#id_order').val(data[0]); 
        $('#nama_customer').val(data[1]); 
        $('#telp2').val(data[2]); 
        $('#notes').val(data[3]); 
        $('#order').val(data[4]); 
        $('#pickup').val(data[5]); 
        $('#total').val(data[6]); 
        $('#total2').val(data[7]); 
      });   

    });
  </script>