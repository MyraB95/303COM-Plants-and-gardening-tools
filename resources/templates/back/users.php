<?php 
$page = 0;

$limit = 10;  
if (isset($_GET['page'])){
    if (!empty($_GET['page'])){
$page = $_GET['page']; 
    }
}

$query = query("SELECT 
*
FROM users
 LIMIT ".$page*$limit.",$limit; 
 ");

$users = $query->fetch_all(MYSQLI_ASSOC);
?>
       
<div class="col-md-12">
<div class="row">
<h1 class="page-header">
   All users

</h1>
</div>

<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>id</th>
           <th>Name</th>
           <th>username</th>
           <th>Email</th>
           <th>Address</th>
           
      </tr>
    </thead>
    <tbody>

        <?php foreach($users as $user) : ?>
        <tr>
            <td><?=$user['user_id'];?></td>
            <td><?=$user['full_name'];?></td>
            <td><?=$user['username'];?></td>
            <td><a href="mailto:<?=$user['email'];?>"><?=$user['email'];?></a></td>
            <td><?=$user['address'];?></td>
        </tr>
        <?php endforeach; ?>

    </tbody>
</table>
</div>



