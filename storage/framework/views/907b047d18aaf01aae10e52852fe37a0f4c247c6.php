 
<?php $__env->startSection('title', 'Session Timeout'); ?>
<?php $__env->startSection('content'); ?>
    <!-- push external head elements to head -->
    <?php $__env->startPush('head'); ?>
        <title><?php echo e(__('Session Timeout | Laravel Admin Template - Themekit')); ?></title>
    <?php $__env->stopPush(); ?>

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-package bg-blue"></i>
                        <div class="d-inline">
                            <h5><?php echo e(__('Session Timeout')); ?></h5>
                            <span><?php echo e(__('lorem ipsum dolor sit amet, consectetur adipisicing elit')); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(route('dashboard')); ?>"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#"><?php echo e(__('UI')); ?></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#"><?php echo e(__('Extra')); ?></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Session Timeout')); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3><?php echo e(__('Session Timeout')); ?></h3>
                    </div>
                    <div class="card-block">
                        <p class="m-0">
                            With these settings, session timeout plugin launches a timeout warning dialog in a fixed amount of time regardless of user activity. In this demo warning dialog appears <b>after 3 seconds</b>                                                            of page load.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- push external js -->
    <?php $__env->startPush('script'); ?>     
        <script src="<?php echo e(asset('js/session-time-out.js')); ?>"></script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
       
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\server\htdocs\profitability-tool\resources\views/pages/ui/session-timeout.blade.php ENDPATH**/ ?>