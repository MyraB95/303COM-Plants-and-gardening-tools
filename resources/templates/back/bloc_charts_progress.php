 <?php
    $chart_title = "Sales progress";
    $chart_x = 'Day';
    $chart_y = "number of sales";
    $chart_z = "Sales ( money) ";
    $page = 0;
    $limit = 5;
    $query_cmd = "";
    $begin = "";
    $end = "";

    $likes = (" SELECT sum(cart.quantity) as y ,sum(cart.quantity *products.product_price) as z , cart.cart_id as cart, 
    DATE_FORMAT(cart.purchase_at,'%Y%/%m/%d') as x FROM user_cart as cart 

    LEFT JOIN products ON products.product_id = cart.product_id LEFT JOIN users ON users.user_id = cart.user_id 
    GROUP BY DATE_FORMAT(cart.purchase_at, '%Y%m%d')

    ORDER BY cart.purchase_at ASC;
                ");


    $query_cmd = $likes; //






    $query = query($query_cmd);

    $chart = $query->fetch_all(MYSQLI_ASSOC);
    /*echo "<pre>";
    print_r($chart);
    echo "</pre>";
*/
    ?>

    <div class="row">
    <h2 class="page-header">
         <?= $chart_title ?>

     </h2>
    </row>

    <row>
 <div class="col-md-6">
     <h3 class="page-header">
         <?= $chart_y ?>

     </h3>


     <table class="highchart_progress table table-striped" data-graph-container-before="1" data-graph-type="line">
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
 <div class="col-md-6">
     <h3 class="page-header">
         <?= $chart_z ?>

     </h3>


     <table class="highchart_progress table table-striped" data-graph-container-before="1" data-graph-type="line">
         <thead>
             <tr>
                 <th><?= $chart_x; ?></th>

                 <th><?= $chart_z; ?></th>

             </tr>
         </thead>
         <tbody>
             <?php foreach ($chart as $key => $line) : ?>
                 <tr>
                     <td><?= $line['x']; ?></td>

                     <td><?= $line['z']; ?></td>

                 </tr>
             <?php endforeach; ?>
         </tbody>
     </table>
 </div>
             </div>
 <script>
     $(document).ready(function() {
         $('table.highchart_progress').highchartTable();
     });
     //jQuery(document).ready(function() {
     // jQuery('table.highchart').highchartTable();
     //});
 </script>