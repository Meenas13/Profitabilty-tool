@extends('layouts.main')
@section('title', 'Customers')
@section('content')

@section('styles')
<link href="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
@stop

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
                            <a href="{{url('dashboard')}}"><i class="ik ik-home"></i></a>
                        </li> -->
                        <li class="breadcrumb-item"><i class="ik ik-home"></i> Customers
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-body">
                <form class="" method="POST" action="{{ url('full_domainList') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Customer ico <span class="error">*</span></label>

                            <input type="hidden" value="" name="selected_ico" class="selected_ico">
                            <input type="hidden" value="<?php echo $unique_implode; ?>" name="selected_unique[]" class="selected_unique">
                            <input type="hidden" value="<?php echo $sel_quater_implode; ?>" name="selected_quater[]" class="selected_quater">

                            <select class="form-control select2" name="customer_ico" id="customer" required>
                                <option value="" selected="selected">Customer</option>
                                @foreach($cust_icoList as $cust_ico_no)
                                <option value="{{$cust_ico_no->ico}}" <?php if ($id == "$cust_ico_no->ico") {
                                                                            echo 'selected';
                                                                        } ?>>{{$cust_ico_no->ico}}</option>

                                @endforeach

                                <!-- <option value="106007" <?php if ($id == "106007") {
                                                                echo 'selected';
                                                            } ?>>106007</option>
                            <option value="187373" <?php if ($id == "187373") {
                                                        echo 'selected';
                                                    } ?>>187373</option> -->
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for=""> Linked Customer No <span class="error">*</span></label>

                            <!-- data-placeholder="Begin typing a name to filter..." multiple -->

                            <!-- <select multiple name="customer_unique[]" id="customer_unique" required class="chosen-select1 form-control1 customer_unique" style="width: 100%;">
                                <option selected="selected" value=""> Linked Customers</option> -->
                            <select multiple="multiple" placeholder="Linked Customers" name="customer_unique[]" id="customer_unique" required class="chosen-select1 form-control customer_unique" style="width: 100%;">
                                <option value="" class="linked"> Linked Customers</option>
                                <?php
                                // echo "<pre>";
                                // print_r($cust_uniqueList);
                                // echo "</pre>";
                                // die(); 
                                ?>
                                <?php

                                foreach ($cust_uniqueList as $unique) { ?>
                                    <option value="{{ $unique->cust_no_unique;}} " <?php if ($unique_number == "$unique->cust_no_unique") {
                                                                                        echo 'selected';
                                                                                    } ?>>{{$unique->cust_no_unique}}</option>

                                <?php }
                                ?>
                            </select>

                            <!-- <select class="form-control customer_unique" name="customer_unique" id="customer_unique" required>
                                <option selected="selected" value=""> Linked Customers</option>
                             
                            </select> -->
                        </div>
                        <div class="col-md-4">
                            <label for="">Article Category</label>
                            <select class="form-control select2" name="category">
                                <option selected="selected" value="">Category of an article</option>
                                @if($catmanager_groupList)
                                @foreach($catmanager_groupList as $category)
                                <option value="<?php echo $category->catmanager_group; ?>">{{$category->catmanager_group}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Channel Type</label>
                            <select class="form-control select2" name="channel">
                                <option selected="selected" value=""> Type of channel</option>
                                <option value="C&C">Cash & Carry</option>
                                <option value="Delivery">FSD</option>
                                <option value="both">Both</option>
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
                                <input type='text' class="year_id form-control from_year" name="from_year" format="yyyy" placeholder="From Year (yyyy)" style="width:48%">
                                <span class="year_dash">-</span>
                                <input type='text' class="year_id form-control to_year" name="to_year" placeholder="To Year (yyyy)" style="width:48%">

                                <!-- <input type="text" class="yearpicker from_year" name="from_year" placeholder="From Year (yyyy)">
                                <input type="text" class="yearpicker to_year" name="to_year" placeholder="To Year (yyyy)"> -->

                            </div>
                        </div>


                        <div class="col-md-4">
                            <label for="">Month id </label>
                            <input type='text' class="month_id form-control" name="month_id" placeholder="Select Month">
                        </div>

                    </div><br>


                    <div class="row">

                        <div class="col-md-4">
                            <label for="">Quarter</label>
                            <!-- <p class="custom_placeholder1">Quarter</p> -->
                            <select multiple="multiple" class="form-control quater select2" placeholder="Quater" name="quater[]" id="quater">
                                <!-- <option value="" class="linked">Select Quater</option> -->
                                <option value="FQ1">FQ1 (Oct-Dec)</option>
                                <option value="FQ2">FQ2 (Jan-Mar)</option>
                                <option value="FQ3">FQ3 (Apr-Jun)</option>
                                <option value="FQ4">FQ4 (Jul-Sep)</option>
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
                                    <td></td>
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
                                    <td></td>
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
                                            <td><?php echo round($value2->sales, 2); ?></td>
                                            <td><?php echo round($value2->total_oti_percentage, 2) . "%"; ?></td>
                                            <td><?php echo $value2->invoice_count; ?></td>
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
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <!-- <table id="advanced_table" class="table table-bordered"> -->
                    <table id="advanced_table" class="display nowrap final_table" style="width:100%">
                        <thead style="text-align: center;" valign="center">
                            <tr>
                                <!-- <th class="nosort" width="10">
                                    <label class="custom-control custom-checkbox m-0">
                                        <input type="checkbox" class="custom-control-input" id="selectall" name="" value="option2">
                                        <span class="custom-control-label">&nbsp;</span>
                                    </label>
                                </th> -->
                                <th style="display: none;">Id</th>
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
                                        <td style="display: none;"> {{$value->buy_subsys_no}} </td>
                                        <td> {{$value->buy_domain}}</td>
                                        <td>{{$value->subsys_art_no}}</td>
                                        <td>{{$value->subsys_art_name}}</td>
                                        <td>{{$value->status_article}}</td>
                                        <!-- <td>{{ $rand }}</td> -->
                                        <td>{{ $value->qtymonths }}</td>
                                        <td>{{round($value->sales,2)}}</td>
                                        <td>{{round($value->colli,2)}}</td>
                                        <td>{{$value->noofinvoice}}</td>
                                        <td>{{round($value->sales_per_month)}}</td>
                                        <td>{{round($value->colli_per_month)}}</td>
                                        <td>{{round($value->invoices_per_month)}}</td>
                                    </tr>
                            <?php }
                            } ?>

                        </tbody>

                        <tfoot style="text-align: center;" valign="center">
                            <tr>
                                <th style="display: none;">Id</th>
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
                        </tfoot>

                    </table>
                    <div class="card-options text-right mt-5">
                        <button type="button" id="customer-offer" class="btn btn-primary mt-5 mb-2">Go To Offer List</button>
                        <!-- <button id="button">Row count</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@push('script')


