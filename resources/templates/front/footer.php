<div class="container">

<hr>

<!-- Footer -->
<footer>
    <div class="row">
        <div class="col-lg-12">
            <p>Copyright &copy; Plants and Gardening tools 2023 </p>
        </div>
    </div>
</footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<script>
    // Function to show the thank you message
    function addToCart(productId,title,price) {
        var xhr = new XMLHttpRequest();

        xhr.open('POST', 'add_to_cart.php', true); // PHP script to handle database update
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');// Prevent form from submitting for demonstration purposes
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
            
               
            }
        };
        xhr.send('productId=' + productId+"&title="+title+"&price="+price);
       
    }
    
    function addToFavorites(productId) {
        // AJAX request to the server
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_to_my_favorite.php', true); // PHP script to handle database update
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                              
            }
        };
        xhr.send('productId=' + productId);
    }
    </script>


</body>

</html>
