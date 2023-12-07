
<?php $__env->startSection('admin_content'); ?>
<div class="head-title">
    <h3>DANH SÁCH TOUR</h3>
</div>
<?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message',null);
    }
?>
<table>
    <thead>
        <tr>
            <th style="width: 15%;">Tên tour</th>
            <th style="width: 10%;">Hình ảnh</th>
            <th style="width: 15%;">Tỉnh thành</th>
            <th style="width: 20%;">Điểm đến</th>
            <th style="width: 20%;">Lịch trình</th>
            <th style="width: 15%;">Giá</th>
            <th style="width: 5%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td style="text-align: center;"><?php echo e($tour -> tour_name); ?></td>
            <td style="text-align: center;"><img src="public/uploads/tour/<?php echo e($tour -> tour_avt); ?>" height="150" width="100" style="border-radius: 10px"></td>
            <td style="text-align: center;">
                <?php $__currentLoopData = $all_province; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($pr->province_id == $tour->tour_city): ?>
                <?php echo e($pr->province_name); ?>

                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td style="text-align: center;">
                <?php $firstPlace = true; ?>
                
                    <?php $__currentLoopData = $all_destination_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $des_dtl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $all_place; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(($pl->place_id == $des_dtl->place_id) && ($des_dtl->destination_id == $tour->tour_destination)): ?>
                                <?php if($firstPlace): ?>
                                    <?php echo e($pl->place_name); ?>

                                    <?php $firstPlace = false; ?>
                                <?php else: ?>
                                    - <?php echo e($pl->place_name); ?>

                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            </td>
            <td style="text-align: center;">
                <?php $__currentLoopData = $all_scheduledetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sh_dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $all_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($sh_dt->schedule_id == $sh->schedule_id && $sh_dt->scheduledetail_id == $tour->tour_schedule): ?>
                    <?php echo e($sh->schedule_name); ?>

                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td style="text-align: center;"><?php echo e(number_format($tour -> tour_price,0,',','.')); ?>đ</td>
            <td style="text-align: center;">
                <a href="<?php echo e(URL::to ('/edit-tour/'.$tour->tour_id)); ?>" class="btn-edit">
                    <i class="fa-solid fa-pen"></i></a>
                
                <a onclick="return confirm('Are you sure to delete?')" href="<?php echo e(URL::to ('/delete-tour/'.$tour->tour_id)); ?>" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/all_tour.blade.php ENDPATH**/ ?>