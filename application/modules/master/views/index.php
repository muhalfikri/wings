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
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Currency</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Dimension</th>
                        <th>Unit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($product)) { ?>
                        <?php $no = 1; foreach ($product as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $value['product_code'] ?></td>
                                <td><?= $value['product_name'] ?></td>
                                <td><?= $value['currency'] ?></td>
                                <td><?= rupiah($value['price']) ?></td>
                                <td><?= $value['discount'].'%' ?></td>
                                <td><?= $value['dimension'] ?></td>
                                <td><?= $value['unit'] ?></td>
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