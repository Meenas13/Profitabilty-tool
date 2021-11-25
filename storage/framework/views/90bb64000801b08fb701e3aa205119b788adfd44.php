<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" >
<head>
	<title><?php echo $__env->yieldContent('title',''); ?> | <?php echo e(env('APP_NAME')); ?></title>
	<!-- initiate head with meta tags, css and script -->
	<?php echo $__env->make('include.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</head>
<body id="app" >
    <div class="wrapper">
    	<!-- initiate header-->
    	<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    	<div class="page-wrap">
	    	<!-- initiate sidebar-->
	    	<?php echo $__env->make('include.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	    	<div class="main-content">
	    		<!-- start message area-->
	            <?php echo $__env->make('include.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	            <!-- end message area-->
	    		<!-- yeild contents here -->
	    		<?php echo $__env->yieldContent('content'); ?>
	    	</div>

	    	<!-- initiate chat section-->
	    	<?php echo $__env->make('include.chat', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


	    	<!-- initiate footer section-->
	    	<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    	</div>
    </div>
    
	<!-- initiate modal menu section-->
	<?php echo $__env->make('include.modalmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<!-- initiate scripts-->
	<?php echo $__env->make('include.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	
</body>
</html><?php /**PATH D:\server\htdocs\e-expense-portal\resources\views/layouts/main.blade.php ENDPATH**/ ?>