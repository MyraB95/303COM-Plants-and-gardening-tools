<?php require_once("../resources/config.php"); ?>

<?php 
include(TEMPLATE_FRONT . DS . "header.php") ;
log_interaction($_GET['id'],"view",$connection); 

?>

<!-- Page Content -->
<div class="container">

    <!-- Side Navigation -->
    <?php include(TEMPLATE_FRONT . DS . "side_nav.php") ?>

    <?php 
    $query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['id']) . " ");
    confirm($query);
    while ($row = fetch_array($query)) :
    ?>


    <div class="col-md-9">

        <!--Row For Image and Short Description-->
        <div class="row">
            <div class="col-md-7">
                <img class="img-responsive" src="<?php echo $row['product_image']; ?>" alt="">
            </div>

            <div class="col-md-5">
                <div class="thumbnail">
                    <div class="caption-full">
                        <h4><a href="#"><?php echo $row['product_title']; ?></a></h4>
                        <hr>
                        <h4 class=""><?php echo "&#36;" . $row['product_price']; ?></h4>
                        <div class="ratings">
                            <p>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                4.0 stars
                            </p>
                        </div>
                        <p><?php echo $row['short_desc']; ?></p>

                        <form action="" method="post">
                            <div class="form-group">
                                <!-- Button changed to "Purchase" -->
                                <input type="button" class="btn btn-primary" value="Purchase" onclick="addToCart(<?php echo $row['product_id']; ?>,'<?php echo $row['product_title']; ?>',<?php echo $row['product_price']; ?>)">
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
            <!--Row For Image and Short Description-->
            <hr>

            <!-- More content goes here -->

        </div>
        <!-- /.col-md-9 -->

        <?php endwhile; ?>

    </div>
    <!-- /.container -->

    <script>
    // Function to show the thank you message
    function addToCart(productId,title,price) {
       // event.preventDefault(); 
        var xhr = new XMLHttpRequest();

        xhr.open('POST', 'add_to_cart.php', true); // PHP script to handle database update
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');// Prevent form from submitting for demonstration purposes
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                document.getElementById('thankYouMessage').innerHTML = "<p>"+xhr.responseText+"</p>"; 
                document.getElementById('thankYouMessage').style.display = 'block';
                <?php // log_interaction($_GET['id'],"add cart",$connection); ?>
               
            }
        };
        xhr.send('productId=' + productId+"&title="+title+"&price="+price);
        document.getElementById('thankYouMessage').innerHTML = "<p>Thanks for your purchase!</p>"
        document.getElementById('thankYouMessage').style.display = 'block';
    }

    // Function to add to favorites
    function addToFavorites(productId) {
        // AJAX request to the server
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_to_my_favorite.php', true); // PHP script to handle database update
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                document.getElementById('thankYouMessage').innerHTML = "<p>"+xhr.responseText+"</p>"; 
                document.getElementById('thankYouMessage').style.display = 'block';
                <?php // log_interaction($_GET['id'],"favorite",$connection); ?>

                // add 
               
            }
        };
        xhr.send('productId=' + productId);
    }


    





    </script>

    <?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
