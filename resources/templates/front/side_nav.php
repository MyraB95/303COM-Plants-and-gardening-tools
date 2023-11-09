<div class="col-md-3">
    <p class="lead">Plant and Gardening tools</p>
    <div class="list-group">
        <?php
        // Fetch categories with their subcategories
        $query = query("SELECT * FROM categories"); //get_categories_with_subcategories();
        $categories = $query->fetch_all(MYSQLI_ASSOC); 
        
        $cats = []; 
        foreach ($categories as $key => $value): 
         
            if ($value['parent'] == 0 ):
                $cats[$value['cat_id']]= $value; 
                $cats[$value['cat_id']]['subcategories'] = []; 
            else : 
               // $//cats[$value->cat_id]= $value; 
               $cats[$value['parent']]['subcategories'][] = $value;     
            endif;
            
        endforeach; 

        
        // Loop through categories
        ?>
<ul>
        <?php 
        foreach ($cats  as $key =>$category) {
            
            echo "<li class='category-item'>";
            echo "<a href='category.php?id={$category['cat_id']}' class='list-group-item category-link'>{$category['cat_title']}</a>";

            // Check if subcategories exist
            if (!empty($category['subcategories'])) {

                echo "<ul class='subcategory-list'>";
                
                // Loop through subcategories
                foreach ($category['subcategories'] as $subcategory) {
                    echo "
                    <li>
                    <a href='category.php?id={$subcategory['cat_id']}' class='subcategory-link'>{$subcategory['cat_title']}</a></li>";
                }

                echo "</ul>"; // Close subcategory-list
            }
            echo "</li>"; // Close category-item
        }
        ?>

</ul>
    </div>
</div>
<br/><br/>
