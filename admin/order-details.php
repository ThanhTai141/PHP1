<?php
session_start();
require_once '../model/connect.php';

$orderId = $_GET['orderId'];

$sqlOrderDetails = "SELECT products.name, order_items.quantity, order_items.price 
                    FROM order_items 
                    JOIN products ON order_items.product_id = products.id 
                    WHERE order_items.order_id = ?";
$stmt = mysqli_prepare($conn, $sqlOrderDetails);
mysqli_stmt_bind_param($stmt, 'i', $orderId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
</head>
<body>
    <h1>Order Details</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <form method="post" action="process-order.php">
        <input type="hidden" name="orderId" value="<?php echo $orderId; ?>">
        <button type="submit" name="processOrder" class="btn btn-success">Mark as Processed</button>
    </form>
</body>
</html>
