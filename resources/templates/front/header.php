<?php require_once("../resources/functions.php");?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Your existing meta tags, title, and CSS links -->

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <?php include(TEMPLATE_FRONT . DS . "top_nav.php") ?>

        <!-- Display username and logout button if logged in -->
        <div class="container">
            <?php
            if (isset($_SESSION['username'])) {
                echo '<p class="navbar-text navbar-right">Logged in as: ' . $_SESSION['username'] . '</p>';
                echo '<form class="navbar-form navbar-right" action="logout.php" method="post">';
                echo '<button type="submit" class="btn btn-primary">Logout</button>';
                echo '</form>';
            }
            ?>
        </div>
        <!-- /.container -->
    </nav>

    <!-- The rest of your HTML content -->
</body>

</html>