<!-- month/year dropdown select Bootstrap js library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->

<script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {

        // $('.customer_unique').selectpicker();

        //If from year is selected then add required to select To-year
        $('.show_data').click(function() {
            if ($('.from_year').val().length == "4") {
                $('.to_year').prop("required", true);
            }
        });


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

            // $(".show_date").click(function() {

            if ($(".from_year").val().length > 0) {
                $(".to_year").attr("required", true);
            }

            //});



            $(".month_id").datepicker({
                format: "MM yyyy",
                viewMode: "months",
                minViewMode: "months",
                autoclose: true //to close picker once year is selected
            });

            $(".year_id").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true //to close picker once year is selected
            });


        }); //Func end

    }); //ready End

    // $(window).on('load', function() {

    $(document).ready(function() {

        $("#quater").select2({
            placeholder: {
                id: '-1', // the value of the option
                text: 'Quater'
            },
        });



        /*  $('#customer').on('change', function() {
             // var url = "{{url('customer?id=')}}" + this.value;
             // window.location.href = url;

             var token_n = $('meta[name="_token"]').attr('content');
             $(".selected_ico").val(this.value);
             var unique_no = $(".selected_unique").val();
             var category = $(".selected_category").val();
             var ico_number = this.value;
             $('<form>', {
                 "id": "customer_icoForm",
                 "html": '<input type="text" id="selected_ico" name="selected_ico" value="' + ico_number + '" /><input type="text" id="unique_no" name="unique_no" value="' + unique_no + '" /><input type="text" id="category" name="category" value="' + category + '" /><input type="text" id="token" name="_token" value="' + token_n + '" />',
                 "action": "{{route('get_uniqueCustomer')}}",
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
        });

        $('.final_table tbody').on('click', 'tr', function() {
            $(this).toggleClass('selected');
            $(this).find('td .custom-control-input').toggleClass("selected_box");
        });

        /*  $('#button').click(function() {
             var ids = $.map(table.rows('.selected').data(), function(item) {
                 return item[1];
             });
             console.log(ids);
             alert(table.rows('.selected').data().length + ' row(s) selected');
         }); */


        $("#customer-offer").click(function() {

            var cOfferID = [];

            // $(".custom-control-input:checked").each(function() {
            //     cOfferID.push($(this).val());
            //     // console.log($(this).val());
            // });

            var ids = $.map(table.rows('.selected').data(), function(item) {
                return item[0];

            });

            cOfferID += ids;

            if (cOfferID.length > 0) {
                $('#customer-offer').prop('disabled', true);
                var token = $('meta[name="_token"]').attr('content');

                // var cust_id = location.search;
                // cust_id = cust_id.replace("?id=", "");
                var cust_id = $("#customer").val();
                var cust_unique = $(".selected_unique").val();
                var selected_quarter = $(".selected_quater").val();
                // alert(cOfferID);
                console.log(selected_quarter);

                $('<form>', {
                    "id": "customerOfferFrom",
                    "html": '<input type="text" id="cOfferID" name="cOfferID" value="' + cOfferID + '" /><input type="text" id="cust_unique" name="cust_unique" value="' + cust_unique + '" /> <input type="text" id="token" name="_token" value="' + token + '" /><input type="text" id="cust_id" name="cust_id" value="' + cust_id + '" />   <input type="text" id="sel_quarter" name="sel_quarter" value="' + selected_quarter + '" /> ',
                    "action": "{{route('customer-offer-data')}}",
                    "method": "POST"
                }).appendTo(document.body).submit();

            }

        });



        // $(".chosen-select").chosen({
        //     no_results_text: "Oops, nothing found!"
        // });


    });
</script>


@endpush

@endsection