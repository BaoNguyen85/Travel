<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Close Popup</title>
</head>
<body>
    <script>
        // Đóng cửa sổ và chuyển hướng về trang trước đó
        window.close();
        window.opener.location.href = '<?php echo e($payUrl); ?>';
    </script>
</body>
</html><?php /**PATH D:\XAMPP\htdocs\travel\resources\views/close.blade.php ENDPATH**/ ?>