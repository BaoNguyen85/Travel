
<?php $__env->startSection('admin_content'); ?>
    <div class="head-title">
        <h3>EDIT DESTINATION DETAIL</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <?php $__currentLoopData = $edit_destination_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ey => $editdes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <form method="post" action="<?php echo e(URL::to('/update-destination-detail/'.$editdes->destinationdetail_id)); ?>" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="input-content">
            <label for="">Điểm đến</label>
            <select name="destination_detail_destination">
                <?php $__currentLoopData = $all_destination; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $des): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($editdes->destination_id == $des->destination_id): ?>
                        <option selected value="<?php echo e($des->destination_id); ?>"><?php echo e($des->destination_name); ?></option>
                    <?php else: ?>
                        <option value="<?php echo e($des->destination_id); ?>"><?php echo e($des->destination_name); ?></option>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="input-content">
            <label for="">Tỉnh thành</label>
            <select name="destination_detail_place">
                <?php $__currentLoopData = $all_place; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($editdes->place_id == $pl->place_id): ?>
                        <option selected value="<?php echo e($pl->place_id); ?>"><?php echo e($pl->place_name); ?></option>
                    <?php else: ?>
                    <option value="<?php echo e($pl->place_id); ?>"><?php echo e($pl->place_name); ?></option>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/edit_destinationdetail.blade.php ENDPATH**/ ?>