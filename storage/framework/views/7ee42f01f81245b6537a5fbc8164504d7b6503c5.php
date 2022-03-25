
<?php $__env->startSection('title', 'Customers'); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('styles'); ?>
<link href="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<?php $__env->stopSection(); ?>


<!-- This customer's page view  -->
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
                        <!-- <li class="breadcrumb-item">
                            <a href="<?php echo e(url('dashboard')); ?>"><i class="ik ik-home"></i></a>
                        </li> -->
                        <li class="breadcrumb-item"><i class="ik ik-home"></i> Customers </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="">
        <div class="card">
            <div class="card-body">
                <form class="mb-0" method="POST" action="<?php echo e(url('full_domainList')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label for="">Customer ico <span class="error">*</span></label>

                            <input type="hidden" value="<?php echo $id; ?>" name="selected_ico" class="selected_ico">
                            <input type="hidden" value="<?php echo $unique_implode; ?>" name="selected_unique[]" class="selected_unique">
                            <input type="hidden" value="<?php echo $sel_quater_implode; ?>" name="selected_quater[]" class="selected_quater">
                            <input type="hidden" value="<?php echo $article_category_imp; ?>" name="selected_artCategory[]" class="selected_artCategory">
                            <input type="hidden" value="<?php echo $channel; ?>" name="selected_channel" class="selected_channel">
                            <input type="hidden" value="<?php echo $year_range; ?>" name="selected_yearId" class="selected_yearId">
                            <input type="hidden" value="<?php echo $monthId; ?>" name="selected_monthId" class="selected_monthId">

                            <select class="form-control select21 mb-2" name="customer_ico" id="customer" required>
                                <!-- <option value="" selected="selected">Customer</option> -->
                                <option></option>
                                <?php $__currentLoopData = $cust_icoList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cust_ico_no): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cust_ico_no->ico); ?>" <?php if ($id == "$cust_ico_no->ico") {
                                                                            echo 'selected';
                                                                        } ?>><?php echo e($cust_ico_no->ico); ?></option>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                        </div>

                        <div class="col-md-4  mb-2">
                            <label for=""> Linked Customers<span class="error" style="display: none;">*</span> (<input type="checkbox" class="refresh_unique">Show without ico ) </label>

                            <select multiple="multiple" placeholder="Linked Customers" name="customer_unique[]" id="customer_unique" class="chosen-select1 form-control customer_unique mb-2" style="width: 100%;">
                                <!-- <option value="" class="linked"> Linked Customers</option> -->
                                <option></option>
                                <?php if ($unique_number) { ?>
                                    <?php foreach ($unique_number as $unique) { ?>
                                        <option value="<?php echo $unique ?>" <?php //if ($unique == $cust_uniqueList->toArray()->cust_no_unique) {
                                                                                echo 'selected';
                                                                                //  }
                                                                                ?>> <?php echo $unique ?> </option>
                                    <?php } ?>
                                <?php } else { ?>
                                <?php } ?>
                            </select>

                        </div>
                        <div class="col-md-4  mb-2">
                            <label for="">Article Category</label>
                            <select multiple="multiple" class="form-control category mb-2" name="category[]">
                                <option></option>

                                <?php if ($article_category) {

                                ?>
                                    <option <?php
                                            foreach ($article_category as $at) {
                                                if ($at == "DRY FOOD") {
                                                    echo "selected";
                                                }
                                            }
                                            ?> value="DRY FOOD">DRY FOOD</option>

                                    <option <?php
                                            foreach ($article_category as $at) {
                                                if ($at == "FRESH FOOD") {
                                                    echo "selected";
                                                }
                                            }
                                            ?> value="FRESH FOOD">FRESH FOOD</option>

                                    <option <?php
                                            foreach ($article_category as $at) {
                                                if ($at == "NONFOOD") {
                                                    echo "selected";
                                                }
                                            }
                                            ?> value="NONFOOD">NONFOOD</option>

                                    <option <?php
                                            foreach ($article_category as $at) {
                                                if ($at == "ULTRA FRESH FOOD") {
                                                    echo "selected";
                                                }
                                            }
                                            ?> value="ULTRA FRESH FOOD">ULTRA FRESH FOOD</option>

                                <?php } else { ?>
                                    <?php if($catmanager_groupList): ?>
                                    <?php $__currentLoopData = $catmanager_groupList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if ($article_category == $category->catmanager_group) {
                                                echo "selected";
                                            } ?> value="<?php echo $category->catmanager_group; ?>"><?php echo e($category->catmanager_group); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Channel Type</label>
                            <select class="form-control select2" name="channel">
                                <option selected="selected" value=""> Type of channel</option>
                                <option <?php if ($channel_type == "C&C") {
                                            echo "selected";
                                        } ?> value="C&C">Cash & Carry</option>
                                <option <?php if ($channel_type == "Delivery") {
                                            echo "selected";
                                        } ?> value="Delivery">FSD</option>
                                <option <?php if ($channel_type == "both") {
                                            echo "selected";
                                        } ?> value="both">Both</option>
                            </select>
                        </div>

                        <div class="col-md-4 year_column">
                            <label for="">Year id</label>
                            <div class="yearRange_div" style="display: inline-flex;">
                                <input type='text' class="year_id form-control from_year" name="from_year" format="yyyy" placeholder="From Year (yyyy)" <?php if ($from_year) {  ?> value="<?php echo $from_year; ?>" <?php  } ?> style="width:48%">
                                <span class="year_dash">-</span>
                                <input type='text' class="year_id form-control to_year" name="to_year" placeholder="To Year (yyyy)" <?php if ($to_year) {  ?> value="<?php echo $to_year; ?>" <?php  } ?> style="width:48%">
                            </div>
                            <div id="year_err" style="color:red;display: none;">Zvolené obdobie je dlhšie ako 1 rok</div>
                        </div>


                        <div class="col-md-4">
                            <label for="">Month id </label>
                            <input type='month' class="month_id form-control" name="month_id" min="2020-01" max="2022-12" placeholder="Select Month" <?php if ($month_id) {
                                                                                                                                                            echo "value='$month_id'";
                                                                                                                                                        } ?>>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="">Quarter</label>
                            <select class="form-control quater" data-placeholder="Your Placeholder" name="quater[]" id="quater" multiple="multiple">
                                <!-- <option value="" class="linked" id="first_quarter"></option> -->
                                <option></option>
                                <option <?php
                                        if ($quater) {
                                            foreach ($quater as $qt) {
                                                if ($qt == "FQ1") {
                                                    echo "selected";
                                                }
                                            }
                                        } ?> value="FQ1"> FQ1 (Oct-Dec)</option>
                                <option <?php if ($quater) {
                                            foreach ($quater as $qt) {
                                                if ($qt == "FQ2") {
                                                    echo "selected";
                                                }
                                            }
                                        } ?> value="FQ2">FQ2 (Jan-Mar)</option>
                                <option <?php if ($quater) {
                                            foreach ($quater as $qt) {
                                                if ($qt == "FQ3") {
                                                    echo "selected";
                                                }
                                            }
                                        } ?> value="FQ3">FQ3 (Apr-Jun)</option>
                                <option <?php if ($quater) {
                                            foreach ($quater as $qt) {
                                                if ($qt == "FQ4") {
                                                    echo "selected";
                                                }
                                            }
                                        } ?> value="FQ4">FQ4 (Jul-Sep)</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-info show_data"> Show Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <table id="advanced_table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>CATEGORY SALES SHARE</td>
                                    <td>SALES SHARE %</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($catSaleShare)) { ?>
                                    <?php
                                    $totalSale = array();
                                    $cat_array = array();
                                    foreach ($catSaleShare as $key => $value) {  ?>
                                        <tr>
                                            <td> <?php echo $value->catmanager_group; ?></td>
                                            <td> <?php echo round($value->sales_percentage, 2) . "%";   ?> </td>
                                        </tr>

                                    <?php  }  ?>

                                <?php  } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-7">
                        <table id="advanced_table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>FINANCIAL QUARTERS</td>
                                    <td>TOTAL SALES</td>
                                    <td>TOTAL OTI%</td>
                                    <td>INVOICES/MONTH</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($salesOti)) {   ?>
                                    <?php
                                    $avgSales = 0;
                                    $avgOTI = 0;
                                    $avgInvoice_id = 0;

                                    foreach ($salesOti as $key2 => $value2) {  ?>
                                        <tr>
                                            <td><?php echo $value2->Period; ?></td>
                                            <td><?php echo number_format(round($value2->sales, 2)); ?></td>
                                            <td><?php echo round($value2->total_oti_percentage, 2) . "%"; ?></td>
                                            <td><?php if ($value2->invoice_count) {
                                                    echo round($value2->invoice_count, 2);
                                                } else {
                                                    echo "0";
                                                } ?></td>
                                        </tr>
                                <?php }
                                }  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="card">
            <div class="card-body">
                <table id="advanced_table" class="display nowrap final_table table-bordered table" style="width:100%">
                    <thead style="text-align: left;" valign="center">
                        <tr>
                            <!-- <th class="nosort" width="10">
                                    <label class="custom-control custom-checkbox m-0">
                                        <input type="checkbox" class="custom-control-input" id="selectall" name="" value="option2">
                                        <span class="custom-control-label">&nbsp;</span>
                                    </label>
                                </th> -->
                            <th style="display: none;">Id</th>
                            <th>Buy Domain</th>
                            <th>Subsys <br> Art. No.</th>
                            <th>Subsys <br> Art. Name</th>
                            <th>Status</th>
                            <th>Qty of Months <br> With Sales</th>
                            <th>Sales</th>
                            <th>Colli</th>
                            <th>Invoices</th>
                            <th>Sales/Month</th>
                            <th>Colli/Month</th>
                            <th>Invoices/Month</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($final_domainList)) { ?>
                            <?php foreach ($final_domainList as $key => $value) {
                                $rand = rand(1, 5);   ?>
                                <tr>
                                    <!-- <td>
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input select_all_child" id="" name="customer-id" value="">
                                                <span class="custom-control-label">&nbsp;</span>
                                            </label>
                                        </td> -->
                                    <td style="display: none;"> <?php echo e($value->buy_subsys_no); ?> </td>
                                    <td> <?php echo e($value->buy_domain); ?></td>
                                    <td><?php echo e($value->subsys_art_no); ?></td>
                                    <td><?php echo e($value->subsys_art_name); ?></td>
                                    <td><?php echo e($value->status_article); ?></td>
                                    <td><?php echo e($value->qtymonths); ?></td>
                                    <td><?php echo e(number_format(round($value->sales,2))); ?></td>
                                    <td><?php echo e(round($value->colli,2)); ?></td>
                                    <td><?php echo e($value->noofinvoice); ?></td>
                                    <td><?php echo e(round($value->sales_per_month)); ?></td>
                                    <td><?php echo e(round($value->colli_per_month)); ?></td>
                                    <td><?php echo e(round($value->invoices_per_month)); ?></td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>

                    <tfoot style="text-align: left;" valign="center">
                        <tr>
                            <th style="display: none;">Id</th>
                            <th>Buy Domain</th>
                            <th>Subsys <br> Art. No</th>
                            <th>Subsys <br> Art. Name</th>
                            <th>Status</th>
                            <th>Qty of Months <br> With Sales</th>
                            <th>Sales</th>
                            <th>Colli</th>
                            <th>Invoices</th>
                            <th>Sales/Month</th>
                            <th>Colli/Month</th>
                            <th>Invoices/Month</th>

                        </tr>
                    </tfoot>

                </table>
                <div class="card-options text-right mt-5">
                    <button type="button" id="customer-offer" class="btn btn-primary mt-5 mb-2">Go To Offer List</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('script'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- month/year dropdown select Bootstrap js library -->
<script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

<script src="<?php echo e(asset('js/module-js/customers.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\profitability-tool\resources\views/customer/index.blade.php ENDPATH**/ ?>