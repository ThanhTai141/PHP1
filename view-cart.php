<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $id => $quantity) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $id) {
                $item['quantity'] = $quantity;
                break;
            }
        }
    }
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $remove_id) {
            unset($_SESSION['cart'][$key]);
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reset array keys after removal
}

$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" defer></script>
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css">-->
    <link rel="stylesheet" href="css/style.css"> 
</head>
<body>
    <div class="container">
        <h2>Shopping Cart</h2>

        <form action="order-confirmation.php" method="post">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($_SESSION['cart'])): ?>
                        <tr>
                            <td colspan="6" class="text-center">Your cart is empty!</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($_SESSION['cart'] as $item): 
                            $item_total = $item['price'] * $item['quantity'];
                            $total_price += $item_total;
                        ?>
                        <tr>
                            <td><img src="<?php echo $item['image']; ?>" width="70" height="70"></td>
                            <td><?php echo $item['name']; ?></td>
                            <td><?php echo number_format($item['price']); ?>₫</td>
                            <td>
                                <input type="number" name="quantities[<?php echo $item['id']; ?>]" value="<?php echo $item['quantity']; ?>" min="1">
                            </td>
                            <td><?php echo number_format($item_total); ?>₫</td>
                            <td><a href="cart.php?remove=<?php echo $item['id']; ?>" class="btn btn-danger">Remove</a></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total:</strong></td>
                            <td><?php echo number_format($total_price); ?>₫</td>
                            <td></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="text-right">
                <a href="index.php" class="btn btn-primary">Continue Shopping</a>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#checkoutModal">Proceed to Checkout</button>

                <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="order-confirmation.php" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" required>
                                    </div>
                                    <div class ="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" class="form-control" id="phone" name="phone" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Order Title</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="contents">Additional Information</label>
                                        <textarea class="form-control" id="contents" name="contents" rows="3"></textarea>
                                    </div>

                                    <!-- Hidden product information -->
                                    <?php foreach ($_SESSION['cart'] as $item): ?>
                                        <input type="hidden" name="products[<?php echo $item['id']; ?>][name]" value="<?php echo $item['name']; ?>">
                                        <input type="hidden" name="products[<?php echo $item['id']; ?>][quantity]" value="<?php echo $item['quantity']; ?>">
                                        <input type="hidden" name="products[<?php echo $item['id']; ?>][price]" value="<?php echo $item['price']; ?>">
                                    <?php endforeach; ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php include("model/footer.php"); ?>
    </div>
</body>
</html>
