
<?php $__env->startSection('title', 'Offer'); ?>
<?php $__env->startSection('content'); ?>

<!-- offer page/ Forcasted OTI view blade -->
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-user-plus bg-primary"></i>
                    <div class="d-inline">
                        <h5>Offer</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(url('customer')); ?>"><i class="ik ik-home"></i></a>
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
                <div class="card-body">
                    <table id="advanced_table1" class="table display nowrap final_table table-bordered" style="width:100%">
                        <span id="backBonus_amt" style="display: none;"></span>
                        <thead style="text-align: left;">
                            <tr valign="center">
                                <th width="15%">Buy Domain</th>
                                <th width="15%">Subsys Art. No</th>
                                <th width="15%">Subsys Art. Name</th>
                                <th width="15%"> Status</th>
                                <th>Colli</th>
                                <th>Requested Price / MU</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr <?php if ($offer->delivery_flag_name == "Delivery") { ?> style="background-color: rgb(255 241 185);" <?php } ?>>
                                <input type="hidden" name="buy_domain_no[]" class="buy_domain_no" value="<?php echo $offer->buy_domain_no; ?>">
                                <input type="hidden" name="subsys_art_no[]" class="subsys_art_no" value="<?php echo $offer->subsys_art_no; ?>">
                                <input type="hidden" name="buy_subsys_no[]" class="buy_subsys_no" value="<?php echo $offer->buy_subsys_no; ?>">
                                <td><?php echo e($offer->buy_domain); ?></td>
                                <td><?php echo e($offer->subsys_art_no); ?></td>
                                <td><?php echo e($offer->subsys_art_name); ?></td>
                                <td><?php echo e($offer->status_article); ?></td>
                                <td><input type="text" name="collis[]" value="" class="form-control collis"></td>
                                <td> <input type="text" name="selling[]" value="" class="form-control selling"></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="card-options text-right mt-5">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".add_newItem"> &nbsp; &#43; &nbsp; </button>
                        <input type="hidden" id="cust_id" value="<?php echo $cust_id; ?>">
                        <button type="button" id="calculate1" class="btn btn-primary mt-5 mb-2" disabled style="display: none;">Calculate</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Back Bonus Calculations container -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <br>
                <div style="text-align: center !important;" class="card-options">
                    <h3 style="background-color:#f2f5f7"> Back Bonus Calculations </h3>
                </div>

                <div class="card-body">
                    <div class="card-options">
                        <div class="row">
                            <div class="col-md-4"><label> ICO: </label><input readonly type="text" class="selected_ico form-control" value="<?php echo $cust_ico; ?>"></div>
                            <div class="col-md-4"><label> Unique No. : </label><input readonly type="text" class="form-control c_unique" value="<?php echo $unique_implode;  ?>"></div>
                            <div class="col-md-4"><label> Quarters :</label><input readonly type="text" value="<?php echo str_replace("'", "", $selected_quarter_implode); ?>" class="form-control"></div>
                            <input readonly type="hidden" value="<?php echo $selected_artCategory; ?>" name="selected_artCategory[]" class="selected_artCategory">
                            <input readonly type="hidden" value="<?php echo $selected_channel; ?>" name="selected_channel" class="selected_channel">
                            <input readonly type="hidden" value="<?php echo $selected_yearId; ?>" name="selected_yearId" class="selected_yearId">
                            <input readonly type="hidden" value="<?php echo $selected_monthId; ?>" name="selected_monthId" class="selected_monthId">

                            <?php
                            if ($cust_unique) {
                                foreach ($cust_unique as $un_number) { ?>
                                    <input readonly type="hidden" value="<?php echo $un_number; ?>" name="selected_unique" class="selected_unique">
                                <?php }
                            } else {
                                ?>
                                <input readonly type="hidden" value="<?php echo "NULL"; ?>" name="selected_unique" class="selected_unique">
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
                                    <th>BULK</th>
                                    <th>SPIRITS</th>
                                    <th>REGULAR</th>
                                    <th>PROMO</th>
                                    <th>CIP</th>
                                    <th>Type 1</th>
                                    <th>Type 2</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="row_count1" id='row1'>
                                    <td>
                                        <select contenteditable="true" required class="form-control bulk" name="bulk">
                                            <option selected="selected" value="">Select </option>
                                            <option value="limitBase">Limit Base </option>
                                            <option value="limitAndBonusBase">Limit & Bonus Base </option>
                                            <option value="excluded">Excluded</option>
                                        </select>

                                    </td>
                                    <td> <select contenteditable="true" required class="form-control spirits" name="spirits">
                                            <option selected="selected" value="">Select </option>
                                            <option value="limitBase">Limit Base </option>
                                            <option value="limitAndBonusBase">Limit & Bonus Base </option>
                                            <option value="excluded">Excluded</option>
                                        </select>

                                    </td>
                                    <td> <select contenteditable="true" required class="form-control regular" name="regular">
                                            <option selected="selected" value=""> Select </option>
                                            <option value="limitBase">Limit Base </option>
                                            <option value="limitAndBonusBase">Limit & Bonus Base </option>
                                            <option value="excluded">Excluded</option>
                                        </select>
                                    </td>
                                    <td> <select contenteditable="true" required class="form-control promo" name="promo">
                                            <option selected="selected" value="">Select </option>
                                            <option value="limitBase">Limit Base </option>
                                            <option value="limitAndBonusBase">Limit & Bonus Base </option>
                                            <option value="excluded">Excluded</option>
                                        </select>
                                    </td>
                                    <td> <select contenteditable="true" required class="form-control cip" name="cip">
                                            <option selected="selected" value="">Select </option>
                                            <option value="limitBase">Limit Base </option>
                                            <option value="limitAndBonusBase">Limit & Bonus Base </option>
                                            <option value="excluded">Excluded</option>
                                        </select>
                                    </td>
                                    <td contenteditable="true" class="type1_bb">
                                        <input type="text" value="" placeholder="Amount" class="amount form-control" width="50%">
                                        <input type="text" value="" placeholder="Percent" class="percent form-control" width="50%">
                                    </td>
                                    <td class="type2_bb">
                                        <button type="button" class="btn btn-primary addLevel" data-toggle="modal" data-target=".addRange"> Add Level </button>
                                    </td>
                                    <td>
                                        <a id="refresh_bonusTypes">&#8634; </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <span class="bt_error">Vyberte Všetky typy</span>

                        <div class="col-12 col-md-12 col-lg-12" align="right">
                            <button type="button" name="addNewCustBB" id="addNewCustBB" style="display: none;" class="btn btn-success btn-sm">+</button>
                        </div>
                        <br>

                        <div class="BonusType_error" style="display: none;"> * Zadajte buď bonus typu 1 alebo typu 2 </div>
                        <div class="bb_returns" style="display: none;">
                            <h5> Back Bonus <span id="backBonus"></span> </h5>
                            <h5> Limit Base <span id="limitBase"></span> </h5>
                            <h5> Bonus Base <span id="bonusBase"></span> </h5>

                            <h4> Historical OTI% <span id="historical_oti"> </span></h4>
                        </div>
                    </div>
                    </br>
                    <div style="text-align: right !important;" class="card-options">
                        <button type="button" id="calculate_backBonus" class="btn btn-info btn-large">Calculate Back Bonus</button>
                        <button type="button" id="calculate" class="btn btn-warning btn-large">Calculate OTI</button>
                    </div>
                </div>

                <br><br>
                <div style="text-align: center !important;" class="card-options">
                    <h3 style="background-color:#f2f5f7">Forecasted OTI = <span id="forecasted">0%</span></h3>
                </div>
                <br> <br>
            </div> <!-- Card End -->
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
                        <thead>
                            <tr>
                                <th>Level 1</th>
                                <th>Level 2</th>
                                <th>Level 3</th>
                                <th>Level 4</th>
                                <th>Level 5</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="row_count1" id='row1'>
                                <td class="level_1">
                                    <div class="full_div">
                                        <div class="half_div first">
                                            <input type="text" rowspan="2" value="" placeholder="From_1" class="from_amount form-control">
                                            <input type="text" rowspan="2" value="" placeholder="to_1" class="to_amount form-control">
                                        </div>
                                        <div class="half_div"> <input type="text" rowspan="1" value="" placeholder="%" class="percentage form-control">
                                        </div>
                                    </div>
                                </td>
                                <td class="level_2">
                                    <div class="full_div">
                                        <div class="half_div first">
                                            <input type="text" rowspan="2" value="" placeholder="From_2" class="from_amount form-control">
                                            <input type="text" rowspan="2" value="" placeholder="To_2" class="to_amount form-control">
                                        </div>
                                        <div class="half_div"> <input type="text" rowspan="1" value="" placeholder="%" class="percentage form-control">
                                        </div>
                                    </div>
                                </td>
                                <td class="level_3">
                                    <div class="full_div">
                                        <div class="half_div first">
                                            <input type="text" rowspan="2" value="" placeholder="From_3" class="from_amount form-control">
                                            <input type="text" rowspan="2" value="" placeholder="To_3" class="to_amount form-control">
                                        </div>
                                        <div class="half_div"> <input type="text" rowspan="1" value="" placeholder="%" class="percentage form-control">
                                        </div>
                                    </div>
                                </td>
                                <td class="level_4">
                                    <div class="full_div">
                                        <div class="half_div first">
                                            <input type="text" rowspan="2" value="" placeholder="From_4" class="from_amount form-control">
                                            <input type="text" rowspan="2" value="" placeholder="To_4" class="to_amount form-control">
                                        </div>
                                        <div class="half_div"> <input type="text" rowspan="1" value="" placeholder="%" class="percentage form-control">
                                        </div>
                                    </div>
                                </td>
                                <td class="level_5">
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
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add New item from existing list -->
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
                <table id="advanced_table" class="table table-bordered AddArticle display nowrap final_table" style="width:100%">
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
                                            <input type="checkbox" class="custom-control-input select_all_child" <?php //if ($value->buy_subsys_no == in_array($value->buy_subsys_no, $selected_id)) { 
                                                                                                                    ?> checked <?php //} 
                                                                                                                                ?>id="" name="customer-id" value="<?php echo e($value->buy_subsys_no); ?>">
                                            <span class="custom-control-label">&nbsp;</span>
                                        </label>
                                    </td> -->

                                    <td style="display: none;"> <?php echo e($value->buy_subsys_no); ?> </td>
                                    <td> <?php echo e($value->buy_domain); ?></td>
                                    <td><?php echo e($value->subsys_art_no); ?></td>
                                    <td><?php echo e($value->subsys_art_name); ?></td>
                                    <td><?php echo e($value->status_article); ?></td>
                                    <td><?php echo e($value->qtymonths); ?></td>
                                    <td><?php echo e(round($value->sales,2)); ?></td>
                                    <td><?php echo e(round($value->colli,2)); ?></td>
                                    <td><?php echo e($value->noofinvoice); ?></td>
                                    <td><?php echo e(round($value->sales_per_month)); ?></td>
                                    <td><?php echo e(round($value->colli_per_month)); ?></td>
                                    <td><?php echo e(round($value->invoices_per_month)); ?></td>
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

<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('js/module-js/offerlist_oti.js')); ?>"></script>
<?php $__env->stopPush(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\profitability-tool\resources\views/customer/offer.blade.php ENDPATH**/ ?>