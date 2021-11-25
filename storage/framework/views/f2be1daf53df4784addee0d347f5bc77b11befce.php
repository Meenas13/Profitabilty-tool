 
<?php $__env->startSection('title', 'Add Sale'); ?>
<?php $__env->startSection('content'); ?>
	<div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-shopping-cart bg-blue"></i>
                        <div class="d-inline">
                            <h5>Add Sale</h5>
                            <span>Create Sales Entry</span>
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
                                <a href="#">Add Sale</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            <div class="col-md-12">
        </div>            <!-- end message area-->
            <div class="col-md-12">
                <form class="forms-sample" method="POST" action="">
                    <input type="hidden" name="_token" value="k4JC0rIKsVlV9AR9NCn4JfVS7hvobvmKTZm9pwR6">                    <div class="row">
                        
                        <div class="col-md-3 pr-0">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="text" class="form-control datetimepicker-input" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker" placeholder="Select Date">
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-10 pr-0">
                                                <label>Customer</label>

                                                <select class="form-control select2">
                                                	<option selected="selected" value="" data-select2-id="3">Select Customer</option>
                                                	<option value="1">Alex Ferguson</option>
                                                	<option value="2">John Doe</option></select>
                                                
                                            </div>
                                            <div class="col-sm-2 pl-1 pt-1">
                                                <button type="button" class="mt-4 btn btn-sm btn-primary" data-toggle="modal" data-target="#CustomerAdd">+</button>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>Reference NO</label>
                                        <input type="text" class="form-control" placeholder="Enter Reference NO">
                                    </div>
                                    <div class="form-group">
                                        <label>Tax (%)</label>
                                        <input type="text" class="form-control" placeholder="Enter Tax" value="10">
                                    </div>
                                    <div class="form-group">
                                        <label>Note</label>
                                        <textarea class="form-control h-123" name="note" placeholder="Enter Note"></textarea> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input type="text" class="form-control" name="product">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input type="text" class="form-control"  name="qty">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="text" class="form-control" name="price">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <label>&nbsp;</label>
                                            <div class="form-group">
                                                 <div type="submit" class="btn btn-primary" id="add-product">Add</div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                                
                                    <div class="salestable">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="wp-10">SL</th>
                                                    <th class="wp-40">Product</th>
                                                    <th class="wp-20">Unit Price</th>
                                                    <th class="wp-15">Qty</th>
                                                    <th class="wp-15">Sub Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody"></tbody>
                                            <tfooter>
                                                
                                                <tr>
                                                    <th class="border-0" colspan="3"></th>
                                                    <th>Total</th>
                                                    <th class="text-right">$ 620.00</th>
                                                </tr>
                                                <tr>
                                                    <td class="border-0" colspan="3"></td>
                                                    <td>Tax (<span id="tax-per">10.00</span>%)</td>
                                                    <td class="text-right">$ 62.00</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-0" colspan="3"></td>
                                                    <td>Shipping</td>
                                                    <td class="text-right"><input type="text" name="shiping" class="form-control w-60 text-center hm-30 ml-auto" value="50.00"></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-0" colspan="3"></td>
                                                    <td>Discount</td>
                                                    <td class="text-right"><input type="text" name="discount" class="form-control w-60 text-center hm-30 ml-auto" value="0.00"></td>
                                                </tr>
                                                <tr>
                                                    <th class="border-0" colspan="3"></th>
                                                    <th>Grand Total</th>
                                                    <th class="text-right">$ 732.00</th>
                                                </tr>
                                            </tfooter>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Sale Status</label>
                                                <select class="form-control" name="sale_status">
                                                    <option selected="">Select Sale Status</option>
                                                    <option value="completed">Completed</option>
                                                    <option value="shipped">Shipped</option>
                                                    <option value="pending">Pending</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Payment Status</label>
                                                <select class="form-control" name="sale_status">
                                                    <option selected="">Select Payment Status</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="due">Due</option>
                                                    <option value="Paid">Paid</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Pay</label>
                                                <input type="text" name="pay" class="form-control text-center  ml-auto" value="" placeholder="Amount">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="pt-4 text-right">
                                                <div type="button" class="btn btn-danger" data-toggle="modal" data-target="#InvoiceModal">Preview Invoice</div>
                                                <div type="submit" class="btn btn-primary">Save</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                        
            </div>

                            
        </div>
    </div>
    <div class="modal fade edit-layout-modal pr-0 " id="CustomerAdd" role="dialog" aria-labelledby="CustomerAddLabel" aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CustomerAddLabel">Add Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label class="d-block">Customer Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Customer Name">
                        </div>
                        <div class="form-group">
                            <label class="d-block">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter Phone">
                        </div>
                        <div class="form-group">
                            <label class="d-block">City</label>
                            <input type="text" name="city" class="form-control" placeholder="Enter City">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="city" class="form-control" placeholder="Enter Address">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="Save" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script type="text/javascript">
    var counter = 1;
    $('#add-product').click(function(event){
        event.preventDefault();
       
        var newRow = $(`<tr>
            <td></td>
            <td><input type="text" name="products[]" class="form-control" value=""></td>
            <td><input type="text" name="qty[]" class="form-control" value=""></td>
            <td><input type="text" name="price[]" class="form-control" value=""></td>
            <td></td>
            </tr>
            `);
        $('#tbody').append(newRow);
        counter++;
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\server\htdocs\laravel-demo\resources\views/sales/create.blade.php ENDPATH**/ ?>