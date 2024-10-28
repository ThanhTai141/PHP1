<?php
    session_start();
    error_reporting(E_ALL ^ E_DEPRECATED);
    require_once('../model/connect.php');

    if (isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = '$username' AND password = ('$password')";
        $res = mysqli_query($conn,$sql);

        $rows = mysqli_num_rows($res);
        if ($rows > 0)
        {
            $_SESSION['username'] = $username; // Initializing Session,Khởi tạo Session cho username
            while($row = mysqli_fetch_assoc($res)) {
                $_SESSION['id-user'] = $row['id'];
                $_SESSION['role'] = $row['role'];
            }
          if ($_SESSION['role'] == 0) {
            header("location:../admin/product-list.php");
            exit();
          } elseif ($_SESSION['role'] == 1) {
            header("location:../index.php");
            exit();
          }

        } else {
            $_SESSION['error'] = 'Tên đăng nhập hoặc mật khẩu không hợp lệ!';
            
            header("location:../user/login.php?error=wrong");
            exit();
        }
    } else {
    //    echo 'lala';
    }
?>
 