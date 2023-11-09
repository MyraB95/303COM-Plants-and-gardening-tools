<?php require_once("../resources/config.php");
 require_once("../resources/functions.php"); 

?>


<?php
if (isset($_POST)) {
    $query = $connection->query("SELECT count(*) AS `count`  FROM product_likes WHERE product_id='$_POST[productId]'  and user_id  = '$_SESSION[user_id]' ");
    $row = mysqli_fetch_array($query);
    $count = $row['count'];
    if ($count == 0) {
        $query = $connection->prepare("INSERT INTO product_likes  (product_id, user_id) VALUES (?,?)");
        $query->bind_param("ss", $_POST['productId'], $_SESSION['user_id']);
        $query->execute();
        log_interaction($_POST['productId'],"favorite",$connection); 

        echo "Product add in your favorite";


        if ($query->error) {
            echo "Error: " . $query->error;
        } else {
            //header('Location: login.php');
            exit;
        }


        $query->close();
    } else {
        echo " The product is on your liked product";
    }
} else {
    set_message("");
}

?>