@extends('layouts.main')
@section('title', 'Offer')
@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-user-plus bg-blue"></i>
                    <div class="d-inline">
                        <h5>Offer</h5>
                        <!-- offer page view blade -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('customer')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Offer</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <br>
                <!-- <div class="card-body">
                    <div style="text-align: right !important;align-items: center;justify-content: end;" class="card-options d-flex">
                        <span class="" style="width:20px;height:20px;background-color: rgb(255 241 185);display:inline-block"></span><span> &nbsp; Items which are not part of FSD assortment </span>
                    </div>
                </div> -->
                <div class="card-body">
                    <!-- <table id="advanced_table" class="table table-striped table-bordered nowrap dataTable"> -->
                    <table id="advanced_table" class="display nowrap final_table" style="width:100%">
                        <span id="backBonus_amt" style="display: none;"></span>
                        <thead style="text-align: center;">
                            <tr valign="center">
                                <th width="15%">Buy Domain</th>
                                <th width="15%">Subsys<br>Art No</th>
                                <th width="15%">Subsys<br>Art Name</th>
                                <th width="15%"> Status</th>
                                <th>Colli</th>
                                <th>Requested Price<br>/<br>MU</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $offer)

                            <tr <?php if ($offer->delivery_flag_name == "Delivery") { ?> style="background-color: rgb(255 241 185);" <?php } ?>>

                                <input type="hidden" name="buy_domain_no[]" class="buy_domain_no" value="<?php echo $offer->buy_domain_no; ?>">
                                <input type="hidden" name="subsys_art_no[]" class="subsys_art_no" value="<?php echo $offer->subsys_art_no; ?>">
                                <td>{{$offer->buy_domain}}</td>
                                <td>{{$offer->subsys_art_no}}</td>
                                <td>{{$offer->subsys_art_name}}</td>
                                <td>{{$offer->status_article}}</td>
                                <td><input type="text" name="collis[]" value="0" class="form-control collis"></td>
                                <td>
                                    <input type="text" name="selling[]" value="0" class="form-control selling">
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-options text-right mt-5">
                        <!-- <button type="button" class="btn btn-primary mt-5 mb-2" data-toggle="modal" data-target=".addNew"> Add New article to DB </button> -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".add_newItem"> &nbsp; &#43; &nbsp; </button>
                        <input type="hidden" id="cust_id" value="<?php echo $cust_id; ?>">
                        <button type="button" id="calculate1" class="btn btn-primary mt-5 mb-2" disabled style="display: none;">Calculate</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <br>
                <div style="text-align: center !important;" class="card-options">
                    <h3 style="border: 3px solid #007bff;"> Back Bonus Calculations </h3>
                </div>

                <div class="card-body">
                    <div class="card-options">
                        <div class="row">
                            <div class="col-md-4"><label> ICO: </label><input readonly type="text" class="selected_ico form-control" value="<?php echo $cust_id; ?>"></div>
                            <div class="col-md-4"><label> Unique No. : </label><input readonly type="text" class="form-control c_unique" value="<?php echo $unique_implode;  ?>"></div>
                            <div class="col-md-4"><label> Quarters :</label><input readonly type="text" value="<?php echo str_replace("'", "", $selected_quarter_implode); ?>" class="form-control"></div>

                            <input readonly type="hidden" value="<?php echo $selected_artCategory; ?>" name="selected_artCategory" class="selected_artCategory">
                            <input readonly type="hidden" value="<?php echo $selected_channel; ?>" name="selected_channel" class="selected_channel">
                            <input readonly type="hidden" value="<?php echo $selected_yearId; ?>" name="selected_yearId" class="selected_yearId">
                            <input readonly type="hidden" value="<?php echo $selected_monthId; ?>" name="selected_monthId" class="selected_monthId">

                            <?php foreach ($cust_unique as $un_number) { ?>
                                <input readonly type="hidden" value="<?php echo $un_number; ?>" name="selected_unique" class="selected_unique">
                            <?php } ?>

                            <input readonly type="hidden" value="<?php echo $selected_quarter_implode; ?>" name="selected_quarter[]" class="selected_quarter">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="bb_table">
                            <thead>
                                <tr>
                                    <!-- <th>Customer ICO</th>
                                    <th>Unique Customer No</th> -->
                                    <th>BULK</th>
                                    <th>SPIRITS</th>
                                    <th>REGULAR</th>
                                    <th>PROMO</th>
                                    <th>CIP</th>
                                    <th>Type 1</th>
                                    <th>Type 2</th>
                                    <!-- <button type="button" class="btn btn-secondary refresh_type"> &#8634; </button> </th> -->
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="row_count1" id='row1'>
                                    <!--       <td class="cust_HO_no">
                                        <select contenteditable="true" class="form-control cust_HO1 select2 customer_ico" name="customer_ico" id="customer_ico">
                                            <option selected="selected" value="">Select</option>
                                            @foreach($cust_icoList as $cust_ico_no)
                                            <option value="{{$cust_ico_no->ico}}">{{$cust_ico_no->ico}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="linked_cust_no">
                                        <select contenteditable="true" class="form-control select1 customer_unique" name="customer_unique" id="customer_unique">
                                            <option value="" class="linked"> Select</option>
                                             multiple="multiple" 
                                        </select>
                                    </td>  -->
                                    <td>
                                        <select contenteditable="true" class="form-control bulk select2" name="country">
                                            <option selected="selected" value="">Bulk </option>
                                            <option value="limitBase">Limit Base </option>
                                            <option value="limitAndBonusBase">Limit & Bonus Base </option>
                                            <option value="excluded">Excluded</option>
                                        </select>
                                    </td>
                                    <td> <select contenteditable="true" class="form-control spirits select2" name="country">
                                            <option selected="selected" value="">Spirits </option>
                                            <option value="limitBase">Limit Base </option>
                                            <option value="limitAndBonusBase">Limit & Bonus Base </option>
                                            <option value="excluded">Excluded</option>
                                        </select> </td>
                                    <td> <select contenteditable="true" class="form-control regular select2" name="country">
                                            <option selected="selected" value=""> Regular </option>
                                            <option value="limitBase">Limit Base </option>
                                            <option value="limitAndBonusBase">Limit & Bonus Base </option>
                                            <option value="excluded">Excluded</option>
                                        </select> </td>
                                    <td> <select contenteditable="true" class="form-control promo select2" name="country">
                                            <option selected="selected" value="">Promo </option>
                                            <option value="limitBase">Limit Base </option>
                                            <option value="limitAndBonusBase">Limit & Bonus Base </option>
                                            <option value="excluded">Excluded</option>
                                        </select> </td>
                                    <td> <select contenteditable="true" class="form-control cip select2" name="country">
                                            <option selected="selected" value="">CIP </option>
                                            <option value="limitBase">Limit Base </option>
                                            <option value="limitAndBonusBase">Limit & Bonus Base </option>
                                            <option value="excluded">Excluded</option>
                                        </select> </td>
                                    <td contenteditable="true" class="type1_bb">
                                        <input type="text" value="" placeholder="Amount" class="amount form-control" width="50%">
                                        <input type="text" value="" placeholder="Percent" class="percent form-control" width="50%">
                                    </td>
                                    <td class="type2_bb">
                                        <button type="button" class="btn btn-primary addLevel" data-toggle="modal" data-target=".addRange"> Add Level </button>
                                    </td>

                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-12 col-md-12 col-lg-12" align="right">
                            <button type="button" name="addNewCustBB" id="addNewCustBB" style="display: none;" class="btn btn-success btn-sm">+</button>
                        </div>
                        <br>

                        <div class="BonusType_error" style="display: none;"> * Enter either bonus type 1 or type 2 </div>
                        <div class="bb_returns" style="display: none;">
                            <h5> Back Bonus <span id="backBonus"></span> </h5>
                            <h5> Limit Base <span id="limitBase"></span> </h5>
                            <h5> Bonus Base <span id="bonusBase"></span> </h5>

                            <h4> Historical OTI% <span id="historical_oti"> </span></h4>
                        </div>
                    </div>

                    <br>
                    <div style="text-align: right !important;" class="card-options">
                        <button type="button" id="calculate_backBonus" class="btn btn-info btn-large">Calculate Back Bonus</button>
                        <button type="button" id="calculate" class="btn btn-warning btn-large" disabled>Calculate OTI</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <br><br> <br>
                <div style="text-align: center !important;" class="card-options">
                    <h3 style="border: 3px solid #007bff;">Forecasted OTI = <span id="forecasted">0%</span></h3>
                </div>
                <br> <br>
                <!-- <div style="text-align: center !important;" class="card-options">
                    <h3 style="border: 3px solid #007bff;">Historical OTI = <span id="historical">0%</span></h3>
                </div>
                <br> <br> -->
            </div>
        </div>
    </div>
</div>


<!-- Modal add Backbonus range -->
<div class="modal fade addRange" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRangeLabel"> Add levels/Ranges for backbonus </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="cust_table">
                        <tr>
                            <th>Level 1</th>
                            <th>Level 2</th>
                            <th>Level 3</th>
                            <th>Level 4</th>
                            <th>Level 5</th>
                        </tr>
                        <tr class="row_count1" id='row1'>
                            <td contenteditable="true" class="level_1">
                                <div class="full_div">
                                    <div class="half_div first">
                                        <input type="text" rowspan="2" value="" placeholder="From_1" class="from_amount form-control">
                                        <input type="text" rowspan="2" value="" placeholder="to_1" class="to_amount form-control">
                                    </div>
                                    <div class="half_div"> <input type="text" rowspan="1" value="" placeholder="%" class="percentage form-control">
                                    </div>
                                </div>
                            </td>
                            <td contenteditable="true" class="level_2">
                                <div class="full_div">
                                    <div class="half_div first">
                                        <input type="text" rowspan="2" value="" placeholder="From_2" class="from_amount form-control">
                                        <input type="text" rowspan="2" value="" placeholder="To_2" class="to_amount form-control">
                                    </div>
                                    <div class="half_div"> <input type="text" rowspan="1" value="" placeholder="%" class="percentage form-control">
                                    </div>
                                </div>
                            </td>
                            <td contenteditable="true" class="level_3">
                                <div class="full_div">
                                    <div class="half_div first">
                                        <input type="text" rowspan="2" value="" placeholder="From_3" class="from_amount form-control">
                                        <input type="text" rowspan="2" value="" placeholder="To_3" class="to_amount form-control">
                                    </div>
                                    <div class="half_div"> <input type="text" rowspan="1" value="" placeholder="%" class="percentage form-control">
                                    </div>
                                </div>
                            </td>
                            <td contenteditable="true" class="level_4">
                                <div class="full_div">
                                    <div class="half_div first">
                                        <input type="text" rowspan="2" value="" placeholder="From_4" class="from_amount form-control">
                                        <input type="text" rowspan="2" value="" placeholder="To_4" class="to_amount form-control">
                                    </div>
                                    <div class="half_div"> <input type="text" rowspan="1" value="" placeholder="%" class="percentage form-control">
                                    </div>
                                </div>
                            </td>
                            <td contenteditable="true" class="level_5">
                                <div class="full_div">
                                    <div class="half_div first">
                                        <input type="text" rowspan="2" value="" placeholder="From_5" class="from_amount form-control">
                                        <input type="text" rowspan="2" value="" placeholder="To_5" class="to_amount form-control">
                                    </div>
                                    <div class="half_div"> <input type="text" rowspan="1" value="" placeholder="%" class="percentage form-control">
                                    </div>
                                </div>
                            </td>

                        </tr>
                    </table>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
                <!-- <button type="button" class="btn btn-primary" id="save_customer1">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

<div class="dynamic_modal"></div>

<!-- Modal New item from existing list -->
<div class="modal fade add_newItem" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_newItemLabel"> Add a new item/article </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <table id="advanced_table" class="table  table-bordered"> -->
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
                        <?php if (!empty($allList_data)) { ?>
                            <?php foreach ($allList_data as $key => $value) {
                                $rand = rand(1, 5);    ?>
                                <?php $selected_id = array();
                                foreach ($data as $offer) :
                                    $selected_id[] .= $offer->buy_subsys_no;
                                endforeach;

                                $array_ids = implode(",", $selected_id);
                                ?>
                                <tr <?php if ($value->buy_subsys_no == in_array($value->buy_subsys_no, $selected_id)) { ?> class="selected" <?php } ?>>
                                    <!-- <td>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input select_all_child" <?php if ($value->buy_subsys_no == in_array($value->buy_subsys_no, $selected_id)) { ?> checked <?php } ?>id="" name="customer-id" value="{{$value->buy_subsys_no}}">
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
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="customer-offer">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal New item to Database -->
<div class="modal fade addNew" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewLabel"> Add new row </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <table id="advanced_table" class="table  table-bordered"> -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="cust_table">
                        <tr>
                            <th>Buy Domain</th>
                            <th>Subsys Art No</th>
                            <th>Subsys Art Name</th>
                            <th>Status</th>
                            <th>Qty of Months With Sales</th>
                            <th>Sales</th>
                            <th>Colli</th>
                            <th>Invoices</th>
                            <!-- <th>Sales/Month</th>
                            <th> Colli/Month</th>
                            <th> Invoices/Month </th> -->
                            <th></th>
                        </tr>
                        <tr class="row_count1" id='row1'>
                            <!-- <td contenteditable="false" class="item_code">1</td> -->
                            <td contenteditable="true" class="buy_domain"></td>
                            <td contenteditable="true" class="subsys_art_no"></td>
                            <td contenteditable="true" class="subsys_art_name"></td>
                            <td contenteditable="true" class="status"></td>
                            <td contenteditable="true" class="qty_of_month"></td>
                            <td contenteditable="true" class="sales"></td>
                            <td contenteditable="true" class="colli"></td>
                            <td contenteditable="true" class="invoices"></td>
                            <!-- <td contenteditable="true" class="sales_per_month"></td>
                            <td contenteditable="true" class="colli_per_month"></td>
                            <td contenteditable="true" class="invoices_per_month"> -->
                            <td></td>
                        </tr>
                    </table>
                    <div align="right">
                        <button type="button" name="add" id="add" class="btn btn-success btn-sm">+</button>
                    </div>
                    <!-- <div id="inserted_item_data"></div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_customer">Save changes</button>
            </div>
        </div>
    </div>
</div>

@push('script')

<script type="text/javascript">
    //Forcasted OTI Calculation JS
    $(document).ready(function() {

        $("#calculate").on("click", function() {
            $('#calculate').prop('disabled', true);
            var backBonus_amount = $('#backBonus_amt').text();

            var selling = [];
            $(".selling").each(function() {
                selling.push($(this).val());
            });

            var collis = [];
            $(".collis").each(function() {
                collis.push($(this).val());
            });

            var buy_domain_no = [];
            $(".buy_domain_no").each(function() {
                buy_domain_no.push($(this).val());
            });

            var subsys_art_no = [];
            $(".subsys_art_no").each(function() {
                subsys_art_no.push($(this).val());
            });

            $.ajax({
                method: "POST",
                url: "{{route('forcasted-cal')}}",
                dataType: "json",
                data: {
                    '_token': $('meta[name="_token"]').attr('content'),
                    'selling': selling,
                    'colli': collis,
                    'buying': buying,
                    'buy_domain_no': buy_domain_no,
                    'subsys_art_no': subsys_art_no,
                    'backBonus_amount': backBonus_amount
                },
                success: function(response) {
                    // console.log(response);
                    $('#calculate').prop('disabled', false);
                    if (response == "Less Then Zero") {
                        $("#forecasted").text(response);
                        $("#forecasted").css("color", "red");
                    } else {
                        $("#forecasted").css("color", "");
                        $("#forecasted").text(response + '%');
                    }
                },
                fail: function(response) {

                }
            });
            $('#calculate').prop('disabled', false);
        });

    });

    // Add new row to DB JS
    $(document).ready(function() {

        var count = 1;
        $('#add').click(function() {
            count = count + 1;
            var html_code = "<tr class='row_count" + count + "' id='row" + count + "'>";
            // html_code += "<td contenteditable='false' class='item_code'>" + count + "</td>";
            html_code += "<td contenteditable='true' class='buy_domain'></td>";
            html_code += "<td contenteditable='true' class='subsys_art_no'></td>";
            html_code += "<td contenteditable='true' class='subsys_art_name'></td>";
            html_code += "<td contenteditable='true' class='status'></td>";
            html_code += "<td contenteditable='true' class='qty_of_month'></td>";
            html_code += "<td contenteditable='true' class='sales'></td>";
            html_code += "<td contenteditable='true' class='colli'></td>";
            html_code += "<td contenteditable='true' class='invoices'></td>";
            // html_code += "<td contenteditable='true' class='sales_per_month'></td>";
            // html_code += "<td contenteditable='true' class='colli_per_month'></td>";
            // html_code += "<td contenteditable='true' class='invoices_per_month'></td>";
            html_code += "<td><button type='button' name='remove' data-row='row" + count + "' class='btn btn-danger btn-sm remove'>-</button></td>";
            html_code += "</tr>";
            $('#cust_table').append(html_code);
        });

        $(document).on('click', '.remove', function() {
            var delete_row = $(this).data("row");
            $('#' + delete_row).remove();
        });

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        $('#save_customer').click(function() {
            var row = [];
            var buy_domain = [];
            var subsys_art_no = [];
            var subsys_art_name = [];
            var status = [];
            var qty_of_month = [];
            var sales = [];
            var colli = [];
            var invoices = [];
            // var sales_per_month = [];
            // var colli_per_month = [];
            // var invoices_per_month = [];


            $('.row_count').each(function() {
                row.push($(this).text());
            });
            $('.buy_domain').each(function() {
                buy_domain.push($(this).text());
            });
            $('.subsys_art_no').each(function() {
                subsys_art_no.push($(this).text());
            });
            $('.subsys_art_name').each(function() {
                subsys_art_name.push($(this).text());
            });
            $('.status').each(function() {
                status.push($(this).text());
            });
            $('.qty_of_month').each(function() {
                qty_of_month.push($(this).text());
            });
            $('.sales').each(function() {
                sales.push($(this).text());
            });
            $('.colli').each(function() {
                colli.push($(this).text());
            });
            $('.invoices').each(function() {
                invoices.push($(this).text());
            });
            // $('.sales_per_month').each(function() {
            //     sales_per_month.push($(this).text());
            // });
            // $('.colli_per_month').each(function() {
            //     colli_per_month.push($(this).text());
            // });
            // $('.invoices_per_month').each(function() {
            //     invoices_per_month.push($(this).text());
            // });


            $.ajax({
                url: "insertCustomer",
                method: "POST",
                data: {
                    // item_code: item_code,
                    "_token": "{{ csrf_token() }}",
                    cust_id: $("#cust_id").val(),
                    row: count,
                    buy_domain: buy_domain,
                    subsys_art_no: subsys_art_no,
                    subsys_art_name: subsys_art_name,
                    status: status,
                    qty_of_month: qty_of_month,
                    sales: sales,
                    colli: colli,
                    invoices: invoices,
                    // sales_per_month: sales_per_month,
                    // colli_per_month: colli_per_month,
                    // invoices_per_month: invoices_per_month,

                },

                success: function(data) {
                    console.log(data);
                    $("td[contentEditable='true']").text("");
                    for (var i = 2; i <= count; i++) {
                        $('tr#' + i + '').remove();
                    }
                    //  fetch_item_data();
                    $('.addNew').modal('hide');
                    alert("Data Inserted" + data);
                }
            });

        });

        /* function fetch_item_data() {
                    $.ajax({
                        url: "/customer-offer-data",
                        method: "POST",
                        data: {
                            cOfferID: $("#cust_id").val(),
                        },
                        success: function(data) {
                            $('#inserted_item_data').html(data);
                        }
                    })
                }
                fetch_item_data(); */
    });

    //Add new row/article to existance table JS
    $(document).ready(function() {
        var table = $('.final_table').DataTable({
            "scrollY": "auto",
            "scrollX": true,
            "ordering": false,
            "lengthMenu": [
                [50, 150, 200, -1],
                [50, 150, 200, "All"]
            ]
        });


        $('.final_table tbody').on('click', 'tr', function() {
            $(this).toggleClass('selected');
        });


        $("#customer-offer").click(function() {
            var cOfferIDs = [];

            // $(".custom-control-input:checked").each(function() {
            //     cOfferIDs.push($(this).val());
            // });

            var ids = $.map(table.rows('.selected').data(), function(item) {
                return item[0];
            });

            cOfferIDs = ids;

            if (cOfferIDs.length > 0) {
                $('#customer-offer').prop('disabled', true);
                var token = $('meta[name="_token"]').attr('content');

                var cust_id = jQuery("#cust_id").val();
                console.log(cust_id);

                var cust_unique = $(".c_unique").val();
                var selected_quarter = $(".selected_quarter").val();

                var selected_artCategory = $(".selected_artCategory").val();
                var selected_channel = $(".selected_channel").val();
                var selected_yearId = $(".selected_yearId").val();
                var selected_monthId = $(".selected_monthId").val();

                $('<form>', {
                    "id": "customerOfferFrom",
                    "html": '<input type="text" id="cOfferID" name="cOfferID" value="' + cOfferIDs + '" /> <input type="text" id="cust_unique" name="cust_unique" value="' + cust_unique + '" /> <input type="text" id="token" name="_token" value="' + token + '" /> <input type="text" id="cust_id" name="cust_id" value="' + cust_id + '" />  <input type="text" id="sel_quarter" name="sel_quarter" value="' + selected_quarter + '" /> <input type="text" id="sel_quarter" name="sel_quarter" value="' + selected_quarter + '" /><input type="text" id="sel_artCategory" name="sel_artCategory" value="' + selected_artCategory + '" /><input type="text" id="sel_channel" name="sel_channel" value="' + selected_channel + '" /><input type="text" id="sel_yearId" name="sel_yearId" value="' + selected_yearId + '" /><input type="text" id="sel_monthId" name="sel_monthId" value="' + selected_monthId + '" /> ',

                    "action": "{{route('customer-offer-data')}}",
                    "method": "POST"
                }).appendTo(document.body).submit();

            }

        });

    });


    // Backcbonus Calculation JS
    $(document).ready(function() {

        //insert Ero symbol before amount
        $('input.amount, input.from_amount, input.to_amount ').keyup(function() {
            $(this).val(function(i, v) {
                return '€' + v.replace('€', ''); //remove exisiting, add back.
            });
        });

        //insert % symbol after percent digit
        $('input.percent, input.percentage').keyup(function() {
            $(this).val(function(i, v) {
                return v.replace('%', '') + '%'; //remove exisiting, add back.
            });
        });

        //get unique customer no. on change of cust. ICO
        /*  $('#row1 .cust_HO_no select[name="customer_ico"]').on('change', function() {
            $(".row_count1").find(".selected_ico").val(this.value);

            var selected_ico = $(".row_count1").find(".selected_ico").val();
            if (selected_ico) {
                $.ajax({
                    url: 'get_uniqueCustomer',
                    data: {
                        selected_ico: selected_ico
                    },
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // $(".customer_unique").select2({
                        //     placeholder: {
                        //         id: '-1', // the value of the option
                        //         text: 'Select'
                        //     }
                        // });

                        $(".row_count1").find('td.linked_cust_no select[name="customer_unique"]').empty();
                        $(".row_count1").find('td.linked_cust_no select[name="customer_unique"]').append('<option value="" class="linked">Select</option>');
                        jQuery.each(data, function(key, value) {
                            $(".row_count1").find('td.linked_cust_no select[name="customer_unique"]').append('<option value="' + value.cust_no_unique + '">' + value.cust_no_unique + '</option>');
                        });

                    }
                });
            } else {
                $(".row_count1").find('td.linked_cust_no select[name="customer_unique"]').append('<option value="" class="linked">Select</option>');
            }
        });
        */

        $("#bb_table .row_count1 td.type1_bb .amount,#bb_table .row_count1 td.type1_bb .percent").on('click', function() {
            $(".row_count1 td.type2_bb").find('.addLevel').prop('disabled', true);
        });


        $("#bb_table .row_count1 td.type2_bb .addLevel").click(function() {
            $(".row_count1 td.type1_bb").find('.amount').prop('disabled', true);
            $(".row_count1 td.type1_bb ").find('.percent').prop('disabled', true);
        });


        var countt = 1;
        $('#addNewCustBB').click(function() {

            countt = countt + 1;
            var html_code = "<tr class='row_count" + countt + "' id='row" + countt + "'>";
            // html_code += "<td contenteditable='false' class='item_code'>" + count + "</td>"; 

            // html_code += '<td class="cust_HO_no"> <input type="hidden" class="selected_ico" value=""><select contenteditable="true" class="form-control customer_ico select2" name="customer_ico" id="customer_ico"><option selected="selected" value=""> Select</option></select> </td>';
            // html_code += '<td class="linked_cust_no"> <select contenteditable="true" class="form-control cust_HO1 select1 customer_unique" name="customer_unique" id="customer_unique"><option value="" class="linked"> Select</option></select> </td>';
            html_code += '<td><select contenteditable="true" class="form-control bulk" name="bulk"><option selected="selected" value="">Bulk </option><option value="limitBase">Limit Base </option><option value="limitAndBonusBase">Limit & Bonus Base </option><option value="excluded">Excluded</option></select></td>';
            html_code += '<td><select contenteditable="true" class="form-control spirits" name="spirits"><option selected="selected" value=""> Spirits </option><option value="limitBase">Limit Base </option><option value="limitAndBonusBase">Limit & Bonus Base </option><option value="excluded">Excluded</option></select></td>';
            html_code += '<td><select contenteditable="true" class="form-control regular" name="regular"><option selected="selected" value="">Regular </option><option value="limitBase">Limit Base </option><option value="limitAndBonusBase">Limit & Bonus Base </option><option value="excluded">Excluded</option></select></td>';
            html_code += '<td><select contenteditable="true" class="form-control promo" name="promo"><option selected="selected" value="">Promo </option><option value="limitBase">Limit Base </option><option value="limitAndBonusBase">Limit & Bonus Base </option><option value="excluded">Excluded</option></select></td>';
            html_code += '<td><select contenteditable="true" class="form-control cip" name="cip"><option selected="selected" value="">CIP </option><option value="limitBase">Limit Base </option><option value="limitAndBonusBase">Limit & Bonus Base </option><option value="excluded">Excluded</option></select></td>';
            html_code += '<td contenteditable="true" class="type1_bb"><input type="text" value="" name="amount" placeholder="Amount" class="amount form-control"><input type="text" value="" placeholder="Percent" class="percent form-control">';
            html_code += '<td class="type2_bb"><button type="button" class="btn btn-primary addLevel" data-toggle="modal" data-target=".addRange' + countt + '"> Add Level </button></td>';
            html_code += "<td><button type='button' name='remove' data-row='row" + countt + "' class='btn btn-danger btn-sm remove'>-</button></td>";
            html_code += "</tr>";
            $('#bb_table').append(html_code);

            var row_cnt = 0;
            $("#bb_table tbody tr").each(function(key, value) {

                row_cnt++;

                //find Add Level for each row and Disable the button
                $(".row_count" + row_cnt + " td.type1_bb .amount, .row_count" + row_cnt + " td.type1_bb .percent").on('click', function() {
                    $(".row_count" + row_cnt + " td.type2_bb").find('.addLevel').prop('disabled', true);
                });

                //find Amt/percent fields for each row and disable it
                $(".row_count" + row_cnt + " td.type2_bb .addLevel").click(function() {
                    $(".row_count" + row_cnt).find('td.type1_bb .amount').prop('disabled', true);
                    $(".row_count" + row_cnt).find('td.type1_bb .percent').prop('disabled', true);

                    var modal_html = '<div class="modal fade addRange' + row_cnt + '" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="addRangeLabel"> Add levels/Ranges for backbonus </h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                    modal_html += '<div class="modal-body"><div class="table-responsive"><table class="table table-bordered" id="cust_table"><tr><th>Level 1</th><th>Level 2</th><th>Level 3</th><th>Level 4</th><th>Level 5</th></tr>';
                    modal_html += '<tr class="row_count' + row_cnt + '" id="row"' + row_cnt + '">';
                    modal_html += '<td contenteditable="true" class="level_1"><div class="full_div"><div class="half_div first"><input type="text" rowspan="2" value="" placeholder="From_1" class="from_amount form-control"><input type="text" rowspan="2" value="" placeholder="to_1" class="to_amount form-control"></div><div class="half_div"> <input type="text" rowspan="1" value="" placeholder="%" class="percentage form-control"></div></div></td>';
                    modal_html += '<td contenteditable="true" class="level_2"><div class="full_div"><div class="half_div first"><input type="text" rowspan="2" value="" placeholder="From_2" class="from_amount form-control"><input type="text" rowspan="2" value="" placeholder="To_2" class="to_amount form-control"></div><div class="half_div"> <input type="text" rowspan="1" value="" placeholder="%" class="percentage form-control"></div></div></td>';
                    modal_html += '<td contenteditable="true" class="level_3"><div class="full_div"><div class="half_div first"><input type="text" rowspan="2" value="" placeholder="From_3" class="from_amount form-control"><input type="text" rowspan="2" value="" placeholder="To_3" class="to_amount form-control"></div><div class="half_div"> <input type="text" rowspan="1" value="" placeholder="%" class="percentage form-control"></div></div></td>';
                    modal_html += '<td contenteditable="true" class="level_4"><div class="full_div"><div class="half_div first"><input type="text" rowspan="2" value="" placeholder="From_4" class="from_amount form-control"><input type="text" rowspan="2" value="" placeholder="To_4" class="to_amount form-control"></div><div class="half_div"> <input type="text" rowspan="1" value="" placeholder="%" class="percentage form-control"></div></div></td>';
                    modal_html += '<td contenteditable="true" class="level_5"><div class="full_div"><div class="half_div first"><input type="text" rowspan="2" value="" placeholder="From_5" class="from_amount form-control"><input type="text" rowspan="2" value="" placeholder="To_5" class="to_amount form-control"></div><div class="half_div"> <input type="text" rowspan="1" value="" placeholder="%" class="percentage form-control"></div></div></td>';
                    modal_html += '</tr></table></div></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary" id="save_customer1">Save changes</button></div></div></div></div>';

                    $(".dynamic_modal").append(modal_html);

                    $('input.from_amount, input.to_amount ').keyup(function() {
                        $(this).val(function(i, v) {
                            return '€' + v.replace('€', ''); //remove exisiting, add back.
                        });
                    });

                    $('input.percentage').keyup(function() {
                        $(this).val(function(i, v) {
                            return v.replace('%', '') + '%'; //remove exisiting, add back.
                        });
                    });

                });


                $('input.amount').keyup(function() {
                    $(this).val(function(i, v) {
                        return '€' + v.replace('€', ''); //remove exisiting, add back.
                    });
                });

                $('input.percent').keyup(function() {
                    $(this).val(function(i, v) {
                        return v.replace('%', '') + '%'; //remove exisiting, add back.
                    });
                });

                //Display alert/Error message 
                $('.row_count' + row_cnt + ' .bulk').on('change', function() {
                    if ($(this).val() != $(".row_count1 .bulk").val()) {
                        $.alert({
                            title: 'Warning !!',
                            content: 'SELECTED NOT MATCHED',
                            closeIcon: true
                        });

                        $(this).prop('selectedIndex', 0);
                        return false;
                    }
                });





                /*
                //Append ico numbers in select boxes for each new row
                $.ajax({
                    url: 'bb_preRequestedData',
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $(".customer_ico").select2({});

                        $(".row_count" + row_cnt).find('td.cust_HO_no select[name="customer_ico"]').empty();
                        $(".row_count" + row_cnt).find('td.cust_HO_no select[name="customer_ico"]').append('<option value="">Select</option>');
                        jQuery.each(data, function(key, value) {
                            $(".row_count" + row_cnt).find('td.cust_HO_no select[name="customer_ico"]').append('<option value="' + value.ico + '">' + value.ico + '</option>');
                        });
                    }
                });


                //Get unique cust. no on change of ICO no. for each row
                $('.row_count' + row_cnt + ' .cust_HO_no select[name="customer_ico"]').on('change', function() {

                    var class_name = $(this).parent().parent().attr('class');

                    $(this).parent().find(".selected_ico").val(this.value);

                    var selected_ico = $(this).parent().find(".selected_ico").val();
                    // if (selected_ico != "") {
                    $.ajax({
                        url: 'get_uniqueCustomer',
                        data: {
                            selected_ico: selected_ico
                        },
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            // $(".customer_unique").select2({
                            //     placeholder: {
                            //         id: '-1', // the value of the option
                            //         text: 'Select'
                            //     }
                            // });

                            if (class_name == "row_count" + row_cnt) {

                                $(".row_count" + row_cnt).find('td.linked_cust_no select[name="customer_unique"]').empty();
                                $(".row_count" + row_cnt).find('td.linked_cust_no select[name="customer_unique"]').append('<option class="linked" value="">Select</option>');
                                jQuery.each(data, function(key, value) {
                                    $(".row_count" + row_cnt).find('td.linked_cust_no select[name="customer_unique"]').append('<option value="' + value.cust_no_unique + '">' + value.cust_no_unique + '</option>');
                                });

                            }

                        }
                    });
                    // } else {
                    //     $(".row_count" + row_cnt).find('td.linked_cust_no select[name="customer_unique[]"]').append('<option value=""> Select</option>');
                    // }
                }); */

            }) // each row ends


        }); // New row addition fun. ends


        $(document).on('click', '.remove', function() {
            var delete_row = $(this).data("row");
            $('#' + delete_row).remove();
        });




        $("#calculate_backBonus").on('click', function() {
            if ($('.amount').val().length > 0) {
                if ($('.percent').val().length > 0) {

                    $('.error').fadeOut("fast", function() {});

                    // if ($('.amount').val().length == 0 || $('.from_amount').val().length == 0) {
                    //     $(".bb_returns").hide();
                    // } else {

                    var row = [];
                    // var customer_ico = [];
                    var customer_unique = [];
                    var bulk = $(".bulk").val();
                    var spirits = $(".spirits").val();
                    var regular = $(".regular").val();
                    var promo = $(".promo").val();
                    var cip = $(".cip").val();
                    var amount = $(".amount").val();
                    var percent = $(".percent").val();
                    var from_amount = [];
                    var to_amount = [];
                    var percentage = [];

                    $('.row_count').each(function() {
                        row.push($(this).text());
                    });

                    $('.selected_unique').each(function() {
                        customer_unique.push($(this).val());
                    });

                    $('.from_amount').each(function() {
                        from_amount.push($(this).val().replace("€", ""));
                    });
                    $('.to_amount').each(function() {
                        to_amount.push($(this).val().replace("€", ""));
                    });

                    $('.percentage').each(function() {
                        percentage.push($(this).val().replace("%", ""));
                    });


                    $.ajax({
                        url: "calculate_backBonus",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            rows: countt,
                            customer_ico: $(".selected_ico").val(),
                            customer_unique: customer_unique,
                            selected_quarter: $(".selected_quarter").val(),
                            selected_artCategory: $(".selected_artCategory").val(),
                            selected_channel: $(".selected_channel").val(),
                            selected_yearId: $(".selected_yearId").val(),
                            selected_monthId: $(".selected_monthId").val(),
                        },

                        success: function(data) {
                            // console.log(data.data[0][0]);
                            // console.log(data.data[1][0]);

                            var bulk_sales_sum = [];
                            var spirit_sales_sum = [];
                            var regular_sales_sum = [];
                            var promo_sales_sum = [];
                            var cip_sales_sum = [];

                            var historical = [];
                            var arr_count = "";
                            $(data.data).each(function(key, index) {
                                //    console.log(data.data.length);
                                console.log(key);
                                console.log(index[0]);

                                arr_count = data.data.length;
                                // if (index[0].spirit_sales == null) {
                                //     console.log("Spirit 0");
                                // } else {
                                //     console.log(index[0].spirit_sales);
                                // }

                                bulk_sales_sum.push(index[0].bulk_sales);
                                spirit_sales_sum.push(index[0].spirit_sales);
                                regular_sales_sum.push(index[0].regular_sales);
                                promo_sales_sum.push(index[0].promo_sales);
                                cip_sales_sum.push(index[0].cip_sales);

                                historical.push(index[0].oti_percentage);
                                // console.log(index[0].bulk_sales);

                            });

                            //Calculate Sum of all Sales individually
                            var bulk_sum = eval(bulk_sales_sum.join("+"));
                            var spirit_sum = eval(spirit_sales_sum.join("+"));
                            var regular_sum = eval(regular_sales_sum.join("+"));
                            var promo_sum = eval(promo_sales_sum.join("+"));
                            var cip_sum = eval(cip_sales_sum.join("+"));

                            var hist_sum = eval(historical.join("+"));
                            //    var arr_cnt = eval(arr_count.join("+") + 1 );

                            console.log(hist_sum);
                            console.log(arr_count);

                            var historical_otiSum = hist_sum / arr_count;


                            //Calculate Limit Base
                            var Limit_base = [];
                            if ($(".bulk").val() == "limitBase" || $(".bulk").val() == "limitAndBonusBase") {
                                Limit_base.push(bulk_sum);
                            }
                            if ($(".spirits").val() == "limitBase" || $(".spirits").val() == "limitAndBonusBase") {
                                Limit_base.push(spirit_sum);
                            }
                            if ($(".regular").val() == "limitBase" || $(".regular").val() == "limitAndBonusBase") {
                                Limit_base.push(regular_sum);
                            }
                            if ($(".promo").val() == "limitBase" || $(".promo").val() == "limitAndBonusBase") {
                                Limit_base.push(promo_sum);
                            }
                            if ($(".cip").val() == "limitBase" || $(".cip").val() == "limitAndBonusBase") {
                                Limit_base.push(cip_sum);
                            }

                            var limit_base_amount = eval(Limit_base.join("+")).toFixed(2);

                            //Calculate Bonus Base
                            var bonus_base = [];
                            if ($(".bulk").val() == "limitAndBonusBase") {
                                bonus_base.push(bulk_sum);
                            }
                            if ($(".spirits").val() == "limitAndBonusBase") {
                                bonus_base.push(spirit_sum);
                            }
                            if ($(".regular").val() == "limitAndBonusBase") {
                                bonus_base.push(regular_sum);
                            }
                            if ($(".promo").val() == "limitAndBonusBase") {
                                bonus_base.push(promo_sum);
                            }
                            if ($(".cip").val() == "limitAndBonusBase") {
                                bonus_base.push(cip_sum);
                            }
                            var bonus_base_amount = eval(bonus_base.join("+")).toFixed(2);


                            //Check if Amount/Percent is added then calculate BackBonus
                            var bonus_amount = $(".amount").val().replace("€", "");
                            var bonus_percent = $(".percent").val().replace("%", "");
                            var back_bonus = 0;
                            if (limit_base_amount && bonus_percent != "") {
                                if (parseFloat(limit_base_amount) > parseFloat(bonus_amount)) {
                                    console.log('%' + bonus_percent);
                                    var back_bonus = parseFloat(limit_base_amount) * (parseFloat(bonus_percent) / 100);
                                    back_bonus = back_bonus.toFixed(2);
                                }
                            }

                            //Check if Amount-Levels are added then calculate BackBonus
                            if (limit_base_amount && percentage != "") {
                                $(from_amount).each(function(f_key, f_index) {

                                    if (parseFloat(limit_base_amount) >= parseFloat(from_amount[f_key]) && parseFloat(limit_base_amount) < parseFloat(to_amount[f_key])) {
                                        var bb = parseFloat(limit_base_amount) * parseFloat(percentage[f_key] / 100);
                                        if (bb == "undefined") {
                                            back_bonus = 0;
                                        } else {
                                            back_bonus = bb.toFixed(2);
                                        }

                                    }
                                    // console.log("backBonus " + back_bonus);

                                });
                            }

                            //   console.log("backBon " + back_bonus);


                            //Append Result to div 
                            $(".bb_returns").show("slide", {
                                direction: "left"
                            }, 1000);

                            $("#backBonus").text(" = € " + back_bonus);
                            $("#backBonus_amt").text(back_bonus);
                            $("#limitBase").text(" = € " + limit_base_amount);
                            $("#bonusBase").text(" = € " + bonus_base_amount);
                            $("#historical_oti").text(" = " + historical_otiSum.toFixed(2) + "%");

                            $("#calculate_backBonus").prop("disabled", true);
                            $("#calculate").prop("disabled", false);

                        }

                    }); //Ajax end
                    // }




                } else {
                    $('<div class="error"> Enter percent(%) </div>').insertAfter(".BonusType_error");
                    $('.percent').prop("required", true);
                }
                $('.BonusType_error').fadeOut("fast", function() {});
            } else {
                if ($('.percent').val().length > 0) {
                    $('.BonusType_error').fadeOut("fast", function() {});
                    $('<div class="error"> Enter amount(€) </div>').insertAfter(".BonusType_error");
                } else {
                    $('.BonusType_error').fadeIn("slow", function() {});
                }
            }

        });

    }); //ready end
</script>
@endpush


@endsection