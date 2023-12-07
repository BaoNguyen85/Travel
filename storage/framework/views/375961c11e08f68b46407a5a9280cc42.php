
<?php $__env->startSection('admin_content'); ?>
    <div class="head-title">
        <h3>THỐNG KÊ</h3>
    </div>
    <div>
        <form autocomplete="off">
            <?php echo csrf_field(); ?>
            <div class="statistical">
                Từ ngày: <input class="statistical-input" type="text" id="datepicker" >&nbsp;&nbsp; Đến ngày: <input class="statistical-input" type="text" id="datepicker2">
                
                &nbsp;&nbsp;<input class="statistical-button" type="button" id="btn-dashboard-filter" value="Lọc kết quả">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Lọc theo: 
                    <select class="dashboard-filter" id="dashboardFilter">
                        <option>--Chọn--</option>
                        <option value="7ngay">7 ngày qua</option>
                        <option value="thangtruoc">tháng trước</option>
                        <option value="thangnay">tháng này</option>
                        <option value="365ngayqua">365 ngày qua</option>
                    </select>&nbsp;&nbsp;
                
            </div>
        </form>
        <div class="colum-access">
            <div class="colum-access1">
                <label style="font-size: 17px">Hướng Dẫn Viên</label>
                <?php
                    $tourguideTotal = 0;
                ?>
                <?php $__currentLoopData = $all_tourguide; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tourguide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $tourguideTotal++;
                    ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <h1 style="padding-top: 6%"><?php echo e($tourguideTotal); ?> &nbsp;<i class="fa-solid fa-user-tie"></i></h1>
            </div>
            <div class="colum-access2">
                <label style="font-size: 17px">Đơn Hàng</label>
                <?php
                    $orderTotal = 0;
                ?>
                <?php $__currentLoopData = $all_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $orderTotal++;
                    ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <h1 style="padding-top: 6%"><?php echo e($orderTotal); ?> &nbsp;<i class="fa-solid fa-cart-shopping"></i></h1>
            </div>
            <div class="colum-access3">
                <label style="font-size: 17px">Khách Hàng</label>
                <?php
                    $customerTotal = 0;
                ?>
                <?php $__currentLoopData = $all_customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $customerTotal++;
                    ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <h1 style="padding-top: 6%"><?php echo e($customerTotal); ?> &nbsp;<i class="fa-solid fa-users"></i></h1>
            </div>
        </div>
        <div >
            <div id="myfirstchart" style="height: 400px;"></div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            // Chọn giá trị mặc định
            $('#dashboardFilter').val('365ngayqua');

            // Gọi hàm khi trang được tải lại
            chart30daysorder();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/dashboard.blade.php ENDPATH**/ ?>