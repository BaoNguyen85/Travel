
<?php $__env->startSection('tourguide_content'); ?>
    <div class="head-title">
        <h3>LỊCH TRÌNH</h3>
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
            <th style="width: 10%;">Thứ tự</th>
            <th style="width: 25%;">Điểm đến</th>
            <th style="width: 10%;">Đánh dấu</th>
            <th style="width: 20%;">Sự cố</th>
            <th style="width: 20%;">Trạng thái</th>
            <th style="width: 15%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        ?>
        
            <?php $__currentLoopData = $edit_tourguide_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $edt_tgt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $all_destination_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $des_dtl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $all_place; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($pl->place_id == $des_dtl->place_id && $tour->tour_destination == $des_dtl->destination_id && $edt_tgt->tour_id == $tour->tour_id): ?>
                        <tr>
                            <td style="text-align: center;">
                                <?php echo e($i++); ?>

                            </td>
                            <td style="text-align: center;"> 
                                    <?php echo e($pl -> place_name); ?>

                            </td>
                            <td style="text-align: center;">
                                
                                <form class="check-form" method="post" action="<?php echo e(URL::to('/add-tourguide-schedule')); ?>" enctype="multipart/form-data">
                                    <?php echo e(csrf_field()); ?>

                                    
                                    <input type="hidden" name="tourguide_schedule_tour" value="<?php echo e($edt_tgt->tourdetail_id); ?>">
                                    <input type="hidden" name="tourguide_schedule_place" value="<?php echo e($pl->place_id); ?>">
                                    <input type="hidden" name="tourguide_schedule_status" value="0" >
                                    <input type="hidden" name="tourguide_schedule_reason" value="Thêm thông tin">
                                    <input type="hidden" name="checkbox_status" value="0">
                                    <input class="confirm" type="checkbox" value="Hoàn thành" onchange="submitForm(this)">
                                    
                                </form>
                            </td>
                            <td style="text-align: center;">
                                
                                    <?php $__currentLoopData = $all_tourguide_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tg_sch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($edt_tgt->tourdetail_id == $tg_sch->tourguide_schedule_tour && $tg_sch->tourguide_schedule_place == $des_dtl->place_id): ?>
                                        <?php echo e($tg_sch -> tourguide_schedule_reason); ?>

                                        <a style="float: right" href="<?php echo e(URL::to('/edit-schedule-reason/'.$tg_sch->tourguide_schedule_id)); ?>" class="btn-edit">
                                            <i class="fa-solid fa-pen-to-square"></i></a>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                            </td>
                            <td style="text-align: center;">
                                <?php if(count($all_tourguide_schedule) > 0): ?>
                                    <?php $found = false; ?>
                                    
                                        <?php $__currentLoopData = $all_tourguide_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tg_sch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($edt_tgt->tourdetail_id == $tg_sch->tourguide_schedule_tour && $tg_sch->tourguide_schedule_place == $des_dtl->place_id && $tg_sch->tourguide_schedule_status == 1): ?>
                                            <div style="color: green">Đã xử lý</div>
                                                <?php $found = true; break; ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php if(!$found): ?>
                                    <div style="color: rgb(206, 12, 12)">Chưa xử lý</div>
                                    <?php endif; ?>
                                <?php else: ?>
                                <div style="color: rgb(206, 12, 12)">Chưa xử lý</div>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center;">
                                
                                    <?php $__currentLoopData = $all_tourguide_schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $all_tg_sch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <form method="post" action="<?php echo e(URL::to('/update-schedule-status/'.$all_tg_sch->tourguide_schedule_id)); ?>" enctype="multipart/form-data">
                                            <?php echo e(csrf_field()); ?>

                                            
                                                <?php if($pl->place_id == $des_dtl->place_id && $all_tg_sch->tourguide_schedule_place == $des_dtl->place_id && $edt_tgt->tourdetail_id == $all_tg_sch->tourguide_schedule_tour): ?>
                                                <input type="hidden" name="tourguide_schedule_tour" value="<?php echo e($edt_tgt->tourdetail_id); ?>">
                                                <input type="hidden" name="tourguide_schedule_place" value="<?php echo e($pl->place_id); ?>">
                                                <input type="hidden" name="tourguide_schedule_status" value="1" >
                                                <input type="hidden" name="tourguide_schedule_reason" value="Không">
                                                <input class="confirm" type="submit" value="Hoàn thành">
                                                <?php endif; ?>

                                        </form>
                                        <form method="post" action="<?php echo e(URL::to('/update-schedule-status/'.$all_tg_sch->tourguide_schedule_id)); ?>" enctype="multipart/form-data">
                                            <?php echo e(csrf_field()); ?>

                                            <?php $__currentLoopData = $edit_tourguide_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $edt_tgt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($pl->place_id == $des_dtl->place_id && $all_tg_sch->tourguide_schedule_place == $des_dtl->place_id && $edt_tgt->tourdetail_id == $all_tg_sch->tourguide_schedule_tour): ?>
                                                    <input type="hidden" name="tourguide_schedule_tour" value="<?php echo e($edt_tgt->tour_id); ?>">
                                                    <input type="hidden" name="tourguide_schedule_place" value="<?php echo e($pl->place_id); ?>">
                                                    <input type="hidden" name="tourguide_schedule_status" value="1" >
                                                    <input type="hidden" name="tourguide_schedule_reason" value="Sự cố">
                                                    <input style="background-color: rgb(195, 58, 58); margin-top:3%" class="confirm" type="submit" value="Hủy">
                                                    <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                                        </form>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    </tbody>
</table>
<?php $__currentLoopData = $edit_tourguide_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $edt_tgt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($tourguideID == $edt_tgt->tourguide_id): ?>
<form method="post" action="<?php echo e(URL::to('/update-tour-status/'.$edt_tgt->tourdetail_id)); ?>" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

    <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($edt_tgt->tourdetail_id == $tourdetail->tourdetail_id): ?>
            <input type="hidden" name="tour_success" value="1" >
            <input class="finish" type="submit" value="Xong">
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
</form>
<form method="post" action="<?php echo e(URL::to('/update-tour-status/'.$edt_tgt->tourdetail_id)); ?>" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

    <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($edt_tgt->tourdetail_id == $tourdetail->tourdetail_id): ?>
            <input type="hidden" name="tour_success" value="2" >
            <input style="background-color: rgb(195, 58, 58);" class="finish" type="submit" value="Hủy tour">
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
</form>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div class="back-pages">
    <a href="<?php echo e(URL::to('/tourguide-new-tour')); ?>">
        <i class="fa-solid fa-arrow-left"></i> Quay lại</a>
</div>
<div class="content-schedule">
    <h3 style="padding-bottom: 1%">Chi tiết lịch trình</h3>
    <?php $__currentLoopData = $edit_tourguide_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $edt_tgt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $all_scheduledetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sch_dtl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($tour->tour_schedule == $sch_dtl->scheduledetail_id && $edt_tgt->tour_id == $tour->tour_id): ?>
                <?php echo $sch_dtl->scheduledetail_content; ?>

                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<script>
    function submitForm(radio) {
        radio.closest('.check-form').submit();
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('tourguide_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/tourguide_schedule.blade.php ENDPATH**/ ?>