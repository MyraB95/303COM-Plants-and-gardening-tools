<?php require_once("../resources/config.php"); ?>
<?php require_once("cart.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Now = new DateTime('now', new DateTimeZone('Asia/Kuala_Lumpur'));
    $cartid = $Now->format('Ymd-HisZ');
    if (isset($_SESSION['cart'])) {
        $query = $connection->prepare("INSERT INTO user_cart  (product_id, user_id, quantity,cart_id) 
        VALUES (?,?,?,?)");

        foreach ($_SESSION['cart'] as $key => $value) {

            $query->bind_param("ssss", $value['productId'], $_SESSION['user_id'], $value['quantity'], $cartid);
            $query->execute();
        }
        $_SESSION['cart'] = [];
    }
}


?>

<?php /*
<table>
    <thead>
        <tr>
            <th>Product ID</th>
            <th>Product Title</th>
            <th>Quantity</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $productId => $product) {
                echo "<tr>";
                echo "<td>{$productId}</td>";
                echo "<td>{$product['title']}</td>";
                echo "<td>{$product['quantity']}</td>";
                echo "</tr>";
            }
        }
        ?>
    </tbody>
</table>
*/ ?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <h1>Checkout</h1>
        <form action="">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Title</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Sub-total</th>
                    </tr>
                </thead>

                <tbody>
                    <?php cart(); ?>
                    <!-- Other product rows -->
                </tbody>
            </table>
        </form>

        <div class="col-xs-4 pull-right">
            <h2>Cart Totals</h2>

            <table class="table table-bordered" cellspacing="0">
                <tbody>
                    <tr class="cart-subtotal">
                        <th>Items:</th>
                        <td>
                            <span class="amount">
                                <?php
                                // Calculate the total number of items in the cart
                                $totalItems = 0;
                                if (isset($_SESSION['cart'])) {
                                    foreach ($_SESSION['cart'] as $product) {
                                        $totalItems += $product['quantity'];
                                    }
                                }
                                echo $totalItems;
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr class="shipping">
                        <th>Shipping and Handling</th>
                        <td>Free Shipping</td>
                    </tr>
                    <tr class="order-total">
                        <th>Order Total</th>
                        <td>
                            <strong>
                                <span class="amount">
                                    <?php
                                    // Calculate the total order amount based on the items in the cart
                                    $orderTotal = calculateOrderTotal();
                                    echo '$' . number_format($orderTotal, 2);
                                    ?>
                                </span>
                            </strong>

                        </td>
                    </tr>
                </tbody>
            </table>


            <form action="" method="post">
                <div class="form-group">
                    <!-- Button changed to "Purchase" -->
                    <input type="submit" class="btn btn-primary" value="Purchase">
                </div>
            </form>

            <!-- Hidden thank you message, initially not displayed -->
            <div id="thankYouMessage" style="display:none;">
                <p>Thanks for your purchase!</p>
            </div>

        </div>
    </div>
</div>

</div><!-- CART TOTALS-->
</div><!--Main Content-->
</div><!-- /.container -->


<td>
    </tr>
    <script>
        // Function to show the thank you message
        function showThankYouMessage(event) {
            event.preventDefault(); // Prevent form from submitting for demonstration purposes
            document.getElementById('thankYouMessage').style.display = 'block';
        }

        // Function to add to favorites, placeholder
        function addToFavorites(productId) {
            console.log('Add to favorites clicked for product:', productId);
            // Implement the AJAX call to server here or other logic
        }
    </script>

    <!-- Footer -->
    <?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>