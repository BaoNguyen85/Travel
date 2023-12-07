
<?php $__env->startSection('admin_content'); ?>
<div class="head-title">
    <h3>DANH SÁCH CHI TIẾT TOUR</h3>
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
            <th style="width: 20%;">Tên tour</th>
            <th style="width: 10%;">Hình ảnh</th>
            <th style="width: 20%;">Thời gian</th>
            <th style="width: 5%;">Số chỗ</th>
            <th style="width: 15%;">Hướng dẫn viên</th>
            <th style="width: 15%;">Trạng thái</th>
            <th style="width: 15%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $all_tourdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td style="text-align: center;">
                <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($tour->tour_id == $tourdetail->tour_id): ?>
                    <?php echo e($tour->tour_name); ?>

                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td style="text-align: center;">
                <?php $__currentLoopData = $all_tour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($tour->tour_id == $tourdetail->tour_id): ?>
                    <img src="public/uploads/tour/<?php echo e($tour -> tour_avt); ?>" height="150" width="100" style="border-radius: 10px">
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td style="text-align: center;">
                <?php echo e(\Carbon\Carbon::parse($tourdetail->date_start)->format('H:i d/m/Y')); ?>  <br> <?php echo e(\Carbon\Carbon::parse($tourdetail->date_end)->format('H:i d/m/Y')); ?>

            </td>
            <td style="text-align: center;">
                <?php echo e($tourdetail->number_of_seats); ?>

            </td>
            <td style="text-align: center;">
                <?php $__currentLoopData = $all_tourguide; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourguide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($tourguide->tourguide_id == $tourdetail->tourguide_id): ?>
                    <?php echo e($tourguide->tourguide_name); ?>

                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td style="text-align: center;">
                <?php if($tourdetail->tour_success==1): ?>
                <div style="color: rgb(255, 255, 255); background-color:green; border-radius:15px;margin: 0 20%">Hoàn thành</div>
                <?php elseif($tourdetail->tour_success==0): ?>
                <div style="color: rgb(255, 255, 255); background-color:rgb(198, 208, 0); border-radius:15px;margin: 0 20%">Tour mới</div>
                <?php else: ?>
                <div style="color: rgb(255, 255, 255); background-color:rgb(206, 12, 12); border-radius:15px;margin: 0 20%">Đã hủy</div>
                <?php endif; ?>
            </td>
            <td style="text-align: center;">
                <?php
                if($tourdetail->tour_show==0){
                ?>
                <a class="show" href="<?php echo e(URL::to('/unactive-tour/'.$tourdetail->tourdetail_id)); ?>"><span style="color: green"><i class="fa-solid fa-eye"></i></span></a>
                <?php
                }else{
                ?>
                <a class="hidden" href="<?php echo e(URL::to('/active-tour/'.$tourdetail->tourdetail_id)); ?>"><span style="color: red"><i class="fa-solid fa-eye-slash"></i></span></a>
                <?php
                }
                ?>
                <a href="<?php echo e(URL::to ('/edit-tour-detail/'.$tourdetail->tourdetail_id)); ?>" class="btn-edit">
                    <i class="fa-solid fa-pen"></i></a>
                
                <a onclick="return confirm('Are you sure to delete?')" href="<?php echo e(URL::to ('/delete-tour-detail/'.$tourdetail->tourdetail_id)); ?>" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/all_tour_detail.blade.php ENDPATH**/ ?>