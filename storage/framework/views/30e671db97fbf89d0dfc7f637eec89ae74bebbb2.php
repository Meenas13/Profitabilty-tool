<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="<?php echo e(route('dashboard')); ?>">
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
    ?>
    
    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item <?php echo e(($segment1 == 'dashboard') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('dashboard')); ?>"><i class="ik ik-bar-chart-2"></i><span><?php echo e(__('Dashboard')); ?></span></a>
                </div>
                <div class="nav-item <?php echo e(($segment1 == 'users' || $segment1 == 'roles'||$segment1 == 'permission' ||$segment1 == 'user') ? 'active open' : ''); ?> has-sub">
                    <a href="#"><i class="ik ik-user"></i><span><?php echo e(__('Adminstrator')); ?></span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_user')): ?>
                        <a href="<?php echo e(url('users')); ?>" class="menu-item <?php echo e(($segment1 == 'users') ? 'active' : ''); ?>"><?php echo e(__('Users')); ?></a>
                        <a href="<?php echo e(url('user/create')); ?>" class="menu-item <?php echo e(($segment1 == 'user' && $segment2 == 'create') ? 'active' : ''); ?>"><?php echo e(__('Add User')); ?></a>
                         <?php endif; ?>
                         <!-- only those have manage_role permission will get access -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_roles')): ?>
                        <a href="<?php echo e(url('roles')); ?>" class="menu-item <?php echo e(($segment1 == 'roles') ? 'active' : ''); ?>"><?php echo e(__('Roles')); ?></a>
                        <?php endif; ?>
                       
                    </div>
                </div>

                <div class="nav-lavel"><?php echo e(__('Documentation')); ?> </div>
                <div class="nav-item <?php echo e(($segment1 == 'rest-api') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('rest-api')); ?>"><i class="ik ik-cloud"></i><span><?php echo e(__('REST API')); ?></span> </a>
                </div>
                <div class="nav-item <?php echo e(($segment1 == 'permission-example') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('permission-example')); ?>"><i class="ik ik-unlock"></i><span><?php echo e(__('Laravel Permission')); ?></span> </a>
                </div>
                <div class="nav-item <?php echo e(($segment1 == 'table-datatable-edit') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('table-datatable-edit')); ?>"><i class="ik ik-layout"></i><span><?php echo e(__('Editable Datatable')); ?></span>  </a>

                </div>

                <!-- start inventory pages -->
                <div class="nav-lavel"><?php echo e(__('Inventory')); ?> </div>
                <div class="nav-item <?php echo e(($segment1 == 'pos') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('pos')); ?>"><i class="ik ik-printer"></i><span><?php echo e(__('POS')); ?></span> <span class=" badge badge-success badge-right"><?php echo e(__('New')); ?></span></a>
                </div>
                <div class="nav-item <?php echo e(($segment1 == 'products') ? 'active open' : ''); ?> has-sub">
                    <a href="#"><i class="ik ik-headphones"></i><span><?php echo e(__('Products')); ?></span> <span class=" badge badge-success badge-right"><?php echo e(__('New')); ?></span></a>
                    <div class="submenu-content">
                        <a href="<?php echo e(url('products/create')); ?>" class="menu-item <?php echo e(($segment1 == 'products' && $segment2 == 'create') ? 'active' : ''); ?>"><?php echo e(__('Add Product')); ?></a>
                        <a href="<?php echo e(url('products')); ?>" class="menu-item <?php echo e(($segment1 == 'products' && $segment2 == '') ? 'active' : ''); ?>"><?php echo e(__('List Producs')); ?></a>
                    </div>
                </div>
                <div class="nav-item <?php echo e(($segment1 == 'categories') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('categories')); ?>"><i class="ik ik-list"></i><span><?php echo e(__('Categories')); ?></span> <span class=" badge badge-success badge-right"><?php echo e(__('New')); ?></span></a>
                </div>
                <div class="nav-item <?php echo e(($segment1 == 'sales') ? 'active open' : ''); ?> has-sub">
                    <a href="#"><i class="ik ik-shopping-cart"></i><span><?php echo e(__('Sales')); ?></span> <span class=" badge badge-success badge-right"><?php echo e(__('New')); ?></span></a>
                    <div class="submenu-content">
                        <a href="<?php echo e(url('sales/create')); ?>" class="menu-item <?php echo e(($segment1 == 'sales' && $segment2 == 'create') ? 'active' : ''); ?>"><?php echo e(__('Add Sale')); ?></a>
                        <a href="<?php echo e(url('sales')); ?>" class="menu-item <?php echo e(($segment1 == 'sales' && $segment2 == '') ? 'active' : ''); ?>"><?php echo e(__('List Sales')); ?></a>
                    </div>
                </div>
                <div class="nav-item <?php echo e(($segment1 == 'purchases') ? 'active open' : ''); ?> has-sub">
                    <a href="#"><i class="ik ik-truck"></i><span><?php echo e(__('Purchases')); ?></span> <span class=" badge badge-success badge-right"><?php echo e(__('New')); ?></span></a>
                    <div class="submenu-content">
                        <a href="<?php echo e(url('purchases/create')); ?>" class="menu-item <?php echo e(($segment1 == 'purchases' && $segment2 == 'create') ? 'active' : ''); ?>"><?php echo e(__('Add Purchase')); ?></a>
                        <a href="<?php echo e(url('purchases')); ?>" class="menu-item <?php echo e(($segment1 == 'purchases' && $segment2 == '') ? 'active' : ''); ?>"><?php echo e(__('List Purchases')); ?></a>
                    </div>
                </div>
                <div class="nav-item <?php echo e(($segment1 == 'suppliers' || $segment1 == 'customers') ? 'active open' : ''); ?> has-sub">
                    <a href="#"><i class="ik ik-users"></i><span><?php echo e(__('People')); ?></span> <span class=" badge badge-success badge-right"><?php echo e(__('New')); ?></span></a>
                    <div class="submenu-content">
                        <a href="<?php echo e(url('suppliers')); ?>" class="menu-item <?php echo e(($segment1 == 'suppliers') ? 'active' : ''); ?>"><?php echo e(__('Suppliers')); ?></a>
                        <a href="<?php echo e(url('customers')); ?>" class="menu-item <?php echo e(($segment1 == 'customers') ? 'active' : ''); ?>"><?php echo e(__('Customers')); ?></a>
                    </div>
                </div>



                <!-- end inventory pages -->

                <div class="nav-lavel"><?php echo e(__('Themekit Pages')); ?> </div>
                <div class="nav-item <?php echo e(($segment1 == 'form-components' || $segment1 == 'form-advance'||$segment1 == 'form-addon') ? 'active open' : ''); ?> has-sub">
                    <a href="#"><i class="ik ik-edit"></i><span><?php echo e(__('Forms')); ?></span></a>
                    <div class="submenu-content">
                        <a href="<?php echo e(url('form-components')); ?>" class="menu-item <?php echo e(($segment1 == 'form-components') ? 'active' : ''); ?>"><?php echo e(__('Components')); ?></a>
                        <a href="<?php echo e(url('form-addon')); ?>" class="menu-item <?php echo e(($segment1 == 'form-addon') ? 'active' : ''); ?>"><?php echo e(__('Add-On')); ?></a>
                        <a href="<?php echo e(url('form-advance')); ?>" class="menu-item <?php echo e(($segment1 == 'form-advance') ? 'active' : ''); ?>"><?php echo e(__('Advance')); ?></a>
                    </div>
                </div>
                <div class="nav-item <?php echo e(($segment1 == 'form-picker') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('form-picker')); ?>"><i class="ik ik-terminal"></i><span><?php echo e(__('Form Picker')); ?></span> </a>
                </div>

                <div class="nav-item <?php echo e(($segment1 == 'table-bootstrap') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('table-bootstrap')); ?>"><i class="ik ik-credit-card"></i><span><?php echo e(__('Bootstrap Table')); ?></span></a>
                </div>
                <div class="nav-item <?php echo e(($segment1 == 'table-datatable') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('table-datatable')); ?>"><i class="ik ik-inbox"></i><span><?php echo e(__('Data Table')); ?></span></a>
                </div>
                <div class="nav-item <?php echo e(($segment1 == 'navbar') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('navbar')); ?>"><i class="ik ik-menu"></i><span><?php echo e(__('Navigation')); ?></span> </a>
                </div>
                <div class="nav-item <?php echo e(($segment1 == 'widgets' || $segment1 == 'widget-statistic'||$segment1 == 'widget-data'||$segment1 == 'widget-chart') ? 'active open' : ''); ?> has-sub">
                    <a href="javascript:void(0)"><i class="ik ik-layers"></i><span><?php echo e(__('Widgets')); ?></span> <span class="badge badge-danger"><?php echo e(__('150+')); ?></span></a>
                    <div class="submenu-content">
                        <a href="<?php echo e(url('widgets')); ?>" class="menu-item <?php echo e(($segment1 == 'widgets') ? 'active' : ''); ?>"><?php echo e(__('Basic')); ?></a>
                        <a href="<?php echo e(url('widget-statistic')); ?>" class="menu-item <?php echo e(($segment1 == 'widget-statistic') ? 'active' : ''); ?>"><?php echo e(__('Statistic')); ?></a>
                        <a href="<?php echo e(url('widget-data')); ?>" class="menu-item <?php echo e(($segment1 == 'widget-data') ? 'active' : ''); ?>"><?php echo e(__('Data')); ?></a>
                        <a href="<?php echo e(url('widget-chart')); ?>" class="menu-item <?php echo e(($segment1 == 'widget-chart') ? 'active' : ''); ?>"><?php echo e(__('Chart Widget')); ?></a>
                    </div>
                </div>
                <div class="nav-item <?php echo e(($segment1 == 'alerts' || $segment1 == 'buttons'||$segment1 == 'badges'||$segment1 == 'navigation') ? 'active open' : ''); ?> has-sub">
                    <a href="#"><i class="ik ik-box"></i><span><?php echo e(__('Basic')); ?></span></a>
                    <div class="submenu-content">
                        <a href="<?php echo e(url('alerts')); ?>" class="menu-item <?php echo e(($segment1 == 'alerts') ? 'active' : ''); ?>"><?php echo e(__('Alerts')); ?></a>
                        <a href="<?php echo e(url('badges')); ?>" class="menu-item <?php echo e(($segment1 == 'badges') ? 'active' : ''); ?>"><?php echo e(__('Badges')); ?></a>
                        <a href="<?php echo e(url('buttons')); ?>" class="menu-item <?php echo e(($segment1 == 'buttons') ? 'active' : ''); ?>"><?php echo e(__('Buttons')); ?></a>
                        <a href="<?php echo e(url('navigation')); ?>" class="menu-item <?php echo e(($segment1 == 'navigation') ? 'active' : ''); ?>"><?php echo e(__('Navigation')); ?></a>
                    </div>
                </div>
                <div class="nav-item <?php echo e(($segment1 == 'modals' || $segment1 == 'notifications'||$segment1 == 'carousel'||$segment1 == 'range-slider' ||$segment1 == 'rating') ? 'active open' : ''); ?> has-sub">
                    <a href="#"><i class="ik ik-gitlab"></i><span><?php echo e(__('Advance')); ?></span> </a>
                    <div class="submenu-content">
                        <a href="<?php echo e(url('modals')); ?>" class="menu-item <?php echo e(($segment1 == 'modals') ? 'active' : ''); ?>"><?php echo e(__('Modals')); ?></a>
                        <a href="<?php echo e(url('notifications')); ?>" class="menu-item <?php echo e(($segment1 == 'notifications') ? 'active' : ''); ?>" ><?php echo e(__('Notifications')); ?></a>
                        <a href="<?php echo e(url('carousel')); ?>" class="menu-item <?php echo e(($segment1 == 'carousel') ? 'active' : ''); ?>"><?php echo e(__('Slider')); ?></a>
                        <a href="<?php echo e(url('range-slider')); ?>" class="menu-item <?php echo e(($segment1 == 'range-slider') ? 'active' : ''); ?>"><?php echo e(__('Range Slider')); ?></a>
                        <a href="<?php echo e(url('rating')); ?>" class="menu-item <?php echo e(($segment1 == 'rating') ? 'active' : ''); ?>"><?php echo e(__('Rating')); ?></a>
                    </div>
                </div>
                
                
                <div class="nav-item <?php echo e(($segment1 == 'charts-chartist' || $segment1 == 'charts-flot'||$segment1 == 'charts-knob'||$segment1 == 'charts-amcharts') ? 'active open' : ''); ?> has-sub">
                    <a href="#"><i class="ik ik-pie-chart"></i><span><?php echo e(__('Charts')); ?></span> </a>
                    <div class="submenu-content">
                        <a href="<?php echo e(url('charts-chartist')); ?>" class="menu-item <?php echo e(($segment1 == 'charts-chartist') ? 'active' : ''); ?>"><?php echo e(__('Chartist')); ?></a>
                        <a href="<?php echo e(url('charts-flot')); ?>" class="menu-item <?php echo e(($segment1 == 'charts-flot') ? 'active' : ''); ?>"><?php echo e(__('Flot')); ?></a>
                        <a href="<?php echo e(url('charts-knob')); ?>" class="menu-item <?php echo e(($segment1 == 'charts-knob') ? 'active' : ''); ?>"><?php echo e(__('Knob')); ?></a>
                        <a href="<?php echo e(url('charts-amcharts')); ?>" class="menu-item <?php echo e(($segment1 == 'charts-amcharts') ? 'active' : ''); ?>"><?php echo e(__('Amcharts')); ?></a>
                    </div>
                </div>
                <div class="nav-item <?php echo e(($segment1 == 'calendar') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('calendar')); ?>"><i class="ik ik-calendar"></i><span><?php echo e(__('Calendar')); ?></span></a>
                </div>
                <div class="nav-item <?php echo e(($segment1 == 'taskboard') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('taskboard')); ?>"><i class="ik ik-server"></i><span><?php echo e(__('Taskboard')); ?></span></a>
                </div>

                <div class="nav-item <?php echo e(($segment1 == 'login-1' || $segment1 == 'register'||$segment1 == 'forgot-password') ? 'active open' : ''); ?> has-sub">
                    <a href="#"><i class="ik ik-lock"></i><span><?php echo e(__('Authentication')); ?></span></a>
                    <div class="submenu-content">
                        <a href="<?php echo e(url('login-1')); ?>" class="menu-item <?php echo e(($segment1 == 'login-1') ? 'active' : ''); ?>"><?php echo e(__('Login')); ?></a>
                        <a href="<?php echo e(url('register')); ?>" class="menu-item <?php echo e(($segment1 == 'register-1') ? 'active' : ''); ?>"><?php echo e(__('Register')); ?></a>
                        <a href="<?php echo e(url('forgot-password')); ?>" class="menu-item <?php echo e(($segment1 == 'forgot-password') ? 'active' : ''); ?>"><?php echo e(__('Forgot Password')); ?></a>
                    </div>
                </div>
                
                <div class="nav-item <?php echo e(($segment1 == 'profile' || $segment1 == 'invoice'||$segment1 == 'session-timeout') ? 'active open' : ''); ?> has-sub">
                    <a href="#"><i class="ik ik-file-text"></i><span><?php echo e(__('Pages')); ?></span></a>
                    <div class="submenu-content">
                        <a href="<?php echo e(url('profile')); ?>" class="menu-item <?php echo e(($segment1 == 'profile') ? 'active' : ''); ?>"><?php echo e(__('Profile')); ?></a>
                        <a href="<?php echo e(url('invoice')); ?>" class="menu-item <?php echo e(($segment1 == 'invoice') ? 'active' : ''); ?>"><?php echo e(__('Invoice')); ?></a>
                        <a href="<?php echo e(url('project')); ?>" class="menu-item <?php echo e(($segment1 == 'project') ? 'active' : ''); ?>"><?php echo e(__('Project')); ?></a>
                        <a href="<?php echo e(url('view')); ?>" class="menu-item <?php echo e(($segment1 == 'view') ? 'active' : ''); ?>"><?php echo e(__('View')); ?></a>
                        <a href="<?php echo e(url('session-timeout')); ?>" class="menu-item <?php echo e(($segment1 == 'session-timeout') ? 'active' : ''); ?>"><?php echo e(__('Session Timeout')); ?></a>
                    </div>
                </div>
                <div class="nav-item <?php echo e(($segment1 == 'layouts') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('layouts')); ?>"><i class="ik ik-layout"></i><span><?php echo e(__('Layouts')); ?></span></a>
                </div>
                <div class="nav-item <?php echo e(($segment1 == 'icons') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('icons')); ?>"><i class="ik ik-command"></i><span><?php echo e(__('Icons')); ?></span></a>
                </div>
                <div class="nav-item <?php echo e(($segment1 == 'pricing') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('pricing')); ?>"><i class="ik ik-dollar-sign"></i><span><?php echo e(__('Pricing')); ?></span></a>
                </div>
                <div class="nav-item has-sub">
                    <a href="javascript:void(0)"><i class="ik ik-list"></i><span><?php echo e(__('Menu Levels')); ?></span></a>
                    <div class="submenu-content">
                        <a href="javascript:void(0)" class="menu-item"><?php echo e(__('Menu Level 2.1')); ?></a>
                        <div class="nav-item <?php echo e(($segment1 == '') ? 'active' : ''); ?> has-sub">
                            <a href="javascript:void(0)" class="menu-item"><?php echo e(__('Menu Level 2.2')); ?></a>
                            <div class="submenu-content">
                                <a href="javascript:void(0)" class="menu-item"><?php echo e(__('Menu Level 3.1')); ?></a>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="menu-item"><?php echo e(__('Menu Level 2.3')); ?></a>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="javascript:void(0)" class="disabled"><i class="ik ik-slash"></i><span><?php echo e(__('Disabled Menu')); ?></span></a>
                </div>
                
        </div>
    </div>
</div><?php /**PATH D:\server\htdocs\e-expense-portal\resources\views/include/sidebar.blade.php ENDPATH**/ ?>