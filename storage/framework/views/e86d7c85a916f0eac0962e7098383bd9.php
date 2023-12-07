
<?php $__env->startSection('admin_content'); ?>
    <div class="head-title">
        <h3>CẬP NHẬT TOUR</h3>
    </div>
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
    ?>
    <?php $__currentLoopData = $edit_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $edt_t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <form method="post" action="<?php echo e(URL::to('/update-tour/'.$edt_t->tour_id)); ?>" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="input-content">
            <label for="">Tên Tour</label>
            <input value="<?php echo e($edt_t->tour_name); ?>" name="tour_name" minlength="2" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Loại tour</label>
            <select name="tour_tourtype" required>
                <option value="">--Chọn loại tour--</option>
                <?php $__currentLoopData = $all_tourtype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($tt->tourtype_id == $edt_t->tourtype_id): ?>
                <option selected value="<?php echo e($tt->tourtype_id); ?>">
                        <?php echo e($tt->tourtype_name); ?>

                </option>
                <?php else: ?>
                <option value="<?php echo e($tt->tourtype_id); ?>">
                    <?php echo e($tt->tourtype_name); ?>

                </option>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="input-content">
            <label for="">Thành phố</label>
            <select name="tour_city" required>
                <option value="">--Chọn thành phố--</option>
                <?php $__currentLoopData = $all_province; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($pr->province_id == $edt_t->tour_city): ?>
                <option selected value="<?php echo e($pr->province_id); ?>">
                        <?php echo e($pr->province_name); ?>

                </option>
                <?php else: ?>
                <option value="<?php echo e($pr->province_id); ?>">
                    <?php echo e($pr->province_name); ?>

                </option>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="input-content">
            <label for="">Điểm đến</label>
            <select name="tour_destination" required>
                <option value="">--Chọn điểm đến--</option>
                <?php $__currentLoopData = $all_destination; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $des): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($des->destination_id == $edt_t->tour_destination): ?>
                <option selected value="<?php echo e($des->destination_id); ?>">
                        <?php echo e($des->destination_name); ?>

                </option>
                <?php else: ?>
                <option value="<?php echo e($des->destination_id); ?>">
                    <?php echo e($des->destination_name); ?>

                </option>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="input-content">
            <label for="">Ảnh đại diện</label>
            <input value="<?php echo e($edt_t->tour_avt); ?>" name="tour_avt" type="file" required>
            <img id="previewImage" src="<?php echo e(URL::to('public/uploads/tour/'.$edt_t->tour_avt)); ?>" height="200" width="100" style="border-radius: 10px">
        </div>
        <div class="input-content">
            <label for="">Hình ảnh</label>
            <input value="<?php echo e($edt_t->tour_image); ?>" name="tour_image" type="file" required>
            <img id="previewImage1" src="<?php echo e(URL::to('public/uploads/tour/'.$edt_t->tour_image)); ?>" height="200" width="500" style="border-radius: 10px">
        </div>
        <div class="input-content">
            <label for="">Giá tour</label>
            <input value="<?php echo e($edt_t->tour_price); ?>" name="tour_price" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Lịch trình</label>
            <select name="tour_schedule" required>
                <option value="">--Chọn lịch trình--</option>
                <?php $__currentLoopData = $all_scheduledetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $schdl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($schdl->scheduledetail_id == $edt_t->tour_schedule): ?>
                <option selected value="<?php echo e($schdl->scheduledetail_id); ?>">
                    <?php $__currentLoopData = $all_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($sch->schedule_id == $schdl->schedule_id): ?>
                        <?php echo e($sch->schedule_name); ?>

                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </option>
                <?php else: ?>
                <option value="<?php echo e($schdl->scheduledetail_id); ?>">
                    <?php $__currentLoopData = $all_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($sch->schedule_id == $schdl->schedule_id): ?>
                        <?php echo e($sch->schedule_name); ?>

                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </option>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        
        <div class="input-content">
            <label for="">Điểm nổi bật</label>
            <textarea class="form-control " rows="10" id="ckeditor1" name="tour_outstanding" required><?php echo e($edt_t->tour_outstanding); ?></textarea>
        </div>
        <div class="input-content">
            <label for="">Nơi khởi hành</label>
            <input value="<?php echo e($edt_t->tour_departure); ?>" name="tour_departure" type="text" required>
        </div>
        <div class="input-content">
            <label for="">vị trí khởi hành</label>
            <input value="<?php echo e($edt_t->tour_start_location); ?>" name="tour_start_location" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Thời tiết</label>
            <input value="<?php echo e($edt_t->tour_weather); ?>" name="tour_weather" type="text" required>
        </div>
        <div class="input-content">
            <label for="">Phương tiện di chuyển</label>
            <input value="<?php echo e($edt_t->tour_vehicle); ?>" name="tour_vehicle" type="text" required>
        </div>
        <div class="input-content">
            <input class="save" type="submit" value="Lưu">
        </div>
    </form>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <script>
        document.getElementById('tour_image').addEventListener('change', function(event) {
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
    <script>
        document.getElementById('tour_avt').addEventListener('change', function(event) {
            var previewImage1 = document.getElementById('previewImage1');
            var file = event.target.files[0];
            
            if (file) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage1.src = e.target.result;
                    previewImage1.style.display = 'block'; // Hiển thị hình ảnh đã chọn
                };
                
                reader.readAsDataURL(file);
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/edit_tour.blade.php ENDPATH**/ ?>