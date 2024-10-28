<?php
session_start();
require_once '../model/connect.php';

$sql = "SELECT orders.id,orders.total, orders.date_order,  orders.status 
        FROM orders 
        JOIN users ON orders.user_id = users.id";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <link rel="stylesheet" href="path-to-bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
<style>
    /* Main layout */
body {
    background-color: #f8f9fa;
    font-family: Arial, sans-serif;
    color: #343a40;
}

.container {
    max-width: 900px;
    margin: 50px auto;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Header */
h1 {
    text-align: center;
    font-size: 2em;
    margin-bottom: 20px;
    color: #007bff;
}

/* Table styling */
.table {
    width: 100%;
    margin-bottom: 20px;
}

.table thead th {
    background-color: #007bff;
    color: white;
    font-weight: bold;
    text-align: center;
    border-top: none;
}

.table tbody td {
    vertical-align: middle;
    text-align: center;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f2f2f2;
}

.table-hover tbody tr:hover {
    background-color: #e9ecef;
}

/* Action Button */
.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
    font-weight: bold;
    padding: 5px 10px;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #0056b3;
}

/* Status Labels */
.status-label {
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 0.9em;
}

.status-pending {
    background-color: #ffc107;
    color: #212529;
}

.status-processed {
    background-color: #28a745;
    color: white;
}
</style>
</head>
<body>
    <h1>Order Management</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                    <td><?php echo $row['date_order']; ?></td>
                    <td><?php echo ($row['status'] == 0) ? 'Pending' : 'Processed'; ?></td>
                    <td>
                        <a href="order-details.php?orderId=<?php echo $row['id']; ?>" class="btn btn-primary">View</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
