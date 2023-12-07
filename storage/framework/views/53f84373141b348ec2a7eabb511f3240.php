
<?php $__env->startSection('admin_content'); ?>
<div class="head-title">
    <h3>DANH SÁCH ĐỊA DANH</h3>
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
            <th style="width: 15%;">Tên địa điểm</th>
            <th style="width: 10%;">Tỉnh thành</th>
            <th style="width: 15%;">Hình ảnh</th>
            <th style="width: 40%;">Mô tả</th>
            <th style="width: 10%;">Hiển thị</th>
            <th style="width: 10%;">Xử lý</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $all_place; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td style="text-align: center;"><?php echo e($pl -> place_name); ?></td>
            <td style="text-align: center;"><?php echo e($pl ->province->province_name); ?></td>
            <td style="text-align: center;"><img src="public/uploads/place/<?php echo e($pl -> place_image); ?>" height="200" width="100" style="border-radius: 10px"></td>
            <td><span>
                <?php echo $pl -> place_describe; ?>

            </span></td>
            <td style="text-align: center;"><span>
                <?php
                if($pl -> place_status==0){
                ?>
                <a class="show" href="<?php echo e(URL::to('/unactive-place/'.$pl->place_id)); ?>"><span style="color: green"><i class="fa-solid fa-eye"></i></span></a>
                <?php
                }else{
                ?>
                <a class="hidden" href="<?php echo e(URL::to('/active-place/'.$pl->place_id)); ?>"><span style="color: red"><i class="fa-solid fa-eye-slash"></i></span></a>
                <?php
                }
                ?>
            </span></td>
            <td style="text-align: center;">
                <a href="<?php echo e(URL::to ('/edit-place/'.$pl->place_id)); ?>" class="btn-edit">
                    <i class="fa-solid fa-pen"></i></a>
                <a onclick="return confirm('Are you sure to delete?')" href="<?php echo e(URL::to ('/delete-place/'.$pl->place_id)); ?>" class="btn-delete">
                    <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/all_place.blade.php ENDPATH**/ ?>