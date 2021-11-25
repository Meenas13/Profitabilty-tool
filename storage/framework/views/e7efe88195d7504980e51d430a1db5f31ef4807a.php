 
<?php $__env->startSection('title', 'Permission'); ?>
<?php $__env->startSection('content'); ?>
    <!-- push external head elements to head -->
    <?php $__env->startPush('head'); ?>
        
    <?php $__env->stopPush(); ?>

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-unlock bg-blue"></i>
                        <div class="d-inline">
                            <h5><?php echo e(__('Permissions')); ?></h5>
                            <span><?php echo e(__('Define permissions of user')); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="../index.html"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#"><?php echo e(__('Permissions')); ?></a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row clearfix">
           
            <!-- only those have manage_permission permission will get access -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_permission')): ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3><?php echo e(__('Add Permission')); ?></h3></div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="<?php echo e(url('permission/create')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="permission"><?php echo e(__('Permission')); ?><span class="text-red">*</span></label>
                                        <input type="text" class="form-control" id="permission" name="permission" placeholder="Permission Name" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="exampleInputEmail3">&nbsp;</label>
                                    <div class="form-group">
                                        <input type="hidden" name="roleId" value="<?php echo e($roleId); ?>">
                                        <button type="submit" class="btn btn-primary btn-rounded"><?php echo e(__('Save')); ?></button>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="<?php echo e(url('permission/update')); ?>">
                        <?php echo csrf_field(); ?>
                        <table id="permission_table" class="table">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('#')); ?></th>
                                    <th><?php echo e(__('Permission')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($permissions as $key => $permission){
                                    $listChecked = ""; 
                                    if(!empty($data[$key])){
                                        $listChecked = 'checked';
                                    }
                                    
                                ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="lists[<?php echo e($key); ?>]"  value="1" <?php echo e($listChecked); ?>>
                                        
                                    </td>
                                    <td><?php echo e($permission); ?></td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="<?php echo e(url('permission/delete/')); ?><?php echo e($key); ?>">
                                                <i class="ik ik-trash-2 f-16 text-red"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                               <?php } ?>
                            </tbody>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="col-md-12 text-right">
                            <div class="form-group">
                                <br/><br/>
                                 <input type="hidden" name="roleId" value="<?php echo e($roleId); ?>">
                                 <button type="submit" class="btn btn-primary waves-effect waves-light me-1"><?php echo e(__('Update')); ?></button>
                                 
                                <a href="<?php echo e(url('roles')); ?>" class="btn btn-secondary waves-effect back"><?php echo e(__('Back')); ?></a>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    <?php $__env->startPush('script'); ?>
    

    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\server\htdocs\e-expense-portal\resources\views/permission/index.blade.php ENDPATH**/ ?>