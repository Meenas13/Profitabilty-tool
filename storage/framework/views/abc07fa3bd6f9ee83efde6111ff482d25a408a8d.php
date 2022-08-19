<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="_token" content="<?php echo e(csrf_token()); ?>" />
<link rel="icon" href="<?php echo e(asset('favicon.png')); ?>" />

<!-- font awesome library -->
<link rel="stylesheet" href="<?php echo e(asset('js/req/font.css')); ?>">
<!-- JQuery UI -->
<link rel="stylesheet" href="<?php echo e(asset('js/req/jquery-ui.css')); ?>">

<!-- Multi options (dropdown) select Bootstrap -->

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"> -->

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" /> -->
<!--Dynamic StyleSheets added from a view would be pasted here-->

<?php echo $__env->yieldContent('styles'); ?>

<script src="<?php echo e(asset('js/app.js')); ?>"></script>

<!-- themekit admin template asstes -->

<link rel="stylesheet" href="<?php echo e(asset('all.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('dist/css/theme.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/icon-kit/dist/css/iconkit.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('plugins/ionicons/dist/css/ionicons.min.css')); ?>">

<!-- <link rel="stylesheet" href="<?php echo e(asset('plugins/DataTables/datatables.min.css')); ?>"> -->
<link rel="stylesheet" href="<?php echo e(asset('js/req/jquery.dataTables.min.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('js/req/select2.min.css')); ?>">

<!-- Stack array for including inline css or head elements -->
<?php echo $__env->yieldPushContent('head'); ?>

<link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>"><?php /**PATH F:\xampp\htdocs\profitability-tool\resources\views/include/head.blade.php ENDPATH**/ ?>