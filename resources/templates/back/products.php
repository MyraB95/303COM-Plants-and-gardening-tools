<?php 
$page = 0;

$limit = 10;  
if (isset($_GET['page'])){
    if (!empty($_GET['page'])){
$page = $_GET['page']; 
    }
}

$query = query("SELECT 
products.*,
categories.cat_title as category
FROM products   
LEFT JOIN categories ON categories.cat_id = products.product_cat_id

 LIMIT ".$page*$limit.",$limit; 
 ");
$products = $query->fetch_all(MYSQLI_ASSOC);
?>
       
<div class="col-md-12">
<div class="row">
<h1 class="page-header">
   All Products

</h1>
</div>

<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>S.N</th>
           <th>Title</th>
           <th>Photo</th>
           <th>Short description</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Category</th>
           
      </tr>
    </thead>
    <tbody>

        <?php foreach($products as $product) : ?>
        <tr>
            <td><?=$product['product_id'];?></td>
            <td><?=$product['product_title'];?></td>
            <td><img src="http://placehold.it/62x62" alt=""></td>
            <td><?=$product['short_desc'];?></td>
            <td><?= $product['product_price'];  ?></td>
            <td><a href=""><?=$product['product_quantity'];?></a></td>
            <td><?=$product['category'];?></td>

           
        </tr>
        <?php endforeach; ?>

    </tbody>
</table>
</div>



