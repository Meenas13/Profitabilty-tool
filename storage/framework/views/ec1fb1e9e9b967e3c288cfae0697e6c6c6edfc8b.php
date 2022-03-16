    <?php if(session('logout') || session('error') || session('success')): ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <style>
        .auth-wrapper {
            background: #f4f4f4;
        }

        .auth-wrapper .authentication-form {
            border: 1px solid #002d72;
        }

        .btn-custom.logout:hover {
            color: #FFF;
            text-decoration: none;
        }

        button#logout_btnDiv {
            padding: 0;
            background: #002d72;
        }

        /* 2400336341 */
        .btn-custom.logout {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            /* background-color: #009688; */
            background-color: #002d72;
            height: 30px;
            color: #fff;
            border-radius: 25px;
        }
    </style>
    <div class="col-md-12 p-0">
        <div class="auth-wrapper">
            <div class="container-fluid h-100">
                <div class="row flex-row h-100">
                    <div class="col-xl-4 col-lg-4 col-md-4 m-auto">
                        <div class="authentication-form mx-auto">
                            <div class="logo-centered">
                                <a href="http://radmin.rakibhstu.com"><img height="80" src="<?php echo e(asset('img/metro-logo-sk.png')); ?>" alt="RADMIN"></a>
                            </div>
                            <?php if(session('success')): ?>
                            <?php echo e(session('success')); ?>

                            <?php endif; ?>

                            <?php if(session('logout')): ?>
                            <?php echo e(session('logout')); ?>

                            <?php endif; ?>

                            <?php if(session('error')): ?>
                            <?php echo e(session('error')); ?>

                            <?php endif; ?>

                            </br>
                            <div class="sign-btn text-center">
                                <br>
                                <button class="btn btn-custom" id="logout_btnDiv">
                                    <a class="btn-custom logout" href="<?php echo e(url('login')); ?>"><?php echo e(__('Login')); ?></a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php endif; ?><?php /**PATH F:\xampp\htdocs\profitability-tool\resources\views/include/message.blade.php ENDPATH**/ ?>