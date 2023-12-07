
<?php $__env->startSection('admin_content'); ?>
    <div class="head-title">
        <h3>THÔNG TIN WEBSITE</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <?php $__currentLoopData = $all_information; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $infor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo e(csrf_field()); ?>

        <div class="colum-container">
            <div class="colum1">
                <div class="input-content">
                    <label style="font-weight: bold" for="">Tên công ty: </label>
                    <label><?php echo e($infor->information_name); ?></label>
                </div>
                <div class="input-content">
                    <label style="font-weight: bold" for="">Logo</label><br>
                    <img src="../public/uploads/logo/<?php echo e($infor->information_logo); ?>" height="100" width="200" style="border-radius: 10px;padding-top:5%">
                </div>
                <div class="input-content">
                    <label style="font-weight: bold" for="">Địa chỉ: </label>
                    <label><?php echo e($infor->information_address); ?></label>
                </div>
                <div class="input-content">
                    <label style="font-weight: bold" for="">Email: </label>
                    <label><?php echo e($infor->information_email); ?></label>
                </div>
                <div class="input-content">
                    <label style="font-weight: bold" for="">Số điện thoại: </label>
                    <label><?php echo e($infor->information_phone); ?></label>
                </div>  
                <div class="input-content">
                    <label style="font-weight: bold" for="">Mô tả: </label>
                    <label><?php echo $infor->information_describe; ?></label>
                </div>
                
                <div>
                    <a href="<?php echo e(URL::to('/edit-information/1')); ?>" class="btn-set-infor">Chỉnh sửa</a>
                </div>
            </div>
        
            <div class="colum2">
                <div class="input-content" style="margin-left:-2%">
                    <label style="font-weight: bold" for="">Bản đồ</label><br>
                    <?php echo $infor->information_location; ?>

                </div>
            </div>
        </div>
        
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/information_website.blade.php ENDPATH**/ ?>