<?php 
$page = 0;

$limit = 5;  


$query = query("SELECT 
products.*,
cart.id as id,
sum(cart.quantity) as quantity , 
cart.cart_id as  cart,
cart.purchase_at as purchase,
users.full_name as name
FROM user_cart as cart  
LEFT JOIN products ON products.product_id = cart.product_id
 LEFT JOIN users ON users.user_id = cart.user_id
 GROUP BY cart.cart_id

 ORDER BY purchase  DESC
 LIMIT ".$page*$limit.",$limit; 
 ");

$sales = $query->fetch_all(MYSQLI_ASSOC);
?>
       
<h3 class="page-header">
   Last Orders

</h3>


<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>S.N</th>
           <th>Title</th>
           
           <th>Quantity</th>
           <th>Total</th>
           <th>User</th>
           <th>Invoice Number</th>
           <th>Order Date</th>
           
      </tr>
    </thead>
    <tbody>

        <?php foreach($sales as $sale) : ?>
        <tr>
            <td><?=$sale['id'];?></td>
            <td><?=$sale['product_title'];?></td>
            <td><?=$sale['product_quantity'];?></td>
            <td><?= $sale['product_quantity']*$sale['product_price'];  ?></td>
            <td><?=$sale['name'];?></td>

            <td><a href="index.php?order&cart=<?=$sale['cart']?>"><?=$sale['cart'];?></a></td>
            <td><?=$sale['purchase'];?></td>

           
        </tr>
        <?php endforeach; ?>

    </tbody>
</table>

<a href ="index.php?orders">See more</a>
</div>



