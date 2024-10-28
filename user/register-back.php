
<?php
session_start();
error_reporting(E_ALL ^ E_DEPRECATED);
require_once('../model/connect.php');

if(isset($_POST['submit'])){
    if(!empty($_POST['fullname']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['address']) && !empty($_POST['phone'])) {
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $password =($_POST['password']);
        $sql = "INSERT INTO users (fullname, username,password, email, address, phone, role) VALUES ( '$fullname','$username','$password','$email', '$address', '$phone',1)";
        $result = mysqli_query($conn, $sql);
if($result){
    $_SESSION['success'] = "Đăng ký thành công";
    header('Location: login.php?rs=success');
    exit();
}else{
    $_SESSION['error'] = "Đăng ký thất bại";
    header('Location: register.php?rf=fail');
    exit();
}
    }
}
?>