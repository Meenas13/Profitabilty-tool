
<?php $__env->startSection('title', 'Customers'); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startSection('styles'); ?>
<link href="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<style>
    /* select#quater {
        position: relative;
    }

    select#quater::before {
        position: absolute;
        content: "Select Quarter"
    } */
</style>
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-user-plus bg-blue"></i>
                    <div class="d-inline">
                        <h5>Customers</h5>
                        <!-- This customer's page view  -->
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

    <div class="row">
        <div class="card">
            <div class="card-body">
                <form class="" method="POST" action="<?php echo e(url('full_domainList')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Customer ico <span class="error">*</span></label>

                            <input type="hidden" value="<?php echo $id; ?>" name="selected_ico" class="selected_ico">
                            <input type="hidden" value="<?php echo $unique_implode; ?>" name="selected_unique[]" class="selected_unique">
                            <input type="hidden" value="<?php echo $sel_quater_implode; ?>" name="selected_quater[]" class="selected_quater">

                            <input type="hidden" value="<?php echo $article_category; ?>" name="selected_artCategory" class="selected_artCategory">
                            <input type="hidden" value="<?php echo $channel; ?>" name="selected_channel" class="selected_channel">
                            <input type="hidden" value="<?php echo $year_range; ?>" name="selected_yearId" class="selected_yearId">
                            <input type="hidden" value="<?php echo $monthId; ?>" name="selected_monthId" class="selected_monthId">

                            <select class="form-control select2" name="customer_ico" id="customer" required>
                                <option value="" selected="selected">Customer</option>
                                <?php $__currentLoopData = $cust_icoList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cust_ico_no): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cust_ico_no->ico); ?>" <?php if ($id == "$cust_ico_no->ico") {
                                                                            echo 'selected';
                                                                        } ?>><?php echo e($cust_ico_no->ico); ?></option>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <!-- <option value="106007" <?php if ($id == "106007") {
                                                                echo 'selected';
                                                            } ?>>106007</option>
                            <option value="187373" <?php if ($id == "187373") {
                                                        echo 'selected';
                                                    } ?>>187373</option> -->
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for=""> Linked Customers<span class="error" style="display: none;">*</span> (<input type="checkbox" class="refresh_unique">Show without ico ) </label>
                            <!-- &#8634;  -->
                            <!-- data-placeholder="Begin typing a name to filter..." multiple -->

                            <!-- <select multiple name="customer_unique[]" id="customer_unique" required class="chosen-select1 form-control1 customer_unique" style="width: 100%;">
                                <option selected="selected" value=""> Linked Customers</option> -->
                            <select multiple="multiple" placeholder="Linked Customers" name="customer_unique[]" id="customer_unique" class="chosen-select1 form-control customer_unique" style="width: 100%;">
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
                                    <!-- <option value="" class="linked"> Linked Customers</option> -->
                                <?php } ?>
                            </select>
                            <!-- <select class="form-control customer_unique" name="customer_unique" id="customer_unique" required>
                                <option selected="selected" value=""> Linked Customers</option>
                             
                            </select> -->
                        </div>
                        <div class="col-md-4">
                            <label for="">Article Category</label>
                            <select class="form-control select2" name="category">
                                <option selected="selected" value="">Category of an article</option>
                                <?php if($catmanager_groupList): ?>
                                <?php $__currentLoopData = $catmanager_groupList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if ($article_category_type == $category->catmanager_group) {
                                            echo "selected";
                                        } ?> value="<?php echo $category->catmanager_group; ?>"><?php echo e($category->catmanager_group); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div><br>

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
                        <!-- <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6"> <label for=""> From</label> </div>
                                <div class="col-md-6"> <label for=""> To</label> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type='text' class="form-control" id='filterByDate1' name='filterByDate1' placeholder="From Date">
                                </div>

                                <div class="col-md-6">
                                    <input type='text' class="form-control" id='filterByDate2' name='filterByDate2' placeholder="To Date">
                                </div>
                            </div>
                        </div> -->

                        <div class="col-md-4">
                            <label for="">Year id</label>
                            <div class="yearRange_div" style="display: inline-flex;">
                                <input type='text' class="year_id form-control from_year" name="from_year" format="yyyy" placeholder="From Year (yyyy)" <?php if ($from_year) {  ?> value="<?php echo $from_year; ?>" <?php  } ?> style="width:48%">
                                <span class="year_dash">-</span>
                                <input type='text' class="year_id form-control to_year" name="to_year" placeholder="To Year (yyyy)" <?php if ($to_year) {  ?> value="<?php echo $to_year; ?>" <?php  } ?> style="width:48%">



                                <!-- <input type="text" class="yearpicker from_year" name="from_year" placeholder="From Year (yyyy)">
                                <input type="text" class="yearpicker to_year" name="to_year" placeholder="To Year (yyyy)"> -->

                            </div>
                            <div id="year_err" style="color:red;display: none;">Year gap should be 1 year only</div>
                        </div>


                        <div class="col-md-4">
                            <label for="">Month id </label>
                            <!-- <input type='text' class="month_id form-control" name="month_id" placeholder="Select Month"> -->
                            <input type='month' class="month_id form-control" name="month_id" min="2020-01" max="2022-12" placeholder="Select Month" <?php if ($month_id) {
                                                                                                                                                            echo "value='$month_id'";
                                                                                                                                                        } ?>>
                        </div>

                    </div><br>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Quarter</label>
                            <!-- <p class="custom_placeholder1">Quarter</p> -->
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
                                        } ?> value="FQ1">FQ1 (Oct-Dec)</option>
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
                    </div><br>

                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary show_data"> Show Data</button>
                        </div>
                    </div>
                </form>
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
                                    <td>CATEGORY SALES SHARE</td>
                                    <td>SALES SHARE %</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($catSaleShare)) { ?>
                                    <?php $totalSale = array();
                                    $cat_array = array();
                                    foreach ($catSaleShare as $key => $value) {
                                    ?>
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
                                        <!-- <tr>
                                            <td><?php //echo $value2->fy_quarter;
                                                ?></td>
                                            <td><?php //echo $value2->sales;
                                                ?></td>
                                            <td><?php //echo $value2->oti . "%";
                                                ?></td>
                                            <td><?php // $value2->no_of_invoice;
                                                ?></td>
                                        </tr> -->
                                        <tr>
                                            <td><?php echo $value2->Period; ?></td>
                                            <td><?php echo number_format(round($value2->sales, 2)); ?></td>
                                            <td><?php echo round($value2->total_oti_percentage, 2) . "%"; ?></td>
                                            <td><?php if ($value2->invoice_count) {
                                                    echo $value2->invoice_count;
                                                } else {
                                                    echo "0";
                                                } ?></td>
                                        </tr>
                                    <?php }  ?>

                                <?php }  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- <div class="col-md-12"> -->
        <div class="card">

            <div class="card-body">
                <!-- <table id="advanced_table" class="table table-bordered"> -->
                <table id="advanced_table" class="display nowrap final_table table-bordered" style="width:100%">
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
                            <th>Subsys<br>Art. No.</th>
                            <th>Subsys<br>Art. Name</th>
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
                        <?php
                        // echo "<pre>";
                        // print_r($final_domainList);
                        // echo "</pre>";
                        // die();

                        if (!empty($final_domainList)) { ?>
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
                                    <!-- <td><?php echo e($rand); ?></td> -->
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
                            <th>Subsys<br>Art. No</th>
                            <th>Subsys<br>Art. Name</th>
                            <th>Status</th>
                            <th>Qty<br>of<br>Months<br>With<br>Sales</th>
                            <th>Sales</th>
                            <th>Colli</th>
                            <th>Invoices</th>
                            <th>Sales<br>/<br>Month</th>
                            <th>Colli<br>/<br>Month</th>
                            <th>Invoices<br>/<br>Month</th>

                        </tr>
                    </tfoot>

                </table>
                <div class="card-options text-right mt-5">
                    <button type="button" id="customer-offer" class="btn btn-primary mt-5 mb-2">Go To Offer List</button>
                    <!-- <button id="button">Row count</button> -->
                </div>
            </div>
        </div>
        <!-- </div> -->
    </div>

</div>


<?php $__env->startPush('script'); ?>

<!-- month/year dropdown select Bootstrap js library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->

<script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>


<script type="text/javascript">
    $(window).load(function() {
        $('.quater').select2({
            placeholder: "Select Quarter",
            allowClear: true
        });
        $('.customer_unique').select2({
            placeholder: "Select linked customers",
            allowClear: true
        });

        // $(".datepicker-months table.table-condensed tr td span.month").prop("disabled", false);
        $(".datepicker-months table.table-condensed tr td span.month").removeAttr("disabled");

    })

    $(document).ready(function() {

        $('.refresh_unique').click(function() {

            if ($(".refresh_unique").is(":checked")) {

                $("#customer").prop("disabled", true);
                $('#customer').prop('selectedIndex', 0).trigger("change");
                $('#customer').prop("required", false);
                $('#customer_unique').prop("required", true);
                $('#customer_unique').parent().find("span.error").css('display', 'inline-block');
                $('#customer').parent().find("span.error").css('display', 'none');
                $('#customer_unique').prop("multiple", false);

                $.ajax({
                    url: 'get_allUniqueCustomer',
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        $('select[name="customer_unique[]"]').empty();
                        $('select[name="customer_unique[]"]').append('<option value="">Unique Customers</option>').fadeIn("fast");
                        jQuery.each(data, function(key, value) {
                            $('select[name="customer_unique[]"]').append('<option value="' + value.cust_no_unique + '">' + value.cust_no_unique + '</option>');
                        });

                        $(".customer_unique").select2({
                            placeholder: {
                                id: '-1', // the value of the option
                                text: 'Linked Customers'
                            }
                        });

                    }
                });

            } else {
                $('#customer').prop("required", true);
                $("#customer").prop("disabled", false);
                $('#customer').parent().find("span.error").css('display', 'inline-block');
                $('#customer_unique').prop("multiple", true);
                $('select[name="customer_unique[]"]').empty();
            }
        });


        //If from-year is selected then add required to select To-year

        $('.show_data').click(function() {
            if ($('.from_year').val().length == "4") {
                $('.to_year').prop("required", true);
            }

            if ($('.from_year ').val() == "" && $('.to_year ').val() == "") {

            } else {
                if (($('.to_year ').val() - $('.from_year').val()) == 1) {
                    $("#year_err").hide();
                    return true;
                } else {
                    $("#year_err").show();
                    return false;
                }
            }


            $(".customer_unique").select2({
                placeholder: {
                    id: '-1', // the value of the option
                    text: 'Linked Customers'
                }
            });
        }); //.show_data click end


        $(function() {
            $('#filterByDate1, #filterByDate2').datepicker({
                changeMonth: true,
                changeYear: true,
                changeDate: false,
                showButtonPanel: true,
                dateFormat: 'yy-mm',
                yearRange: "2015:2032",
                defaultDate: null,
                onClose: function(dateText, inst) {
                    $(this).datepicker('getDate', "");
                    $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                }
            });

            /*  $(".month_id").datepicker({
                numberOfMonths: 12,
                format: "MM yyyy",
                viewMode: "months",
                minViewMode: "months",
                // yearRange: "2020:2022",
                startView: 2,
                defaultViewDate: {
                    year: '1950'
                },
                startDate: '-2y', //2021 -1950
                endDate: '-0y', //2021-2011
                autoclose: true //to close picker once month is selected
            });
*/

            $(".year_id.from_year").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                startView: 2,
                defaultViewDate: {
                    year: '1950'
                },
                startDate: '-2y', //2022 - 2020
                endDate: '-1y', //2022- 2021
                autoclose: true //to close picker once year is selected
            });

            $(".year_id.to_year").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                startView: 2,
                defaultViewDate: {
                    year: '1950'
                },
                startDate: '-1y', //2022 -2021
                endDate: '-0y', //2022- 2022
                autoclose: true //to close picker once year is selected
            });

            // $(".datepicker-years thead th.datepicker-switch").html("2020-2022");
            // $(".year_id.to_year th.prev").css('display', 'none');
        }); //Func end

    }); //ready End

    // $(window).on('load', function() {

    $(document).ready(function() {

        /*  $('#customer').on('change', function() {
             // var url = "<?php echo e(url('customer?id=')); ?>" + this.value;
             // window.location.href = url;

             var token_n = $('meta[name="_token"]').attr('content');
             $(".selected_ico").val(this.value);
             var unique_no = $(".selected_unique").val();
             var category = $(".selected_category").val();
             var ico_number = this.value;
             $('<form>', {
                 "id": "customer_icoForm",
                 "html": '<input type="text" id="selected_ico" name="selected_ico" value="' + ico_number + '" /><input type="text" id="unique_no" name="unique_no" value="' + unique_no + '" /><input type="text" id="category" name="category" value="' + category + '" /><input type="text" id="token" name="_token" value="' + token_n + '" />',
                 "action": "<?php echo e(route('get_uniqueCustomer')); ?>",
                 "method": "POST"
             }).appendTo(document.body).submit();

         }); */

        // $(".customer_unique").select2();





        $('select[name="customer_ico"]').on('change', function() {

            $(".selected_ico").val(this.value);

            var selected_ico = $(this).val();
            if (selected_ico) {
                $.ajax({
                    url: 'get_uniqueCustomer',
                    data: {
                        selected_ico: selected_ico
                    },
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);

                        $('select[name="customer_unique[]"]').empty();
                        // $('select[name="customer_unique[]"]').append('<option value="">Linked Customers</option>');
                        jQuery.each(data, function(key, value) {
                            $('select[name="customer_unique[]"]').append('<option value="' + value.cust_no_unique + '">' + value.cust_no_unique + '</option>');
                        });

                        $(".customer_unique").select2({
                            placeholder: {
                                id: '-1', // the value of the option
                                text: 'Linked Customers'
                            }
                        });

                    }
                });
            } else {
                // $('select[name="customer_unique[]"]').empty();
                $('select[name="customer_unique[]"]').append('<option value="">Linked Customers</option>');

            }
        })


        var table = $('.final_table').DataTable({
            "scrollY": "auto",
            "scrollX": true,
            // "ordering": false,
            columnDefs: [{
                    orderable: true,
                    // className: 'reorder',
                    targets: 1
                },
                {
                    orderable: false,
                    targets: '_all'
                }
            ],
            "lengthMenu": [
                [50, 150, 200, -1],
                [50, 150, 200, "All"]
            ]
        }); //datatable end

        $('.final_table tbody').on('click', 'tr', function() {
            $(this).toggleClass('selected');
            $(this).find('td .custom-control-input').toggleClass("selected_box");
        });

        $("#customer-offer").click(function() {

            var cOfferID = [];

            var ids = $.map(table.rows('.selected').data(), function(item) {
                return item[0];
            });

            cOfferID += ids;

            // if (cOfferID.length > 0) {
            $('#customer-offer').prop('disabled', true);
            var token = $('meta[name="_token"]').attr('content');

            // var cust_id = location.search;
            // cust_id = cust_id.replace("?id=", "");
            var cust_id = $(".selected_ico").val();
            var cust_unique = $(".selected_unique").val();
            var selected_quarter = $(".selected_quater").val();
            var selected_artCategory = $(".selected_artCategory").val();
            var selected_channel = $(".selected_channel").val();
            var selected_yearId = $(".selected_yearId").val();
            var selected_monthId = $(".selected_monthId").val();
            // alert(cOfferID);
            console.log(selected_quarter);

            $('<form>', {
                "id": "customerOfferFrom",
                "html": '<input type="text" id="cOfferID" name="cOfferID" value="' + cOfferID + '" /><input type="text" id="cust_unique" name="cust_unique" value="' + cust_unique + '" /> <input type="text" id="token" name="_token" value="' + token + '" /><input type="text" id="cust_id" name="cust_id" value="' + cust_id + '" /> <input type="text" id="sel_quarter" name="sel_quarter" value="' + selected_quarter + '" /><input type="text" id="sel_artCategory" name="sel_artCategory" value="' + selected_artCategory + '" /><input type="text" id="sel_channel" name="sel_channel" value="' + selected_channel + '" /><input type="text" id="sel_yearId" name="sel_yearId" value="' + selected_yearId + '" /><input type="text" id="sel_monthId" name="sel_monthId" value="' + selected_monthId + '" /> ',
                "action": "<?php echo e(route('customer-offer-data')); ?>",
                "method": "POST"
            }).appendTo(document.body).submit();

            //  }

        });

    });
</script>


<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\profitability-tool\resources\views/customer/index.blade.php ENDPATH**/ ?>