<?php 
require "function.php";
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
            <header>
                <nav id="pagemenu">
                    <ul>
                    <li class="first"><a href="">HOME</a></li>
                    <li><a href="">ABOUT US</a></li>
                    <li><a href="">ARCHIVES</a></li>
                    <li><a href="">CONTACT US</a></li>
                    </ul>
                </nav>
                
                <h1></h1>
            </header>

            <div id="slider" class="">
                <ul class="clearfix bxslider">
                    <li><img src="img/1.jpg" alt=""></li>
                    <li><img src="img/7.jpg" alt=""></li>
                    <li><img src="img/37.jpg" alt=""></li>
                    <li><img src="img/38.jpg" alt=""></li>
                    <li><img src="img/39.jpg" alt=""></li>
                </ul>
            </div>
            
            <aside class="right">
                <h3>Search</h3>
                <form action="" method="post">
                <p><input type="search" name="search" id="search" placeholder="Search..."/></p>
                </form> 
                
                <h3>Programa de ingles comunicativo</h3>
                <div id="tabs">
                    <div id="fragment-1">
                        <ul class="vertical-menu">
                        <li><span class="vinetas"></span><a href="">About us</a></li>
                        <li><span class="vinetas"></span><a href="">Categories</a></li>
                        <li><span class="vinetas"></span><a href="">Demo Pages</a></li>
                        <li><span class="vinetas"></span><a href="">Documentation</a></li>
                        <li><span class="vinetas"></span><a href="">Elements</a></li>
                        <li><span class="vinetas"></span><a href="">Feeds</a></li>
                        <li><span class="vinetas"></span><a href="">Popular Post</a></li>
                        </ul>
                    </div>
                </div>
            </aside>
            
            <div class="contentleft">
                <span class="left">12</span>
                <h2>LOREM AND IPSUM IS SYMPLY A DUMMY TEXT OF PRINTING.</h2>
                <img src="img/foto.jpg" alt="" class="left"/>
                <h4>On 02.05.09, In Tutorials by TemplateAccess</h4>
                <p><strong>Suspendisse commodo nisl vitae tortor egestas id ornare quam ullamcorper</strong>. Aliquam laoreet orci iaculis magna consectetur imperdiet. Fusce luctus lectus sed mi hendrerit vel tincidunt nulla interdum. Suspendisse molestie augue eget nisi molestie venenatis. Cras vitae condimentum nisl. Etiam odio lorem, aliquam eu suscipit a, posuere convallis sapien. Aliquam a[...]</p>
                <a href="">Read more &raquo;</a>
            </div>
            <footer>
                <small>&copy; Company Name. All Rights Reserved</small>
            </footer>
        </div>  
    </div>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
