<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $title = $_POST['title'];
    $contents = $_POST['contents'];

   
    $products = $_POST['products']; 
   
    // echo "<div class='container'>";
    // echo "<h2>Order Confirmation</h2>";
    // echo "<p>Thank you, <strong>$name</strong>! Here are your order details:</p>";
    // echo "<p>Email: $email</p>";
    // echo "<p>Order Title: $title</p>";
    // echo "<p>Additional Information: $contents</p>";

    // echo "<h3>Products Ordered:</h3>";
    // echo "<ul>";
    // foreach ($products as $product) {
    //     echo "<li>{$product['name']} - Quantity: {$product['quantity']} - Price: " . number_format($product['price']) . "₫</li>";
    // }
    // echo "</ul>";

    // // Tính tổng giá trị đơn hàng
    // $total_price = 0;
    // foreach ($products as $product) {
    //     $total_price += $product['price'] * $product['quantity'];
    // }
    // echo "<h4>Total Price: " . number_format($total_price) . "₫</h4>";
    // echo "</div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <?php
        // Đoạn mã xử lý đơn hàng
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin người dùng từ form
            $name = $_POST['name'];
            $email = $_POST['email'];
            $title = $_POST['title'];
            $contents = $_POST['contents'];

            // Lấy thông tin sản phẩm từ form
            $products = $_POST['products'];

            // Hiển thị thông tin xác nhận
            echo "<h2>Order Confirmation</h2>";
            echo "<p>Thank you, <strong>$name</strong>! Here are your order details:</p>";
            echo "<p>Email: $email</p>";
            echo "<p>Order Title: $title</p>";
            echo "<p>Additional Information: $contents</p>";

            echo "<h3>Products Ordered:</h3>";
            echo "<table class='table table-bordered'>";
            echo "<thead><tr><th>Product Name</th><th>Quantity</th><th>Price</th></tr></thead>";
            echo "<tbody>";
            $total_price = 0;
            foreach ($products as $product) {
                $item_total = $product['price'] * $product['quantity'];
                $total_price += $item_total;
                echo "<tr><td>{$product['name']}</td><td>{$product['quantity']}</td><td>" . number_format($item_total) . "₫</td></tr>";
            }
            echo "</tbody></table>";
            echo "<h4>Total Price: " . number_format($total_price) . "₫</h4>";
        } else {
            echo "<p>No order information found.</p>";
        }
        ?>
        <a href="index.php" class="btn btn-primary">Back to Home</a>
    </div>
</body>
</html>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Order Confirmation</h2>

        <h3>Contact Information</h3>
        <p><strong>Name:</strong> <?php echo $contact['name']; ?></p>
        <p><strong>Email:</strong> <?php echo $contact['email']; ?></p>
        <p><strong>Order Title:</strong> <?php echo $contact['title']; ?></p>
        <p><strong>Additional Information:</strong> <?php echo $contact['contents']; ?></p>

        <h3>Order Details</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $total_price = 0; ?>
                <?php foreach ($orderDetails as $item): 
                    $item_total = $item['price'] * $item['quantity'];
                    $total_price += $item_total;
                ?>
                <tr>
                    <td><img src="<?php echo $item['image']; ?>" width="70" height="70"></td>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo number_format($item['price']); ?>₫</td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo number_format($item_total); ?>₫</td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" class="text-right"><strong>Total:</strong></td>
                    <td><?php echo number_format($total_price); ?>₫</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html> -->
