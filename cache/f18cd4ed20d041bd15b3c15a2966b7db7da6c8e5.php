<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row my-3">
    <div class="col">
        <?php if(isset($title)): ?> <h2><?php echo e($title); ?></h2> <?php endif; ?>
    </div>
    <div class="col-auto"><a href="/" class="btn btn-secondary rounded mx-auto"><i class="fas fa-chevron-left"></i> Go Back</a></div>
</div>

<div class="row">
    <form class="col-md-6" method="post">
        <?php if(isset($error)): ?>
        <div class="alert alert-danger">
            <i class="fas fa-info-circle"></i> <?php echo e($error); ?>

        </div>
        <?php endif; ?>
        <div class="form-group my-2">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" <?php if(isset($formData['name'])): ?> value="<?php echo e($formData['name']); ?>" <?php endif; ?> placeholder="User name">
        </div>
        <div class="form-group my-2">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" <?php if(isset($formData['email'])): ?> value="<?php echo e($formData['email']); ?>" <?php endif; ?> placeholder="User email">
        </div>
        <div class="form-group my-2">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" <?php if(isset($formData['phone'])): ?> value="<?php echo e($formData['phone']); ?>" <?php endif; ?> placeholder="User phone">
        </div>
        <button type="submit" class="btn btn-primary my-2">Submit</button>
    </form>
</div>

<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH M:\xampp\htdocs\project\view/form.blade.php ENDPATH**/ ?>