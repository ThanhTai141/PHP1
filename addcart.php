 <?php
    session_start();
    require_once('model/connect.php');

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT id, name, price, image FROM products WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);

            $cartItem = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'quantity' => 1 
            ];

           
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            
            $productExists = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['id'] == $id) {
                    $item['quantity']++; 
                    $productExists = true;
                    break;
                }
            }

          
            if (!$productExists) {
                $_SESSION['cart'][] = $cartItem;
            }
// Cập nhật số lượng sản phẩm trong giỏ hàng
$prdCount = count($_SESSION['cart']);

// Kiểm tra nếu là AJAX request
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    echo json_encode(['success' => true, 'message' => 'Sản phẩm đã được thêm vào giỏ hàng.', 'count' => $prdCount]);
} else {
    // Nếu không phải AJAX, chuyển hướng đến index.php
    header('Location: index.php');
    exit();
}

            // header("Location: view-cart.php"); 
            // echo "Product not found!";
        }
    }
?>