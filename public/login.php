<?php
require_once("../resources/config.php");
include(TEMPLATE_FRONT . DS . "header.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Database query failed.");
    }

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $stored_password = $user['password'];
      
        if (password_verify($password, $stored_password)) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['loggedin'] = true;
            if ($user['is_admin'] == 1){
                $_SESSION['isAdmin'] = true;
            }else{
                $_SESSION['isAdmin'] = false;
           
            }
            
            header('Location: index.php');
            exit;
        } else {
            set_message("Invalid password. Please try again.");
        }
    } else {
        set_message("User not found. Please register.");
    }
}
?>

<div class="container">
    <header>
        <h1 class="text-center">Login</h1>
        <h2><?php display_message(); ?></h2>
        <div class="col-sm-4 col-sm-offset-4">
            <form class="" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary">
                    <br>
                    <a href="register.php">If you don't have an account, register</a>
                </div>
            </form>
        </div>
    </header>
</div>

<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
