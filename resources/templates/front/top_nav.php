

<div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">HOME</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li>
                <a href="shop.php">SHOP</a>
            </li>
            <?php
                if (!isset($_SESSION["loggedin"]))  :  //&& $_SESSION["loggedin"] === false)  : ?>
            <li>
                
                    <a href="login.php">Login</a>
                <?php /*} else {
                    echo '<a href="login.php">Login</a>';
                }*/?>
                
            </li>
            <?php endif; ?>
            <li>
                <a href="checkout.php">Checkout</a>
            </li>
            <li>
                <a href="contact.php">Contact</a>
            </li>
            <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] === true) : ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="admin">Admin Panel</a></li>
                    <?php
                    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                        echo '<li><a href="logout.php">Logout</a></li>';
                    }
                    ?>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</div>
