 <?php
    $chart_title = "Products liked"; 
    $chart_x = 'product';
    $chart_y = "liked";
    $page = 0;
    $limit = 10;
    
    $query_cmd = "";
    $begin =""; 
    $end = ""; 
    
    $likes = ("SELECT 
                products.product_id,
                products.product_title as x,
                count(likes.product_id) as  y
                from products
                LEFT JOIN product_likes as likes ON likes.product_id = products.product_id
                GROUP BY products.product_id  
                ORDER BY products.product_title
                LIMIT " . $page * $limit . ",$limit; 
                ");

    $salesByCart = ("
                SELECT sum(cart.quantity) as y , cart.cart_id as cart, 
                DATE_FORMAT(cart.purchase_at,'%Y%/%m/%d') as x FROM user_cart as cart 

                LEFT JOIN products ON products.product_id = cart.product_id LEFT JOIN users ON users.user_id = cart.user_id 
                GROUP BY DATE_FORMAT(cart.purchase_at, '%Y%m%d')

                ORDER BY cart.purchase_at DESC;
                ");

    if (isset($_GET['sales'])) {
        $query_cmd = $salesByCart;
        $chart_title = "Sales"; 
        $chart_x = 'by date';
        $chart_y = "quantity";
    }else{
        $query_cmd = $likes; //
    }


    if (isset($_GET['page'])) {
        if (!empty($_GET['page'])) {
            $page = $_GET['page'];
        }
    }

   

    
    $query = query($query_cmd);

    $chart = $query->fetch_all(MYSQLI_ASSOC);
    /*echo "<pre>";
    print_r($chart);
    echo "</pre>";
*/
    ?>

 <div class="col-md-12">
     <div class="row">
         <h1 class="page-header">
             <?= $chart_title ?>

         </h1>
     </div>

     <div class="row">
         <?php


            ?>
         <table class="highchart table table-striped" data-graph-container-before="1" data-graph-type="column">
             <thead>
                 <tr>
                     <th><?= $chart_x; ?></th>
                     <th><?= $chart_y; ?></th>

                 </tr>
             </thead>
             <tbody>
                 <?php foreach ($chart as $key => $line) : ?>
                     <tr>
                         <td><?= $line['x']; ?></td>
                         <td><?= $line['y']; ?></td>

                     </tr>
                 <?php endforeach; ?>
             </tbody>
         </table>
     </div>

     <script>
         $(document).ready(function() {
             $('table.highchart').highchartTable();
         });
         //jQuery(document).ready(function() {
         // jQuery('table.highchart').highchartTable();
         //});
     </script>