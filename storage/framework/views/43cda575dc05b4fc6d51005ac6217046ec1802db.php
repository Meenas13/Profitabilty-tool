<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="<?php echo e(route('customer')); ?>">
            <div class="logo-img">
                <img height="40" src="<?php echo e(asset('img/logo_white.png')); ?>" class="header-brand-img" title="<?php echo e(env('APP_NAME')); ?>">
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    <?php
    $segment1 = request()->segment(1);
    $segment2 = request()->segment(2);
    $segment3 = request()->segment(3);
    ?>

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <!-- <div class="nav-item <?php echo e(($segment1 == 'dashboard') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('dashboard')); ?>"><i class="ik ik-bar-chart-2"></i><span><?php echo e(__('Dashboard')); ?></span></a>
                </div> -->
                <!--  <div class="nav-item <?php echo e(($segment1 == 'users' || $segment1 == 'roles'||$segment1 == 'permission' ||$segment1 == 'user') ? 'active open' : ''); ?> has-sub">
                    <a href="#"><i class="ik ik-user"></i><span><?php echo e(__('Adminstrator')); ?></span></a>
                    <div class="submenu-content">
                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_user')): ?>
                        <a href="<?php echo e(url('users')); ?>" class="menu-item <?php echo e(($segment1 == 'users') ? 'active' : ''); ?>"><?php echo e(__('Users')); ?></a>
                        <a href="<?php echo e(url('user/create')); ?>" class="menu-item <?php echo e(($segment1 == 'user' && $segment2 == 'create') ? 'active' : ''); ?>"><?php echo e(__('Add User')); ?></a>
                         <?php endif; ?>
                       
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_roles')): ?>
                        <a href="<?php echo e(url('roles')); ?>" class="menu-item <?php echo e(($segment1 == 'roles') ? 'active' : ''); ?>"><?php echo e(__('Roles')); ?></a>
                        <?php endif; ?>
                       
                    </div>
                </div> -->

                <div class="nav-item <?php echo e(($segment1 == 'customer') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('customer')); ?>"><i class="ik ik-users"></i><span><?php echo e(__('Customer')); ?></span></a>
                </div>


                <?php $user = Auth::User();
                if ($user->email == "matej.sklar@metro.sk" || $user->email == "martin.ovcik@metro.sk" || $user->email == "p.suryawanshi@metro-gsc.in" || $user->email == "archanaaditya.deokar@metro-gsc.in") { ?>

                    <div class="nav-item <?php echo e(($segment1 == 'nnnbp_screen') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('nnnbp_screen')); ?>"><i class="ik ik-list"></i><span> <?php echo e(__('NNNBP Update')); ?></span></a>
                    </div>
                <?php } ?>

        </div>
    </div>
</div><?php /**PATH F:\xampp\htdocs\profitability-tool\resources\views/include/sidebar.blade.php ENDPATH**/ ?>