<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
	<title><?php echo $__env->yieldContent('title',''); ?> | <?php echo e(config('app.name')); ?> </title>
	<!-- initiate head with meta tags, css and script -->
	<?php echo $__env->make('include.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</head>

<body id="app">
	<div class="wrapper">
		<!-- initiate header-->
		<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<div class="page-wrap">


			<div id="loader" class="loader">
				<!-- By Sam Herbert (@sherb), for everyone. More @ http://goo.gl/7AJzbL -->
				<svg width="58" height="58" viewBox="0 0 58 58" xmlns="http://www.w3.org/2000/svg">
					<g fill="none" fill-rule="evenodd">
						<g transform="translate(2 1)" stroke="#003b7e" stroke-width="1.5">
							<circle cx="42.601" cy="11.462" r="5" fill-opacity="1" fill="#003b7e">
								<animate attributeName="fill-opacity" begin="0s" dur="1.3s" values="1;0;0;0;0;0;0;0" calcMode="linear" repeatCount="indefinite" />
							</circle>
							<circle cx="49.063" cy="27.063" r="5" fill-opacity="0" fill="#003b7e">
								<animate attributeName="fill-opacity" begin="0s" dur="1.3s" values="0;1;0;0;0;0;0;0" calcMode="linear" repeatCount="indefinite" />
							</circle>
							<circle cx="42.601" cy="42.663" r="5" fill-opacity="0" fill="#003b7e">
								<animate attributeName="fill-opacity" begin="0s" dur="1.3s" values="0;0;1;0;0;0;0;0" calcMode="linear" repeatCount="indefinite" />
							</circle>
							<circle cx="27" cy="49.125" r="5" fill-opacity="0" fill="#003b7e">
								<animate attributeName="fill-opacity" begin="0s" dur="1.3s" values="0;0;0;1;0;0;0;0" calcMode="linear" repeatCount="indefinite" />
							</circle>
							<circle cx="11.399" cy="42.663" r="5" fill-opacity="0" fill="#003b7e">
								<animate attributeName="fill-opacity" begin="0s" dur="1.3s" values="0;0;0;0;1;0;0;0" calcMode="linear" repeatCount="indefinite" />
							</circle>
							<circle cx="4.938" cy="27.063" r="5" fill-opacity="0" fill="#003b7e">
								<animate attributeName="fill-opacity" begin="0s" dur="1.3s" values="0;0;0;0;0;1;0;0" calcMode="linear" repeatCount="indefinite" />
							</circle>
							<circle cx="11.399" cy="11.462" r="5" fill-opacity="0" fill="#003b7e">
								<animate attributeName="fill-opacity" begin="0s" dur="1.3s" values="0;0;0;0;0;0;1;0" calcMode="linear" repeatCount="indefinite" />
							</circle>
							<circle cx="27" cy="5" r="5" fill-opacity="0" fill="#003b7e">
								<animate attributeName="fill-opacity" begin="0s" dur="1.3s" values="0;0;0;0;0;0;0;1" calcMode="linear" repeatCount="indefinite" />
							</circle>
						</g>
					</g>
				</svg>
			</div> <!-- Loader ends -->


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

</html><?php /**PATH F:\xampp\htdocs\profitability-tool\resources\views/layouts/main.blade.php ENDPATH**/ ?>