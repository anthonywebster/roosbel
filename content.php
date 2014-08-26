<?php 
require "function.php";
$id = (int)$_GET['id'];
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">        

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <?php echo $head ?>        
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div id="container">
        <div id="content">
            <?php require "include.header.php"; ?>
            
            <aside class="right">
                <?php include "include.right.php" ?>
            </aside>
            
            <div class="contentleft">
            </div>
            <?php include "include.footer.php" ?>
        </div>  
    </div>
        
    </body>
</html>
