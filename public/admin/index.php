<?php  require_once("../../resources/config.php");
require_once("../../resources/functions.php");
require_once('../../resources/lib/phpChart/conf.php');

?>
<?php include(TEMPLATE_BACK . "/header.php"); ?>

    <div id="page-wrapper">

    <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Statistics Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <?php 
                
                if ($_SERVER['REQUEST_URI'] == "/ecom/public/admin/" || $_SERVER['REQUEST_URI'] == "/ecom/public/admin/index.php") {
                    include(TEMPLATE_BACK . "/admin_contant.php"); 
                 }
                
                if(isset($_GET['orders'])){
                    include(TEMPLATE_BACK . "/orders.php");
                }
                elseif(isset($_GET['order'])) {

                    include(TEMPLATE_BACK . "/order.php");
                }


                elseif(isset($_GET['categories'])) {

                    include(TEMPLATE_BACK . "/categories.php");
                }
                

                elseif(isset($_GET['products'])) {

                    include(TEMPLATE_BACK . "/products.php");
                }

                elseif(isset($_GET['add_product'])) {

                    include(TEMPLATE_BACK . "/add_product.php");
                }
                elseif(isset($_GET['users'])) {

                    include(TEMPLATE_BACK . "/users.php");
                }
                elseif(isset($_GET['sales'])) {

                    include(TEMPLATE_BACK . "/charts.php");
                }
                elseif(isset($_GET['liked'])) {

                    include(TEMPLATE_BACK . "/charts.php");
                }
                else{
                    include(TEMPLATE_BACK."/index.php");
                }

               













                
                ?>
    </div>
    </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
   
    <!-- /#wrapper -->
 <?php include(TEMPLATE_BACK . "/footer.php"); ?>


 