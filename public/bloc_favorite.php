<?php require_once("../resources/config.php");
require_once("../resources/functions.php");
// show if user is logued  
// number of showed 
$limit = 3;

if (isset($_SESSION['user_id'])) :

    /// likes
    $query = query("SELECT 
    products.*
    FROM product_likes as likes  
     LEFT JOIN products ON products.product_id = likes.product_id
     WHERE likes.user_id=$_SESSION[user_id]
     AND likes.product_id NOT IN (SELECT cart.product_id FROM user_cart as cart where cart.user_id=$_SESSION[user_id])
     LIMIT 0,$limit; 
     ");

    $liked = $query->fetch_all(MYSQLI_ASSOC);

    if (sizeof($liked) > 0) :
?>
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <h3>Your Favorites </h3>
            </div>
            <?php
            foreach ($liked as $key => $row) :
            ?>

                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <a href="item.php?id=<?= $row['product_id'] ?>"><img src="<?= $row['product_image'] ?>" alt=""></a>

                        <div class="caption-full">
                            <h4><a href="#"><?php echo $row['product_title']; ?></a></h4>
                            <hr>
                            <h4 class=""><?php echo "&#36;" . $row['product_price']; ?></h4>

                            <p><?php echo $row['short_desc']; ?></p>

                            <form action="" method="post">
                                <div class="form-group">
                                    <!-- Button changed to "Purchase" -->
                                    <input type="button" class="btn btn-primary" value="Add to cart" onclick="addToCart(<?php echo $row['product_id']; ?>,'<?php echo $row['product_title']; ?>',<?php echo $row['product_price']; ?>)">
                                    <!-- Add to Favorite Button -->
                                    <button type="button" class="btn btn-default" onclick="addToFavorites(<?php echo $row['product_id']; ?>)">❤ Favorite</button>
                                </div>
                            </form>

                            <!-- Hidden thank you message, initially not displayed -->
                            <div id="thankYouMessage" style="display:none;">

                            </div>

                        </div>
                    </div>
                </div>

            <?php
            endforeach;
            ?>
        </div>
<?php
    endif;
endif; 
?>