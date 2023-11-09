<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>


<?php

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $fullName = $_POST['full_name'];
    $address = $_POST['address'];

    // Assuming $connection is your database connection
    $query = $connection->prepare("INSERT INTO users (username, password, email, full_name, address) VALUES (?, ?, ?, ?, ?)");
    $query->bind_param("sssss", $username, $password, $email, $fullName, $address);
    $query->execute();

    if ($query->error) {
        echo "Error: " . $query->error;
    } else {
        header('Location: login.php');
        exit;
    }

    $query->close();
} else {
    set_message("Registration failed. Please try again.");
}

?>

<!-- Your form and HTML code -->






<div class="container">
    <header>
        <h1 class="text-center">Registration</h1>
        <h2><?php display_message(); ?></h2>
        <div class="col-sm-4 col-sm-offset-4">
            <form class="" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" name="full_name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="full_name">Address</label>
                    <input type="text" name="address" class="form-control">
                </div>
                <!-- Add more fields like Date of Birth, Address, etc. as needed -->

                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary">
                    <br>
                    <!-- Link to redirect to login if already registered -->
                    <a href="Register.php">Already have an account? Login</a>
                </div>
            </form>
        </div>
    </header>
</div>

<div class="container">
    <hr>
    <!-- Footer -->
    <?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>
</div>

























































































