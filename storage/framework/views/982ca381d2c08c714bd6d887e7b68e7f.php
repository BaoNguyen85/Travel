
<?php $__env->startSection('admin_content'); ?>
    <div class="head-title">
        <h3>CẬP NHẬT ĐỊA DANH</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <?php $__currentLoopData = $edit_place; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <form method="post" action="<?php echo e(URL::to ('/update-place/'.$pl->place_id)); ?>" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="input-content">
            <label for="">Tên địa điểm</label>
            <input value="<?php echo e($pl->place_name); ?>" autocomplete="off" name="place_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Hình ảnh</label>
            <input value="<?php echo e($pl->place_image); ?>" name="place_image" type="file" required>
            <img id="previewImage" src="<?php echo e(URL::to('public/uploads/place/'.$pl->place_image)); ?>" height="200" width="200" style="border-radius: 10px">
        </div>
        <div class="input-content">
            <label for="">Mô tả</label>
            <textarea class="form-control " rows="10" id="ckeditor1" name="place_describe" required><?php echo e($pl->place_describe); ?></textarea>
        </div>
        <div class="input-content">
            <label for="">Tỉnh thành</label>
            <select name="place_city" required>
                <?php $__currentLoopData = $place_province; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pl_pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($pl_pr->province_id == $pl->province_id): ?>
                    <option selected value="<?php echo e($pl_pr->province_id); ?>"><?php echo e($pl_pr->province_name); ?></option>
                    <?php else: ?>
                    <option value="<?php echo e($pl_pr->province_id); ?>"><?php echo e($pl_pr->province_name); ?></option>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="input-content">
            <label for="">Hiển thị</label>
            <select name="place_status">
                <option value="1">Ẩn</option>
                <option value="0">Hiển thị</option>
            </select>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <script>
        document.getElementById('place_image').addEventListener('change', function(event) {
            var previewImage = document.getElementById('previewImage');
            var file = event.target.files[0];
            
            if (file) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block'; // Hiển thị hình ảnh đã chọn
                };
                
                reader.readAsDataURL(file);
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/edit_place.blade.php ENDPATH**/ ?>