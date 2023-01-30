<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-lg-6 align-self-center">
        <h4 class="text-themecolor"><?= $title; ?></h4>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- table responsive -->
<div class="row">
    <div class="col-md-7">
        <div class="card radius shadow">
            <div class="card-header bg-info text-white">List Product</div>
            <div class="card-body">
                <table class="table table-bordered table-hover datatables" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center" width="10%">No</th>
                            <th>Item</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($produk)) { ?>
                            <?php $no = 1; foreach ($produk as $key => $value) { ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td>
                                        <a href="#" id="detail" data-id="<?= $value['id']; ?>">
                                            <strong><?= $value['product_name']; ?></strong>
                                        </a>
                                        <br> 
                                        <?php if ($value['discount'] != 0) { ?>
                                            <small style="text-decoration: line-through; color: red"><?= rupiah($value['price']); ?></small>
                                            <br>
                                        <?php } ?>
                                        <strong>
                                            <?php 
                                                $price = $value['price'];
                                                if ($value['discount'] != 0) {
                                                    $price = $value['price'] - (($value['price'] * $value['discount']) / 100);
                                                } 
                                                echo rupiah($price);
                                            ?>
                                        </strong>
                                    </td>
                                    <td class="text-center" width="10%">
                                        <button class="btn btn-info" id="buy-item" data-id="<?= $value['id']; ?>">BUY</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card radius shadow">
            <div class="card-header bg-info text-white">List Transaction</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" id="table-item">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Pcs</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($transaksi_item)) { ?>
                                <?php foreach ($transaksi_item as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value['product_name'] ?></td>
                                        <td width="20%">
                                            <input type="hidden" id="id_detail" value="<?= $value['id'] ?>">
                                            <input type="number" min="0" id="quantity" style="width: 100%" value="<?= $value['quantity'] ?>">
                                        </td>
                                        <td id="subtotal">
                                            <?= rupiah($value['subtotal']) ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url(); ?>transaksi/hapus_item/<?= $value['id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-right" colspan="2">TOTAL</th>
                                <th colspan="2" id="total"><?= rupiah((!empty($transaksi['total'])) ? $transaksi['total'] : 0 ); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?= base_url(); ?>transaksi/proses_selesai/<?= (!empty($transaksi['document_number'])) ? $transaksi['document_number'] : '' ; ?>" class="btn btn-success btn-block proses-selesai"><i class="fa fa-check"></i> CONFIRM</a>
                <!-- <button class="btn btn-success btn-block" >CONFIRM</button> -->
            </div>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->

<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalLabel">Product Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 id="nama_produk">-</h4>
                <small style="text-decoration: line-through" id="diskon"></small>
                <p id="harga">Rp 13.000</p>
                Dimension  : <span id="dimensi"></span>
                <br>
                Price Unit : <span id="unit"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
	$(document).ready(function() {
        const base_url = '<?= base_url(); ?>';
        $('.datatables').DataTable();

        $(document).on('click', '#detail', function(){
            var id = $(this).attr('data-id');
            $.post(base_url+'transaksi/detail_produk', {id : id}, function(res){
                $('#modal-detail').find('#nama_produk').text(res.product_name);
                $('#modal-detail').find('#diskon').text('');

                var price = res.price;
                if (res.discount !== 0) {
                    $('#modal-detail').find('#diskon').text(formatRupiah(parseInt(res.price)));
                    price = res.price - ((res.price * 10) / 100);
                }

                $('#modal-detail').find('#harga').text(formatRupiah(parseInt(price)));
                $('#modal-detail').find('#dimensi').text(res.dimension);
                $('#modal-detail').find('#unit').text(res.unit);
                $('#modal-detail').modal('show');
            }, 'json');
        });

        $(document).on('click', '#buy-item', function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.post(base_url+'transaksi/buy_item', {id : id}, function(res){
                if (res.status === 'success') {
                    Toast.fire({
                        icon: "success",
                        title: "Item Berhasil ditambahkan."
                    });

                    $('#table-item').load('transaksi #table-item');
                    $('.proses-selesai').attr('href', base_url+'transaksi/proses_selesai/'+res.document_number);
                }
            }, 'json');
        });

        $(document).on('keyup', '#quantity', function(){
            var ele = $(this);
            var id  = ele.closest('tr').find('#id_detail').val();
            var qty = ele.val();
            
            if (qty === '') {
                qty = 0;
            }

            $.post(base_url+'transaksi/change_qty', {id : id, qty : qty}, function(res){
                ele.closest('tr').find('#subtotal').text(formatRupiah(parseInt(res.price)));
                $('#table-item').find('#total').text(formatRupiah(parseInt(res.total)));
            }, 'json');
        });

        $(document).on('click', '.proses-selesai', function(e){
            e.preventDefault();
            var url = $(this).attr('href');

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Ingin mengkonfirmasi Pembelian ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Konfirmasi',
                cancelButtonText: 'Batal'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = url;
                }
            });
        })
	});

    function formatRupiah(x) {
        return 'Rp '+x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

</script>