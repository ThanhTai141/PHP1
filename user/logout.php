<?php
session_start();

// Hủy bỏ tất cả các session
session_unset();  // Xóa tất cả các biến session
session_destroy();  // Hủy bỏ session

$_SESSION['success'] = "Đăng xuất thành công!";
// Chuyển hướng người dùng về trang đăng nhập hoặc trang chủ
header("location:../user/login.php");
exit();
?>
