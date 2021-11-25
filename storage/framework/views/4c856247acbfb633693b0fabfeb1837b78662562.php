
<?php $__env->startSection('title', $role->name.' - Edit Role'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-award bg-blue"></i>
                        <div class="d-inline">
                            <h5><?php echo e(__('Edit Role')); ?></h5>
                            <span><?php echo e(__('Edit role & associate permissions')); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(url('dashboard')); ?>"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#"><?php echo e(__('Role')); ?></a>
                            </li>
                            <li class="breadcrumb-item">
                                <!-- clean unescaped data is to avoid potential XSS risk -->
                                <?php echo e($role->name); ?>

                            </li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
	<div class="row clearfix">
        <!-- start message area-->
        <?php echo $__env->make('include.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- end message area-->
		<div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3><?php echo e(__('Edit Role')); ?></h3></div>
                <div class="card-body">
                    <form class="forms-sample" method="POST" action="<?php echo e(url('role/update')); ?>">
                    	<?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="role"><?php echo e(__('Role')); ?><span class="text-red">*</span></label>
                                    <input type="text" class="form-control is-valid" id="role" name="role" value="<?php echo e($role->name); ?>" placeholder="Insert Role">
                                    <input type="hidden" name="id" value="<?php echo e($role->id); ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <label for="exampleInputEmail3">&nbsp;</label>
                                
                                
                                <div class="form-group">
                                	<button type="submit" class="btn btn-primary btn-rounded"><?php echo e(__('Update')); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\server\htdocs\e-expense-portal\resources\views/roles/edit-roles.blade.php ENDPATH**/ ?>