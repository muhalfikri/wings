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
<div class="card radius shadow">
    <div class="card-header bg-info"></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table display table-bordered table-striped no-wrap datatables" width="100%">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Transaction</th>
                        <th>User</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Item</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($transaksi)) { ?>
                        <?php $no = 1; foreach ($transaksi as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $value['document_code'].' - '.$value['document_number'] ?></td>
                                <td><?= $value['user'] ?></td>
                                <td><?= rupiah($value['total']) ?></td>
                                <td><?= tanggal($value['date']) ?></td>
                                <td><?= item_list($value['document_number']) ?></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->

<script>
	$(document).ready(function() {
        $('.datatables').DataTable();
	});
</script>