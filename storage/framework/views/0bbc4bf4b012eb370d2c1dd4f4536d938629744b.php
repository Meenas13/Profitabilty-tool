<header class="header-top" header-theme="light">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <div class="top-menu d-flex align-items-center">
                <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                
                
                <button class="nav-link" title="clear cache">
                    <a  href="<?php echo e(url('clear-cache')); ?>">
                    <i class="ik ik-battery-charging"></i> 
                </a>
                </button> 
            </div>
            <div class="top-menu d-flex align-items-center">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="notiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-bell"></i><span class="badge bg-danger">3</span></a>
                    <div class="dropdown-menu dropdown-menu-right notification-dropdown" aria-labelledby="notiDropdown">
                        <h4 class="header"><?php echo e(__('Notifications')); ?></h4>
                        <div class="notifications-wrap">
                            <a href="#" class="media">
                                <span class="d-flex">
                                    <i class="ik ik-check"></i> 
                                </span>
                                <span class="media-body">
                                    <span class="heading-font-family media-heading"><?php echo e(__('Invitation accepted')); ?></span> 
                                    <span class="media-content"><?php echo e(__('Your have been Invited ...')); ?></span>
                                </span>
                            </a>
                            <a href="#" class="media">
                                <span class="d-flex">
                                    <img src="<?php echo e(asset('img/users/1.jpg')); ?>" class="rounded-circle" alt="">
                                </span>
                                <span class="media-body">
                                    <span class="heading-font-family media-heading"><?php echo e(__('Steve Smith')); ?></span> 
                                    <span class="media-content"><?php echo e(__('I slowly updated projects')); ?></span>
                                </span>
                            </a>
                            <a href="#" class="media">
                                <span class="d-flex">
                                    <i class="ik ik-calendar"></i> 
                                </span>
                                <span class="media-body">
                                    <span class="heading-font-family media-heading"><?php echo e(__('To Do')); ?></span> 
                                    <span class="media-content"><?php echo e(__('Meeting with Nathan on Friday 8 AM ...')); ?></span>
                                </span>
                            </a>
                        </div>
                        <div class="footer"><a href="javascript:void(0);"><?php echo e(__('See all activity')); ?></a></div>
                    </div>
                </div>
                
               <?php $user=Auth::User();?>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php if(file_exists(public_path('profile_img/'.$user->profile_img)) && $user->profile_img!=""): ?>
                         <img class="avatar" src="<?php echo e(asset('profile_img/'.$user->profile_img)); ?>" alt="<?php echo e($user->name); ?>">
                       <?php endif; ?> 
                    <span class="d-xl-inline-block ms-1 fw-medium margin-5-top"><?php echo e($user->name); ?> </span>
                    <i class="uil-angle-down d-none d-xl-inline-block"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?php echo e(url('profile')); ?>"><i class="ik ik-user dropdown-icon"></i> <?php echo e(__('Profile')); ?></a>
                        
                        <a class="dropdown-item" href="<?php echo e(url('logout')); ?>">
                            <i class="ik ik-power dropdown-icon"></i> 
                            <?php echo e(__('Logout')); ?>

                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header><?php /**PATH D:\server\htdocs\e-expense-portal\resources\views/include/header.blade.php ENDPATH**/ ?>