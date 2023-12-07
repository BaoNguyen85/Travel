<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo e(asset ('/../resources/css/dashboard.css')); ?>" rel='stylesheet' type='text/css' />
        <script src="https://cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        
        <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <title>Admin</title>
        <link rel="icon" href="<?php echo e(asset('../public/frontend/images/logo2.png')); ?>" type="image/x-icon">
    </head>
    <body>
        <div class="container">
            <div class="sidebar">
                <div class="menu-btn">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="head">
                    <div class="user-img">
                        <img src="<?php echo e(asset('../public/frontend/images/user.png')); ?>">
                    </div>
                    <div class="user-details">
                        <p class="title">Admin</p>
                        <p class="name">
                            <?php
                            $name = Session::get('admin_name');
                            echo $name;
                            ?>
                        </p>
                    </div>
                </div>
                <div class="nav">
                    <div class="menu">
                        <p class="title">Main</p>
                        <ul>
                            <li>
                                <a href="<?php echo e(URL::to('/dashboard')); ?>">
                                    <i class="fa-solid fa-house"></i>
                                    <span class="text">Thống kê</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(URL::to('/all-order ')); ?>">
                                    <i class="fa-solid fa-book"></i>
                                    <span class="text">Quản lý đơn hàng</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa-solid fa-landmark"></i>
                                    <span class="text">Quản lý địa danh</span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo e(URL::to('/new-place')); ?>">
                                            <span class="text">Thêm địa danh</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL::to('/all-place')); ?>">
                                            <span class="text">Danh sách địa danh</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="text">Quản lý điểm đến</span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo e(URL::to('/new-destination')); ?>">
                                            <span class="text">Thêm điểm đến</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL::to('/all-destination')); ?>">
                                            <span class="text">Danh sách điểm đến</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL::to('/new-destination-detail')); ?>">
                                            <span class="text">Thêm chuỗi điểm đến</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL::to('/all-destination-detail')); ?>">
                                            <span class="text">Danh sách chuỗi điểm đến</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa-brands fa-squarespace"></i>
                                    <span class="text">Quản lý loại tour</span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo e(URL::to('/new-tour-type')); ?>">
                                            <span class="text">Thêm loại tour</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL::to('/all-tour-type')); ?>">
                                            <span class="text">Danh sách loại tour</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa-solid fa-plane"></i>
                                    <span class="text">Quản lý tour</span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo e(URL::to('/new-tour')); ?>">
                                            <span class="text">Thêm tour</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL::to('/all-tour')); ?>">
                                            <span class="text">Danh sách tour</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL::to('/new-tour-detail')); ?>">
                                            <span class="text">Thêm chi tiết tour</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL::to('/all-tour-detail')); ?>">
                                            <span class="text">Danh sách chi tiết tour</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <span class="text">Quản lý lịch trình</span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo e(URL::to('/new-schedule')); ?>">
                                            <span class="text">Thêm lịch trình</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL::to('/all-schedule')); ?>">
                                            <span class="text">Danh sách lịch trình</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL::to('/new-schedule-detail')); ?>">
                                            <span class="text">Thêm chi tiết lịch trình</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL::to('/all-schedule-detail')); ?>">
                                            <span class="text">Danh sách chi tiết lịch trình</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li>
                                <a href="<?php echo e(URL::to('/all-customer')); ?>">
                                    <i class="fa-solid fa-address-book"></i>
                                    <span class="text">Quản lý khách hàng</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa-solid fa-ticket"></i>
                                    <span class="text">Quản lý mã giảm giá</span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo e(URL::to('/new-coupon')); ?>">
                                            <span class="text">Thêm mã giảm giá</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL::to('/all-coupon')); ?>">
                                            <span class="text">Danh sách mã giảm giá</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa-solid fa-user-ninja"></i>
                                    <span class="text">Quản lý hướng dẫn viên</span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo e(URL::to('/new-tourguide')); ?>">
                                            <span class="text">Thêm hướng dẫn viên</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL::to('/all-tourguide')); ?>">
                                            <span class="text">Danh sách hướng dẫn viên</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="menu">
                        <p class="title">Settings</p>
                        <ul>
                            <li>
                                <a href="<?php echo e(URL::to('/admin-infor/'.$adminID)); ?>">
                                    <i class="fa-solid fa-user"></i>
                                    <span class="text">Account</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(URL::to('/information-infor/1')); ?>">
                                    <i class="fa-solid fa-gear"></i>
                                    <span class="text">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="menu">
                    <p class="title">Account</p>
                    <ul>
                        
                        <li>
                            <a href="<?php echo e(URL::to('/admin-logout')); ?>">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span class="text">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content">
                <?php echo $__env->yieldContent('admin_content'); ?>
            </div>
        </div>
        

        <script
        src="https://cdjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"
        integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw=="
        crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="<?php echo e(asset ('/../resources/js/script.js')); ?>"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        
        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script>
            CKEDITOR.replace('ckeditor1');
            CKEDITOR.replace('ckeditor2');
            CKEDITOR.replace('ckeditor3');
            CKEDITOR.replace('ckeditor4');
            CKEDITOR.replace('ckeditor5');
            CKEDITOR.replace('ckeditor6');
        </script>   
        <script type="text/javascript">
            $(function(){
                $("#datepicker").datepicker({
                    prevText:"Tháng trước",
                    nextText:"Tháng sau",
                    dateFormat:"yy-mm-dd",
                    dayNamesMin: ["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"],
                    duration: "slow"
                });
            })
            $(function(){
                $("#datepicker2").datepicker({
                    prevText:"Tháng trước",
                    nextText:"Tháng sau",
                    dateFormat:"yy-mm-dd",
                    dayNamesMin: ["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"],
                    duration: "slow"
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
    
                chart30daysorder();
                var chart = new Morris.Line({
                    element: 'myfirstchart',
                    lineColors: ['#33A70F', '#00B3FF', '#FF6541', '#A4ADD3', '#766B56'],
                    pointFillColors: ['#ffffff'],
                    pointStrokeColors: ['#2A2A25'],
                    hideHover: 'auto',
                    parseTime: false,
                    xkey: 'period',
                    ykeys: ['order', 'sales', 'quantity'],
                    labels:['Đơn hàng','Doanh thu','Số chỗ']
                });
    
                function chart30daysorder(){
                    // var _token = $('input[name="_token"]').val();
                    // $.ajax({
                    //     url:"<?php echo e(url('/days-order')); ?>",
                    //     method:"POST",
                    //     dataType:"JSON",
                    //     data:{_token:_token},
                    //     success:function(data){
                    //         chart.setData(data);
                    //     }
                    // });
                    var _token = $('input[name="_token"]').val();
                    var dashboard_value = $('#dashboardFilter').val(); // Lấy giá trị từ dropdown

                    $.ajax({
                        url: "<?php echo e(url('/dashboard-filter')); ?>",
                        method: "POST",
                        dataType: "JSON",
                        data: {dashboard_value: dashboard_value, _token: _token},
                        success: function(data){
                            chart.setData(data);
                        }
                    });
                }
    
                $('.dashboard-filter').change(function(){
                    var dashboard_value = $(this).val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"<?php echo e(url('/dashboard-filter')); ?>",
                        method:"POST",
                        dataType:"JSON",
                        data:{dashboard_value:dashboard_value,_token:_token},
                        success:function(data){
                            chart.setData(data);
                        }
                    });
                });
                
                $('#btn-dashboard-filter').click(function(){
                    var _token = $('input[name="_token"]').val();
                    var from_date = $('#datepicker').val()
                    var to_date = $('#datepicker2').val()
                    
                    $.ajax({
                        url:"<?php echo e(url('/filter-by-date')); ?>",
                        method:"POST",
                        dataType:"JSON",
                        data:{from_date:from_date,to_date:to_date,_token:_token},
                        success:function(data){
                            chart.setData(data);
                        }
                    });
                });
                
    
            });
    
        </script>     
    </body>
</html><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/admin_layout.blade.php ENDPATH**/ ?>