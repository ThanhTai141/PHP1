<?php
session_start();
require_once 'model/connect.php'; // Database connection

// Check if the checkout form was submitted
if (isset($_POST['confirm_order'])) {
    // Capture form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $title = $_POST['title'];
    $contents = $_POST['contents'];
    $created = date("Y-m-d H:i:s"); // Current date and time
    $status = 0; // Assuming 0 means 'Pending'

    // Insert the contact information into the contacts table
    $sql = "INSERT INTO contacts (name, email, title, contents, created, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssssi', $name, $email, $title, $contents, $created, $status);
    mysqli_stmt_execute($stmt);

    // Get the last inserted contact ID
    $contactId = mysqli_insert_id($conn);

    // Store the order in session to display in the confirmation page
    $_SESSION['contactId'] = $contactId;
    $_SESSION['orderDetails'] = $_SESSION['cart'];

    // Redirect to the order confirmation page
    header("Location: order-confirmation.php");
    exit();
}
?>
