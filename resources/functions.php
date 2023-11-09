<?php
//require_once("../resources/config.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

function redirect($location)
{

  header("Location: $location ");
}

function query($sql)
{
  global $connection;
  return mysqli_query($connection, $sql);
}

function set_message($msg)
{
  if (!empty($msg)) {

    $_SESSION['message'] = $msg;
  } else {

    $msg = "";
  }
}






function display_message()
{
  if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
  }
}


function confirm($result)
{
  global $connection;
  if (!$result) {
    die("QUERY FAILED" . mysqli_error($connection));
  }
}


function escape_string($string)
{
  global $connection;
  return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result)
{

  return mysqli_fetch_array($result);
}
/*****front end functions */
// get products



// add_to_favorites.php
/*
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productId'])) {
    $productId = (int) $_POST['productId'];

    // Connect to your database here
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Update the product ranking
    $updateQuery = "UPDATE products SET ranking = ranking + 1 WHERE product_id = {$productId}";
    $result = mysqli_query($connection, $updateQuery);
    if (!$result) {
        echo "Failed to update product ranking";
    } else {
        echo "Product ranking updated successfully!";
    }

    // Close the database connection
    mysqli_close($connection);
}

*/






function get_products()
{
  $query = query("SELECT * FROM products");
  confirm($query);
  while ($row = fetch_array($query)) {
    $product = <<<DELIMITER
      <div class="col-sm-4 col-lg-4 col-md-4">
        <div class="thumbnail">
          <a href="item.php?id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a>
          <div class="caption">
            <h4 class="pull-right">&#36;{$row['product_price']}</h4>
            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a></h4>
            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
            <a class="btn btn-primary" target="_blank" href="cart.php?add={$row['product_id']}">Add to cart</a> 
            <button type="button" class="btn btn-default" onclick="addToFavorites(<?php echo {$row['product_id']}; ?>)">Add to cart</button>





          </div>
        </div>
      </div>
  DELIMITER;

    echo $product;
  }
}


function get_categories()
{
  $query = query("SELECT * FROM categories");
  confirm($query);



  while ($row = fetch_array($query)) {

    $categories_links = <<<DELIMETER
        <a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>
        DELIMETER;
    echo $categories_links;
  }
}


// Function to retrieve categories with their respective subcategories
function get_categories_with_subcategories()
{
  $query = query("SELECT * FROM categories");
  confirm($query);
  $categories = array();

  while ($row = fetch_array($query)) {
    $cat_id = $row['cat_id'];
    $subcategories = get_subcategories($cat_id); // Fetch subcategories related to the current category
    $row['subcategories'] = $subcategories;
    $categories[$cat_id] = $row;
  }

  return $categories;
}

function get_subcategories($cat_id)
{
  $query = query("SELECT * FROM subcategories WHERE parent_category_id = $cat_id");


  confirm($query);
  $subcategories = array();

  while ($row = fetch_array($query)) {
    $subcategory_id = $row['subcategory_id'];
    $subcategories[$subcategory_id] = $row;
  }

  return $subcategories;
}

// Display categories and their subcategories
function display_categories_and_subcategories()
{
  $categories = get_categories_with_subcategories();

  foreach ($categories as $category) {
    echo "<a href='category.php?id={$category['cat_id']}' class='list-group-item'>{$category['cat_title']}</a>";

    if (!empty($category['subcategories'])) {
      echo "<div class='subcategory-list'>";
      foreach ($category['subcategories'] as $subcategory) {
        echo "<a href='subcategory.php?id={$subcategory['subcategory_id']}' class='list-group-item'>{$subcategory['subcategory_name']}</a>";
      }
      echo "</div>";
    }
  }
}


// Call the function to display categories and subcategories
//display_categories_and_subcategories();



function get_products_in_cat_page()
{
  $query = query("SELECT * FROM products WHERE product_cat_id =" . escape_string($_GET['id']) . " ");
  confirm($query);
  if ($query->num_rows > 0) :

    while ($row = fetch_array($query)) {
      $product = <<<DELIMITER
    <div class="col-sm-4 col-lg-4 col-md-4">
      <div class="thumbnail">
        <a href="item.php?id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a>
        <div class="caption">
          <h4 class="pull-right">&#36;{$row['product_price']}</h4>
          <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a></h4>
          <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
          <a class="btn btn-primary" target="_blank" href="item.php?id={$row['product_id']}">Add to cart</a>
        </div>
      </div>
    </div>
DELIMITER;

      echo $product;
    }
  else :

    echo  "<center><h1>No Features</h1></center>";
  endif;
}

function get_products_in_subcat_page()
{
  $query = query("SELECT * FROM products WHERE product_cat_id =" . escape_string($_GET['id']) . " ");
  confirm($query);
  while ($row = fetch_array($query)) {
    $product = <<<DELIMITER
    <div class="col-sm-4 col-lg-4 col-md-4">
      <div class="thumbnail">
        <a href="item.php?id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a>
        <div class="caption">
          <h4 class="pull-right">&#36;{$row['product_price']}</h4>
          <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a></h4>
          <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
          <a class="btn btn-primary" target="_blank" href="item.php?id={$row['product_id']}">Add to cart</a>
        </div>
      </div>
    </div>
DELIMITER;

    echo $product;
  }
}



function get_products_in_shop_page()
{
  $query = query("SELECT * FROM products");
  // confirm($query);
  while ($row = fetch_array($query)) {
    $product = <<<DELIMITER
    <div class="col-sm-4 col-lg-4 col-md-4">
      <div class="thumbnail">
        <a href="item.php?id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a>
        <div class="caption">
          <h4 class="pull-right">&#36;{$row['product_price']}</h4>
          <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a></h4>
          <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
         <!-- <a class="btn btn-primary" target="_parent" href="item.php?id={$row['product_id']}">Add to cart</a> -->
          <input type="button" class="btn btn-primary" value="Add to cart" onclick="addToCart({$row['product_id']},'{$row['product_title']}',{$row['product_price']})">
                                
        </div>
      </div>
    </div>
DELIMITER;

    echo $product;
  }
}


function send_message()
{
  if (isset($_POST['submit'])) {
    $adminEmail = 'p20012033@student.newinti.edu.my'; // Set the admin email here
    $from_name = $_POST['name'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $message = $_POST['message'];
    $to = $adminEmail;
    $subject = 'Contact Form'; // 
    $headers = "From: {$from_name} <{$email}>";

    $result = mail($to, $subject, $message, $headers);

    if (!$result) {
      set_message("Message could not be sent at this time");
    } else {
      set_message("Your message has been sent. We will get back to you shortly.");
    }
  }
}






function log_interaction($product_id, $interaction_type, $connection, $user_id = -1)
{
  if (isset($_SESSION['user_id'])) {
    $user_id  = $_SESSION['user_id'];
  }

  $query = $connection->prepare("INSERT INTO user_interactions (user_id, product_id, interaction_type, timestamp) VALUES (?, ?, ?, NOW())");
  $query->bind_param("iss", $user_id, $product_id, $interaction_type);
  $query->execute();

  if ($query->error) {
    die("Error: " . $query->error);
  } else {
    //  echo "Interaction logged successfully!";
  }
}
