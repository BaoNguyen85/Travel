<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initical-scale=1.0">
    <title>Xác nhận đơn hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="
    sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="background: rgb(236, 240, 241); border-radius: 12px; padding: 15px;">
        <div class="col-md-12">
            <p style="text-align: center;color: #000">Đây là email tự động. Quý khách vui lòng không trả lời email này.</p>
            <div class="row" style="background: #2e9cca;padding: 15px">

                <div class="col-md-6" style="text-align: center; color: #fff;font-weight:bold;font-size:30px">
                    <h4 style="margin: 0">CÔNG TY DU LỊCH TRAVEL VILO</h4>
                    <h6 style="margin: 0">THÔNG TIN XÁC NHẬN ĐƠN HÀNG</h6>
                </div>
                
            </div>

            <div class="col-md-12">
                <p style="color: #000;font-size:17px;">Quý khách vừa thực hiện đặt hàng tại shop với thông tin như sau:</p>
                <h4 style="color: #2e9cca;text-transform:uppercase">Thông tin khách hàng</h4>
                <p style="color: #000; font-weight: bold">Họ tên : <?php echo e($orderInfo['customer_name']); ?></p>
                <p style="color: #000; font-weight: bold">Email : <?php echo e($orderInfo['customer_mail']); ?></p>
                <p style="color: #000; font-weight: bold">Số điện thoại : <?php echo e($orderInfo['customer_phone']); ?></p>
                <p style="color: #000; font-weight: bold">Địa chỉ : <?php echo e($orderInfo['customer_address']); ?></p>

                <h4 style="color: #2e9cca;text-transform:uppercase">Thông tin đơn hàng</h4>
                <p style="color: #000; font-weight: bold">Mã đơn hàng : <strong style="color:#000; font-weight:normal"><?php echo e($orderInfo['order_code']); ?></strong></p>
                <p style="color: #000; font-weight: bold">Tên tour : <strong style="color:#000; font-weight:normal"><?php echo e($orderInfo['tour_name']); ?></strong></p>
                <p style="color: #000; font-weight: bold">Hướng dẫn viên : <strong style="color:#000; font-weight:normal"><?php echo e($orderInfo['tour_guide_name']); ?></strong></p>
                <p style="color: #000; font-weight: bold">Số điện thoại hướng dẫn viên : <strong style="color:#000; font-weight:normal"><?php echo e($orderInfo['tour_guide_phone']); ?></strong></p>
                <p style="color: #000; font-weight: bold">Mã khuyến mãi áp dụng : <strong style="color:#000; font-weight:normal"><?php echo e($orderInfo['coupon_code']); ?></strong></p>
                <p style="color: #000; font-weight: bold">Giảm : <strong style="color:#000; font-weight:normal">
                    <?php if(strlen($orderInfo['order_discount']) < 3): ?>
                        <?php echo e($orderInfo['order_discount']); ?>%
                    <?php else: ?>
                        <?php echo e(number_format($orderInfo['order_discount'], 0, ',', '.')); ?>đ
                    <?php endif; ?>
                </strong></p>
                <p style="color: #000; font-weight: bold">Số chỗ : <strong style="color:#000; font-weight:normal"><?php echo e($orderInfo['order_number_of_seats']); ?></strong></p>
                <p style="color: #000; font-weight: bold">Danh sách khách hàng tham gia : <strong style="color:#000; font-weight:normal"><br><pre><?php echo e($orderInfo['order_list_customer']); ?></pre></strong></p>
                <p style="color: #000; font-weight: bold">Thời gian bắt đầu : <strong style="color:#000; font-weight:normal"><?php echo e(\Carbon\Carbon::parse($orderInfo['time_start'])->format('H:i d/m/Y')); ?></strong></p>
                <p style="color: #000; font-weight: bold">Thời gian kết thúc : <strong style="color:#000; font-weight:normal"><?php echo e(\Carbon\Carbon::parse($orderInfo['time_end'])->format('H:i d/m/Y')); ?></strong></p>
                <p style="color: rgb(186, 25, 52)">Bất kỳ thông tin nào không hợp lệ hãy liên hệ với chúng tôi qua Email này!</p>
                <h4 style="color: #2e9cca;text-transform:uppercase">THANH TOÁN</h4>
                <p style="color: #000; font-weight: bold">Tổng : <strong style="color:#000; font-weight:normal"><?php echo e(number_format($orderInfo['order_total'],0,',','.')); ?>đ</strong></p>
                <p style="color: #000; font-weight: bold">Phương thức thanh toán : <strong style="color:#000; font-weight:normal">
                    <?php if($orderInfo['order_payment'] == 0): ?>
                    Thanh toán tại quầy
                    <?php else: ?>
                    Thanh toán qua ví điện tử
                    <?php endif; ?>
                </strong></p>
                <p style="color: #000; font-weight: bold">Trạng thái thanh toán : <strong style="color:#000; font-weight:normal">
                    <?php if($orderInfo['order_payment_status'] == 0): ?>
                    Chưa thanh toán
                    <?php else: ?>
                    Đã thanh toán
                    <?php endif; ?>
                </strong></p>
            </div>
            

        </div>

    </div>
</body>


</html><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/mail_order.blade.php ENDPATH**/ ?>