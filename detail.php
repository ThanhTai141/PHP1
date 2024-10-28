<?php
    require_once("model/connect.php");

    // Lấy ID sản phẩm từ URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // Truy vấn để lấy thông tin sản phẩm theo ID
        $sql = "SELECT * FROM products WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        
        // Kiểm tra nếu có kết quả
        if ($result && mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
        } else {
            echo "Sản phẩm không tồn tại!";
            exit;
        }
    } else {
        echo "ID sản phẩm không hợp lệ!";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm - <?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

    <!-- Header -->
    <?php include("model/header.php"); ?>
    <!-- /header -->

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Hình ảnh sản phẩm -->
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="img-fluid" style="width: 100%; height: auto;">
            </div>

            <div class="col-md-6">
                <h2><?php echo $product['name']; ?></h2>
                <p>Giá: <strong><?php echo $product['price']; ?><sup> đ</sup></strong></p>
                <p>Mô tả: <?php echo $product['description']; ?></p>
                <p>Thông số kỹ thuật:</p>
                <ul>
                    <li>Category: <?php echo $product['category_id']; ?></li>
                    <li>Trạng thái: <?php echo ($product['status'] == 0) ? "Còn hàng" : "Hết hàng"; ?></li>
                    <!-- Thêm các thông tin khác nếu có -->
                </ul>
                <a href="addcart.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">
                    <label style="color: red;">&hearts;</label> Mua hàng <label style="color: red;">&hearts;</label>
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include("model/footer.php"); ?>
    <!-- /footer -->

</body>
</html>
