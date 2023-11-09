<?php 


$page = 0;

$limit = 10;  
if (isset($_GET['page'])){
    if (!empty($_GET['page'])){
$page = $_GET['page']; 
    }
}
if (!isset($_GET['cart']))
{
    header('Location: index.php?orders');
}

$query = query("SELECT 
products.*,
cart.id as id,
cart.quantity as quantity , 
cart.cart_id as  cart,
cart.purchase_at as purchase,
users.full_name as name,
users.address as address,
users.email as email

FROM user_cart as cart  
LEFT JOIN products ON products.product_id = cart.product_id
 LEFT JOIN users ON users.user_id = cart.user_id
 WHERE cart.cart_id = '$_GET[cart]'

 ORDER BY purchase  DESC
 ");

$sales = $query->fetch_all(MYSQLI_ASSOC);
?>
       
<div class="col-md-12">
<div class="row">
<h1 class="page-header">
    Orders

</h1>
</div>

<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>ID</th>
           <th>Title</th>
           <th>Photo</th>
           <th>Quantity</th>
           <th>Total</th>
           <th>Invoice Number</th>
           <th>Order Date</th>
           
      </tr>
    </thead>
    <tbody>

        <?php foreach($sales as $sale) : ?>
        <tr>
            <td><?=$sale['id'];?></td>
            <td><?=$sale['product_title'];?></td>
            <td><img src="http://placehold.it/62x62" alt=""></td>
            <td><?=$sale['product_quantity'];?></td>
            <td><?= $sale['product_quantity']*$sale['product_price'];  ?></td>
            <td><a href=""><?=$sale['cart'];?></a></td>
            <td><?=$sale['purchase'];?></td>
            <td><a href=""><?=$sale['cart'];?></a></td>

           
        </tr>
        <?php endforeach; ?>

    </tbody>
</table>
</div>
<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>ID</th>
           <th>Title</th>
           
           
      </tr>
    </thead>
    <tbody>

        <?php 
        if (sizeof($sales)> 0):
        //foreach($sales[0] as $sale) : 
        $user = $sales[0]; 
        ?>
        <tr>
            <td>Name</td>
           
            <td><?=$user['name'];?></td>

           
        </tr>
        <tr>
            <td>Email</td>
           
            <td><a href="mailto:<?=$user['email'];?>">
            <?=$user['email'];?></a></td>

           
        </tr>   <tr>
            <td>Address</td>
           
            <td><?=$user['address'];?></td>

           
        </tr>
        <?php //endforeach; 
        
        endif; 
        ?>

    </tbody>
</table>
</div>



