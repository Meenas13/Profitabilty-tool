 
<?php $__env->startSection('title', __('Update Profile')); ?>
<?php $__env->startSection('content'); ?>
    

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-blue"></i>
                        <div class="d-inline">
                            <h5><?php echo e(__('Update Profile')); ?></h5>
                           
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12"> 
            </div>
            <div class="col-lg-4 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center"> 
                           <!--  <img src="../img/user.jpg" class="rounded-circle" width="150" /> -->
                            <?php if(file_exists(public_path('profile_img/'.$user->profile_img)) && $user->profile_img!=""): ?>
                             <img src="<?php echo e(asset('profile_img/'.$user->profile_img)); ?>" alt="Profile Image" class="rounded-circle" width="150">
                            <?php endif; ?> 
                            <h4 class="card-title mt-10"><?php echo e($user->name); ?></h4>
                            
                        </div>
                    </div>
                    <hr class="mb-0"> 
                    <div class="card-body"> 
                        <small class="text-muted d-block"><?php echo e(__('Email')); ?> </small>
                        <h6><?php echo e($user->email); ?></h6> 
                        <small class="text-muted d-block pt-10"><?php echo e(__('Phone No')); ?></small>
                        <h6><?php echo e($user->phone); ?></h6> 
                        <small class="text-muted d-block pt-10"><?php echo e(__('Address')); ?></small>
                        <h6><?php echo e($user->address); ?></h6> 

                        
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="card">

                   
                    <div class="tab-content" id="pills-tabContent">
                       
                       
                         <div class="tab-pane fade show active" id="profile-tab" role="tabpanel" aria-labelledby="pills-profile-tab-tab">
                            <div class="card-body">
                            <form name="frm_user" method="post" class="form-horizontal" action="<?php echo e(route('user-profile')); ?>" enctype="multipart/form-data">
                            <input type="hidden" placeholder="Johnathan Doe" class="form-control" name="user_id" id="user_id" value="<?php echo e($user->id); ?>">
                                <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="example-name"><?php echo e(__('Fullname')); ?><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name" value="<?php echo e($user->name); ?>">
                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email"><?php echo e(__('Email')); ?><span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email" value="<?php echo e($user->email); ?>">
                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-password"><?php echo e(__('Password')); ?></label>
                                        <input type="password"  class="form-control" name="password" id="password">
                                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-phone"><?php echo e(__('Phone')); ?></label>
                                        <input type="text"  id="phone" name="phone" class="form-control" value="<?php echo e($user->phone); ?>">

                                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-message"><?php echo e(__('Address')); ?></label>
                                        <textarea name="address" name="address" rows="4" class="form-control"><?php echo e($user->address); ?></textarea>
                                        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group" <?php echo e($errors->has('profile_img') ? 'has-error' : ''); ?>>
                                        <label for="example-phone"><?php echo e(__('Profile Image')); ?></label>
                                        <input type="file" id="profile_img" name="profile_img" class="form-control" >
                                        <?php echo $errors->first('profile_img', '<span class="text-danger">:message </span>'); ?>

                                        <?php if(file_exists(public_path('profile_img/'.$user->profile_img)) && $user->profile_img!=""): ?>
                                        <img src="<?php echo e(asset('profile_img/'.$user->profile_img)); ?>" alt="Profile Image" width="150">
                                        <?php endif; ?>

                                    </div>
                                   
                                    <button class="btn btn-primary waves-effect waves-light me-1" type="submit"><?php echo e(__('Update')); ?> </button>
                                </form>
                            </div>
                        </div>
                  
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->startPush('script'); ?>
<script type="text/javascript" defer>
    $(document).ready(function(){

       $("form[name='frm_user']").validate({
            rules: {
                
                name: "required",
                email: "required",        
            },
            // Specify validation error messages
            messages: {
            
             name: "<?php echo e(__('jquery.name')); ?>",
             email: "<?php echo e(__('jquery.email')); ?>",
                          
            },
            submitHandler: function(form) {
                form.submit();
            }
        }); 
    });
</script>
<?php $__env->stopPush(); ?>    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\server\htdocs\profitability-tool\resources\views/users/profile.blade.php ENDPATH**/ ?>