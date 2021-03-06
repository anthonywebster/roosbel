<?php 
require "function.php";
$index = true;
$slide = $db->query("SELECT * FROM slide WHERE status = 1");
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
        <script src="js/vendor/jquery.js"></script>
        <script src="js/vendor/bxslider.js"></script>
        <script>
           $(function(){
                 $('.bxslider').bxSlider({
                  mode: 'fade',
                  captions: true
                });
           })
        </script>
        <style>
            .bxslider li{left: 0;}
            .bx-viewport{top: 44px;}
            .bx-wrapper{height: 425px;overflow: hidden;margin: 0 auto 0px;width: 100%;}
            .bx-wrapper .bx-pager{bottom: 0;top: 0;}
            .slider{margin-top: 10px;}
            .bx-wrapper .bx-pager{text-align: left;}
            .bx-wrapper .bx-pager.bx-default-pager a.active {
                background: #FFF;
                box-shadow: 0 0 4px 1px #15398F;
            }
            .bx-wrapper .bx-pager.bx-default-pager a{border-radius: 0;width: 13px;height: 13px;background: #15398F;}
        </style>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div id="container">
        <div id="content">
            <?php require "include.header.php"; ?>

            <div id="slider" class="">
                <ul class="clearfix bxslider">
                    <?php if ($slide->num_rows) {
                        while ($row = $slide->fetch()) {
                            if ($row['link']) { ?>
                                <li><a href="<?php echo $row['link'] ?>"><img src="media/slide/<?php echo $row['id'] ?>.jpg" alt=""></a></li>
                            <?php } else { ?>
                                <li><img src="media/slide/<?php echo $row['id'] ?>.jpg" alt=""></li>
                            <?php }
                        }
                    } ?>
                </ul>
            </div>
            
            <aside class="right">
                <?php include "include.right.php" ?>
            </aside>
            
            <div class="contentleft">
                <span class="left">12</span>
                <h2>LOREM AND IPSUM IS SYMPLY A DUMMY TEXT OF PRINTING.</h2>
                <img src="img/foto.jpg" alt="" class="left"/>
                <h4>On 02.05.09, In Tutorials by TemplateAccess</h4>
                <p><strong>Suspendisse commodo nisl vitae tortor egestas id ornare quam ullamcorper</strong>. Aliquam laoreet orci iaculis magna consectetur imperdiet. Fusce luctus lectus sed mi hendrerit vel tincidunt nulla interdum. Suspendisse molestie augue eget nisi molestie venenatis. Cras vitae condimentum nisl. Etiam odio lorem, aliquam eu suscipit a, posuere convallis sapien. Aliquam a[...]</p>
                <a href="">Read more &raquo;</a>
            </div>
            <?php include "include.footer.php" ?>
        </div>  
    </div>
    </body>
</html>
