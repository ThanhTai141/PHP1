<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Kiểm tra yêu cầu xóa sản phẩm
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];

    // Tìm và xóa sản phẩm trong giỏ hàng
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $remove_id) {
            unset($_SESSION['cart'][$key]);
        }
    }

    // Cập nhật lại chỉ mục mảng sau khi xóa
    $_SESSION['cart'] = array_values($_SESSION['cart']);

    // Làm mới lại trang sau khi xóa thành công
    header("Location: cart.php");
    exit();
}
?>
