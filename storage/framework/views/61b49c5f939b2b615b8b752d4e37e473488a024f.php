
<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>

<!-- NNNBP UPDATE SCREEN page view blade -->
<section id="nnnbp_updatePage">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-primary"></i>
                        <div class="d-inline">
                            <h5>NNNBP UPDATE</h5>
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
                                <a href="#">NNNBP</a>
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
                        <table id="nnnbp_table" class="table display nowrap nnnbp_table table-bordered" style="width:100%">
                            <thead style="text-align: left;">
                                <tr>
                                    <th style="display: none;">buy_domain_no</th>
                                    <th>BUYER_UID</th>
                                    <th>NNNBP_SRC</th>
                                    <th>nnnbp_mav_cc</th>
                                    <th>nnnbp_reg_cc</th>
                                    <th>nnnbp_current_cc</th>
                                </tr>
                            </thead>
                            <?php $tr_cnt = 0; ?>
                            <tbody>
                                <?php $__currentLoopData = $buyer_uid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $tr_cnt++; ?>
                                <tr class="table_rowCnt<?php echo $tr_cnt; ?>">
                                    <td class="buy_domain_no" style="display: none;"><?php echo e($offer->buy_domain_no); ?> </td>
                                    <td class="buy_domain"><?php echo e($offer->buy_domain); ?></td>
                                    <td class="nnnbp_src"><?php echo e($offer->nnnbp_source); ?> </td>
                                    <td class="nnnbp_columns <?php if ($offer->nnnbp_source == "nnnbp_mav_cc") echo "selected_nnnbp"; ?>" id="nnnbp_mav_cc">
                                        <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider"></span>
                                        </label>
                                    </td>
                                    <td class="nnnbp_columns <?php if ($offer->nnnbp_source == "nnnbp_reg_cc") echo "selected_nnnbp"; ?>" id="nnnbp_reg_cc"> <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider"></span>
                                        </label>
                                    </td>
                                    <td class="nnnbp_columns <?php if ($offer->nnnbp_source == "nnnbp_current_cc") echo "selected_nnnbp"; ?>" id="nnnbp_current_cc"> <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider"></span>
                                        </label>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>BUYER_UID</th>
                                    <th>NNNBP_SRC</th>
                                    <th>nnnbp_mav_cc</th>
                                    <th>nnnbp_reg_cc</th>
                                    <th>nnnbp_current_cc</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('js/module-js/nnnbp_update.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\profitability-tool\resources\views/nnnbp/index.blade.php ENDPATH**/ ?>