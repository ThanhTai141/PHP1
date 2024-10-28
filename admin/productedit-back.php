<?php
    // Hiển thị lỗi để debug
    error_reporting(E_ALL ^ E_DEPRECATED);
    require_once '../model/connect.php';
    error_reporting(2);

    // Kiểm tra xem có ID sản phẩm không
    if (isset($_GET['idProduct'])) {
        $idProduct = $_GET['idProduct'];
    } else {
        echo "ID sản phẩm không tồn tại!";
        exit();
    }

    // Lấy dữ liệu từ form khi người dùng nhấn nút edit
    if (isset($_POST['editProduct'])) {
        // Khởi tạo biến để lưu trữ các thông tin sản phẩm
        $namePr = $categoryPr = $pricePr = $salePricePr = $quantityPr = $keywordPr = $descriptPr = '';
        $status = 0;
        $image = '';

        // Kiểm tra xem có ảnh mới được upload không
        if (isset($_FILES['FileImage']) && $_FILES['FileImage']['name'] != '') {
            // Đường dẫn lưu trữ ảnh
            $target_file = "../uploads/" . basename($_FILES["FileImage"]["name"]);
            $image = basename($_FILES["FileImage"]["name"]);
            $uploadOk = 1;

            // Kiểm tra ảnh có phải định dạng hợp lệ không
            $check = getimagesize($_FILES["FileImage"]["tmp_name"]);
            if ($check === false) {
                echo "File không phải là ảnh.";
                $uploadOk = 0;
            }

            // Kiểm tra nếu file đã tồn tại
            if (file_exists($target_file)) {
                echo "File đã tồn tại.";
                $uploadOk = 0;
            }

            // Kiểm tra kích thước file (giới hạn 5MB)
            if ($_FILES["FileImage"]["size"] > 5000000) {
                echo "File quá lớn.";
                $uploadOk = 0;
            }

            // Chỉ cho phép các định dạng JPG, PNG, JPEG
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "Chỉ chấp nhận các định dạng JPG, JPEG, PNG.";
                $uploadOk = 0;
            }

            // Nếu tất cả các kiểm tra đều hợp lệ, tiến hành upload
            if ($uploadOk == 1) {
                if (!move_uploaded_file($_FILES["FileImage"]["tmp_name"], $target_file)) {
                    echo "Có lỗi khi tải lên tệp tin.";
                    exit();
                }
            } else {
                // Nếu không có ảnh mới, giữ nguyên ảnh cũ
                $image = $_POST['image'];
            }
        } else {
            // Nếu không có ảnh mới, giữ nguyên ảnh cũ
            $image = $_POST['image'];
        }

        // Lấy các thông tin khác từ form
        if (isset($_POST['txtName'])) {
            $namePr = $_POST['txtName'];
        }
        if (isset($_POST['category'])) {
            $categoryPr = $_POST['category'];
        }
        if (isset($_POST['txtPrice'])) {
            $pricePr = $_POST['txtPrice'];
        }
        if (isset($_POST['txtSalePrice'])) {
            $salePricePr = $_POST['txtSalePrice'];
        } else {
            $salePricePr = 0;
        }
        if (isset($_POST['txtNumber'])) {
            $quantityPr = $_POST['txtNumber'];
        }
        if (isset($_POST['txtKeyword'])) {
            $keywordPr = $_POST['txtKeyword'];
        }
        if (isset($_POST['txtDescript'])) {
            $descriptPr = $_POST['txtDescript'];
        }
        if (isset($_POST['status'])) {
            $status = $_POST['status'];
        }

        
        $sql = "UPDATE products SET 
                    name = '$namePr', 
                    category_id = '$categoryPr', 
                    image = '$image', 
                    description = '$descriptPr', 
                    price = '$pricePr', 
                    saleprice = '$salePricePr', 
                    quantity = '$quantityPr', 
                    keyword = '$keywordPr', 
                    status = '$status' 
                WHERE id = $idProduct";

        
        $result = mysqli_query($conn, $sql);

        if ($result) {
            
            header("Location: product-edit.php?idProduct=$idProduct&es=editsuccess");
            exit();
        } else {
           
            header("Location: product-edit.php?idProduct=$idProduct&ef=editfail");
            exit();
        }
    } else {
        echo 'Có lỗi xảy ra, không thể xử lý yêu cầu.';
    }
?>
