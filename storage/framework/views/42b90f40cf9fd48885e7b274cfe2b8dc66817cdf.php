<!DOCTYPE html>
<html lang="en">
  <head>
    <?php echo $__env->make('layout.partials.lawyer_head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </head>
  <body class="login-page">
    <?php echo $__env->make('layout.partials.lawyer_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->yieldContent('content'); ?>
    
    <?php echo $__env->make('layout.partials.lawyer_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->make('layout.partials.lawyer_footer-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </body>
</html><?php /**PATH C:\wamp64\www\expertgateway\resources\views/layout/lawyerlayout.blade.php ENDPATH**/ ?>