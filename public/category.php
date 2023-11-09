<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

<div class="container">
    <header class="jumbotron hero-spacer">
        <!-- Your content -->
    </header>
    <hr>
    
    <div class="row">
        
        <?php include(TEMPLATE_FRONT . DS . "side_nav.php") ?>

        <div class="col-lg-9    ">

        <div class="">
            <h3>Latest Features</h3>
        </div>
    
    <div class="row text-center">
        <?php get_products_in_cat_page(); ?>
    </div>
    </div>
    <div class="row">
       
    
    </div>
</div>

<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
 