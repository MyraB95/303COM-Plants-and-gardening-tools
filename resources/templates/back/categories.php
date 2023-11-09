<?php 
$page = 0;
$limit = 10;  
if (isset($_GET['page'])){
    if (!empty($_GET['page'])){
$page = $_GET['page']; 
    }
}

$query = query("SELECT 
categories.*,
parent.cat_title as parent_title
FROM categories  
LEFT JOIN categories as parent  ON parent.cat_id = categories.parent
 LIMIT ".$page*$limit.",$limit; 
 ");

$categories = $query->fetch_all(MYSQLI_ASSOC);

?>
       
<div class="col-md-12">
<div class="row">
<h1 class="page-header">
   All categories

</h1>
</div>

<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>ID</th>
           <th>Title</th>
           <th>parent</th>
           
           
      </tr>
    </thead>
    <tbody>

        <?php foreach($categories as $category) : ?>
        <tr>
            <td><?=$category['cat_id'];?></td>
            <td><?=$category['cat_title'];?></td>
            <td><?=$category['parent_title'];?></td>
          

           
        </tr>
        <?php endforeach; ?>

    </tbody>
</table>
</div>



