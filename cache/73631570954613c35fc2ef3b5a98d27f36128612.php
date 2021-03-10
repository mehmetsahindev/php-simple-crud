<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row my-3">
    <div class="col">
        <h2 class="inline">Employee <strong>Details</strong></h2>
    </div>
    <div class="col-auto"><a href="/add-user" class="btn btn-primary rounded mx-auto"><i class="fas fa-plus"></i> Add New</a></div>
</div>
<?php if(isset($error)): ?>
<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?php echo e($error); ?></div>
<?php endif; ?>
<?php if(isset($success)): ?>
<div class="alert alert-success"><i class="fas fa-check-circle"></i> <?php echo e($success); ?></div>
<?php endif; ?>
<div class="row" style="overflow-x: auto;">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if($data): ?>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($user['name']); ?></td>
                <td><?php echo e($user['email']); ?></td>
                <td><?php echo e($user['phone']); ?></td>
                <td class="text-center">
                    <a href="/user/<?php echo e($user['id']); ?>" class="mx-1"><i class="fas fa-pen text-warning"></i></a>
                    <a href="/user/<?php echo e($user['id']); ?>/delete" class="mx-1"><i class="fas fa-trash-alt text-danger"></i></a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <tr>
                <td colspan="4">There is no record.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH M:\xampp\htdocs\project\view/homepage.blade.php ENDPATH**/ ?>