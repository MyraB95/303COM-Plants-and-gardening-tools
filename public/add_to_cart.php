<?php require_once("../resources/config.php");
require_once("../resources/functions.php");
?>

<?php
if (isset($_POST)) {

   if (!isset($_SESSION['cart'])){
        $_SESSION['cart'] = []; 
    }
        $_SESSION['cart'][$_POST['productId']]['productId'] = $_POST['productId']; 
        $_SESSION['cart'][$_POST['productId']]['title'] = $_POST['title']; 
        $_SESSION['cart'][$_POST['productId']]['price'] = $_POST['price']; 
        if (isset($_SESSION['cart'][$_POST['productId']]['quantity'])){
            $_SESSION['cart'][$_POST['productId']]['quantity']++; 
        }
        else{
            $_SESSION['cart'][$_POST['productId']]['quantity'] = 1; 

        }
        log_interaction($_POST['productId'],"add cart",$connection); 

        echo 'add to cart'; 


         
    /*
        $query = $connection->prepare("INSERT INTO product_likes  (product_id, user_id) VALUES (?,?)");
        $query->bind_param("ss", $_POST['productId'], $_SESSION['user_id']);
        $query->execute();
        echo "Product add in your favorite";


        if ($query->error) {
            echo "Error: " . $query->error;
        } else {
            //header('Location: login.php');
            exit;
        }


        $query->close();*/
   
} else {
    set_message("");
}

?>