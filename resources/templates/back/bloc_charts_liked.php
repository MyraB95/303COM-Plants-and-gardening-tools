 <?php
    $chart_title = "Products liked"; 
    $chart_x = 'product';
    $chart_y = "liked";
    $page = 0;
    $limit = 5;
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

   
        $query_cmd = $likes; //
    


   

    
    $query = query($query_cmd);

    $chart = $query->fetch_all(MYSQLI_ASSOC);
    /*echo "<pre>";
    print_r($chart);
    echo "</pre>";
*/
    ?>

         <h3 class="page-header">
             <?= $chart_title ?>

         </h3>

 
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

     <script>
         $(document).ready(function() {
             $('table.highchart').highchartTable();
         });
         //jQuery(document).ready(function() {
         // jQuery('table.highchart').highchartTable();
         //});
     </script>