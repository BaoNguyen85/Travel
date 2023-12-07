
<?php $__env->startSection('tourguide_content'); ?>
<div class="head-title">
    <h3>DANH SÁCH TOUR MỚI</h3>
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
            <th style="width: 25%;">Điểm đến</th>
            <th style="width: 20%;">Thời gian</th>
            <th style="width: 10%;">Số chỗ</th>
            <th style="width: 13%;">Trạng thái</th>
            <th style="width: 7%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($tourguideID == $tourdetail->tourguide_id && $tourdetail->tour_id == $tour->tour_id): ?>
        <tr>
            <td style="text-align: center;"><?php echo e($tour -> tour_name); ?></td>
            <td style="text-align: center;"><img src="public/uploads/tour/<?php echo e($tour -> tour_avt); ?>" height="150" width="100" style="border-radius: 10px"></td>
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
                <?php echo e(\Carbon\Carbon::parse($tourdetail->date_start)->format('H:i d/m/Y')); ?>  <br> <?php echo e(\Carbon\Carbon::parse($tourdetail->date_end)->format('H:i d/m/Y')); ?>

            </td>
            <td style="text-align: center;"><?php echo e($tourdetail -> number_of_seats); ?></td>
            <td style="text-align: center;">
                <?php if($tourdetail->tour_success==1): ?>
                <div style="color: rgb(255, 255, 255); background-color:green; border-radius:15px">Hoàn thành</div>
                <?php elseif($tourdetail->tour_success==0): ?>
                <div style="color: rgb(255, 255, 255); background-color:rgb(198, 208, 0); border-radius:15px">Tour mới</div>
                <?php else: ?>
                <div style="color: rgb(255, 255, 255); background-color:rgb(206, 12, 12); border-radius:15px">Đã hủy</div>
                <?php endif; ?>              
            </td>
            <td style="text-align: center;">
                <a href="<?php echo e(URL::to ('/tourist-tour/'.$tourdetail->tourdetail_id)); ?>" class="btn-edit" style="color: rgb(16, 97, 189);">
                    <i class="fa-solid fa-users-viewfinder"></i></a> <br><br>

                <a href="<?php echo e(URL::to ('/tourguide-schedule/'.$tourdetail->tourdetail_id)); ?>" class="btn-edit">
                    <i class="fa-solid fa-calendar-days"></i></a>
            </td>
        </tr>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('tourguide_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/tourguide_newtour.blade.php ENDPATH**/ ?>