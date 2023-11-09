<?php 
$page = 0;

$limit = 10;  
if (isset($_GET['page'])){
    if (!empty($_GET['page'])){
$page = $_GET['page']; 
    }
}
"SELECT 
products.*,
cart.id as id,
cart.quantity as quantity , 
cart.cart_id as  cart,
cart.purchase_at as purchase,
users.full_name as name
FROM user_cart as cart  
LEFT JOIN products ON products.product_id = cart.product_id
 LEFT JOIN users ON users.user_id = cart.user_id
 ORDER BY purchase  DESC
 LIMIT ".$page*$limit.",$limit; 
 ";
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
       
<div class="col-md-12">
<div class="row">
<h1 class="page-header">
   All Orders

</h1>
</div>

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
</div>



