
<?php $__env->startSection('admin_content'); ?>
    <div class="head-title">
        <h3>EDIT TOUR TYPE</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <?php $__currentLoopData = $edit_tour_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <form method="post" action="<?php echo e(URL::to('/update-tour-type/'.$tourtype->tourtype_id)); ?>" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="input-content">
            <label for="">Tên loại tour</label>
            <input value="<?php echo e($tourtype->tourtype_name); ?>" autocomplete="off" name="tourtype_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Hình ảnh</label>
            <input value="<?php echo e($tourtype->tourtype_image); ?>" name="tourtype_image" type="file" required>
            <img id="previewImage" src="<?php echo e(URL::to('public/uploads/tourtype/'.$tourtype->tourtype_image)); ?>" height="200" width="300" style="border-radius: 10px">
        </div>
        <div class="input-content">
            <label for="">Slug</label>
            <input value="<?php echo e($tourtype->tourtype_slug); ?>" name="tourtype_slug" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Mô tả</label>
            <textarea id="ckeditor1" rows="10" name="tourtype_describe" required><?php echo e($tourtype->tourtype_describe); ?></textarea>
        </div>
        <div class="input-content">
            <label for="">Hiển thị</label>
            <select name="tourtype_status">
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
        document.getElementById('tourtype_image').addEventListener('change', function(event) {
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
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/edit_tourType.blade.php ENDPATH**/ ?>