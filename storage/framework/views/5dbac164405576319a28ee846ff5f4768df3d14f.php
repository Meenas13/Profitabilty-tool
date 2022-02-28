
<?php $__env->startSection('title', 'Customers'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-user-plus bg-primary"></i>
                    <div class="d-inline">
                        <h5>Customers</h5>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/dashboard"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Customers</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Customer No#</label>
                        <select class="form-control" name="customer" id="customer">
                            <option selected="selected" value="">Customer</option>
                            <option value="106007" <?php if ($id == "106007") {
                                                        echo 'selected';
                                                    } ?>>106007</option>
                            <option value="187373" <?php if ($id == "187373") {
                                                        echo 'selected';
                                                    } ?>>187373</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="">Type Of Item</label>
                        <select class="form-control" name="country">
                            <option selected="selected" value="">Type Of Item</option>
                            <option value="1">Item 1</option>
                            <option value="2">Item 2</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="">Download Data</label>
                        <select class="form-control" name="country">
                            <option selected="selected" value="">Download Data</option>
                            <option value="1">Download 1</option>
                            <option value="2">Download 2</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <table id="advanced_table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>SALES SHARE</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($avgData)) { ?>
                                    <?php foreach ($avgData as $key => $value) { ?>
                                        <tr>
                                            <td><?php echo e($value->catmanager_group); ?></td>
                                            <td><?php echo e($value->Percentage); ?>%</td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-7">
                        <table id="advanced_table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>TOTAL SALES</td>
                                    <td>TOTAL OTI%</td>
                                    <td>INVOICES/MONTH</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($avgData2)) { ?>
                                    <?php
                                    $avgSales = 0;
                                    $avgOTI = 0;
                                    $avgInvoice_id = 0;
                                    foreach ($avgData2 as $key2 => $value2) {

                                        $avgSales = $avgSales + $value2->sales;
                                        $avgOTI = $avgOTI + $value2->oti;
                                        $avgInvoice_id = $avgInvoice_id + $value2->invoice_id;

                                        $Sales = $value2->sales;
                                        $OTI = $value2->oti;
                                        $Invoice_id = $value2->invoice_id;
                                    ?>
                                        <tr>
                                            <td><?php echo e($value2->name); ?></td>
                                            <td><?php echo e($value2->sales); ?></td>
                                            <td><?php echo e($value2->oti); ?>%</td>
                                            <td><?php echo e($value2->invoice_id); ?></td>
                                        </tr>
                                    <?php }  ?>
                                    <tr>
                                        <td>Last 12 Months - Excl Under Avg</td>
                                        <td><?php echo e($avgSales-$Sales); ?></td>
                                        <td><?php echo e($avgOTI-$OTI); ?>%</td>
                                        <td><?php echo e($avgInvoice_id-$Invoice_id); ?></td>
                                    </tr>
                                <?php }  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <table id="advanced_table" class="table  table-bordered">
                        <thead style="text-align: center;" valign="center">
                            <tr>
                                <th class="nosort" width="10">
                                    <label class="custom-control custom-checkbox m-0">
                                        <input type="checkbox" class="custom-control-input" id="selectall" name="" value="option2">
                                        <span class="custom-control-label">&nbsp;</span>
                                    </label>
                                </th>
                                <th>Buy Domain</th>
                                <th>Subsys<br>Art No</th>
                                <th>Subsys<br>Art Name</th>
                                <th>Status</th>
                                <th>Qty<br>of<br>Months<br>With<br>Sales</th>
                                <th>Sales</th>
                                <th>Colli</th>
                                <th>Invoices</th>
                                <th>Sales<br>/<br>Month</th>
                                <th>Colli<br>/<br>Month</th>
                                <th>Invoices<br>/<br>Month</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($data)) { ?>
                                <?php
                                foreach ($data as $key => $value) {
                                    $rand = rand(1, 5);
                                ?>

                                    <tr>
                                        <td>
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input select_all_child" id="" name="customer-id" value="<?php echo e($value->ID); ?>">
                                                <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td>
                                        <td><?php echo e($value->buy_domain_no); ?></td>
                                        <td><?php echo e($value->subsys_art_no); ?></td>
                                        <td><?php echo e($value->article); ?></td>
                                        <td><?php echo e($value->status_article); ?></td>
                                        <td><?php echo e($rand); ?></td>
                                        <td><?php echo e($value->sales); ?></td>
                                        <td><?php echo e($value->colli); ?></td>
                                        <td><?php echo e($value->invoice_id); ?></td>
                                        <td><?php echo e(round($value->sales/$rand)); ?></td>
                                        <td><?php echo e(round($value->colli/$rand)); ?></td>
                                        <td><?php echo e(round($value->invoice_id/$rand)); ?></td>
                                    </tr>
                            <?php }
                            } ?>




                        </tbody>
                    </table>
                    <div class="card-options text-right mt-5">

                        <button type="button" id="customer-offer" class="btn btn-primary mt-5 mb-2">Go To Offer List</button>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<?php $__env->startPush('script'); ?>
<script type="text/javascript">
    $('#customer').on('change', function() {

        var url = "<?php echo e(url('customer?id=')); ?>" + this.value;
        window.location.href = url;
    });

    $("#customer-offer").click(function() {
        var cOfferID = [];
        $(".custom-control-input:checked").each(function() {
            cOfferID.push($(this).val());
        });
        if (cOfferID.length > 0) {
            $('#customer-offer').prop('disabled', true);
            var token =  $('meta[name="_token"]').attr('content');
            $('<form>', {
                "id": "customerOfferFrom",
                "html": '<input type="text" id="cOfferID" name="cOfferID" value="' + cOfferID + '" /> <input type="text" id="token" name="_token" value="' + token + '" />',
                "action": "<?php echo e(route('customer-offer-data')); ?>",
                "method": "POST"
            }).appendTo(document.body).submit();

        }

    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\server\htdocs\profitability-tool\resources\views/customer/index.blade.php ENDPATH**/ ?>