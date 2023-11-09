<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("../resources/config.php");
require_once("../resources/functions.php");



if (isset($_GET['add'])) {
    $productID = $_GET['add'];
    $query = query("SELECT * FROM products WHERE product_id=" . escape_string($productID));
    confirm($query);

    $product = fetch_array($query);

    if (!isset($_SESSION['cart'][$productID])) {
        $_SESSION['cart'][$productID] = [
            'quantity' => 0,
            'title' => $product['product_title'],
            'max_quantity' => $product['product_quantity']
        ];
    }
  //  if ($_SESSION['cart'][$productID]['quantity'] < $_SESSION['cart'][$productID]['max_quantity']) {
        $_SESSION['cart'][$productID]['quantity']++;
        redirect("checkout.php");
    /*} else {
        set_message("Only " . $product['product_quantity'] . " " . $product['product_title'] . " left");
        redirect("checkout.php");
    }*/
    
}

if (isset($_GET['remove'])) {
    $productID = $_GET['remove'];

    if (isset($_SESSION['cart'][$productID]) && $_SESSION['cart'][$productID]['quantity'] > 0) {
        $_SESSION['cart'][$productID]['quantity']--;

        if ($_SESSION['cart'][$productID]['quantity'] < 1) {
            unset($_SESSION['cart'][$productID]);
        }
    }

    redirect("checkout.php");
}

if (isset($_GET['delete'])) {
    $productID = $_GET['delete'];

    if (isset($_SESSION['cart'][$productID])) {
        $_SESSION['cart'][$productID]['quantity'] = 0;
        unset($_SESSION['cart'][$productID]);
    }

    redirect("checkout.php");
}

function cart() {
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $productId => $product) {
            $query = query("SELECT product_price, product_quantity FROM products WHERE product_id = " . $productId);
            confirm($query);
            $productData = fetch_array($query);
            $productPrice = $productData['product_price'];
            $productStock = $productData['product_quantity'];
            

            echo "<tr>";
            echo "<td>{$productId}</td>";
            echo "<td>{$product['title']}</td>";
    
            echo "<td>{$productPrice}</td>";
            echo "<td>{$product['quantity']}</td>";
            echo "<td>" . (floatval($product['quantity']) * floatval($productPrice)) . "</td>";

            // Display the stock status
            echo "<td>";
            if ($productStock > 0) {
                echo "In Stock";
            } else {
                echo "Out of Stock";
            }
            echo "</td>";

            // Add, Remove, and Delete buttons
            echo "<td>";
            if ($productStock > 0) {
                if ($product['quantity'] >= $productStock) {
                    echo "<p>Product finished</p>";
                } else {
                    echo "<a class='btn btn-success' href='cart.php?add={$productId}'>";
                    echo "Add <span class='glyphicon glyphicon-plus'></span>";
                    echo "</a> ";
                }
            }
            echo "<a class='btn btn-warning' href='checkout.php?remove={$productId}'>";
            echo "<span class='glyphicon glyphicon-minus'></span> Remove";
            echo "</a> ";

            echo "<a class='btn btn-danger' href='checkout.php?delete={$productId}'>";
            echo "Delete";
            echo "</a></td>";
            echo "</tr>";
        }
    }
}

function calculateOrderTotal() {
    $total = 0;

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $productId => $product) {
            $query = query("SELECT product_price FROM products WHERE product_id = " . $productId);
            confirm($query);
            $productData = fetch_array($query);
            $productPrice = $productData['product_price'];

            $subtotal = $product['quantity'] * $productPrice;
            $total += $subtotal;
        }
    }

    return $total;
}





?>







