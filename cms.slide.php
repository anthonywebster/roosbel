<?php 
require_once "function.php"; 
$slide = true;
$id = $_GET['id'];
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo SITENAME; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <?php echo $head.$head_cms; ?>
        <style>
            
        </style>
    </head>
    <body class="">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div class="container-cms">
            <?php include "include.cms.header.php" ?>
            <div class="content-content">
                <?php include "include.cms.menu.left.php" ?>

                <div class="content-cms">
                    <h1 class="title-page">Dashboard</h1>

                    <div class="clearfix content-infographic">
                        <div class="infographic-box">
                            <div class="">
                                <i class="fa fa-user red-bg"></i>
                                <span class="headline">Users</span>
                                <span class="value">4</span>
                            </div>
                        </div>
                        <div class="infographic-box">
                            <div class=" ">
                                <i class="fa fa-photo blue-bg"></i>
                                <span class="headline">Galleries</span>
                                <span class="value">50</span>
                            </div>
                        </div>
                        <div class="infographic-box">
                            <div class="">
                                <i class="fa fa-file-text-o green-bg"></i>
                                <span class="headline">Articles</span>
                                <span class="value">120</span>
                            </div>
                        </div>
                    </div>

                    <div class="redactor">
                        <form action="" method="post" class="normal upload">                           
                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" id="title" name="title" class="form-control" placeholder="Ingrese el título" >
                            </div>

                            <div class="form-group">
                                <ul class="clearfix content-img">
                                    <?php if ($pics->num_rows) { ?>
                                         <?php while ($row = $pics->fetch()) { $imgurl = "media/gallery/$id.th.{$row['position']}.jpg" ; ?>
                                            <?php if (file_exists($imgurl)) { ?>
                                                <li>
                                                    <a href="cms.slide.php?pos=<?php echo $row['position'] ?>&idimg=<?php echo $row['id'] ?>&id=<?php echo $id ?>"><span class="x">X</span></a>
                                                    <div class="img-limit">
                                                        <img src="<?php echo $imgurl ?>" alt="">
                                                    </div>
                                                </li>
                                           <?php } ?>
                                         <?php } ?>
                                    <?php } ?>
                                </ul>
                            </div>

                            <input type="file" name="images[]" id="img" class="input-file" multiple />

                             <div id="holder" class="save-pic">
                                <ul id="containerthumb" class="thumbs">
                                    
                                </ul>
                            </div>
                            <div class="progreso"><div class="barra"></div><div class="porcentaje"></div></div>
                                <input type="hidden" name="id" value="<?php echo $id ?>">

                            <input type="submit" class="btn btn-success" value="Guardar">
                        </form>

                    </div>
                </div>
            </div>

        </div> <!-- Fin del container -->
    </body>
    <script src="js/function.js"></script>
    <script>
        
        $('input[type="file"]').on('change',saveFiles);

        $('.upload').on('submit',function(){
            /*
            Este objeto contine los datos que se va a enviar en el post
            input = son los nombre de los inputs y a dicho inputs se le debe de poner un id con el mismo nombre,config es para otro parametros que necesitas en el php
            */
            var object = {
                //inputs :['title'],
                config:{
                    slide:true,
                }
            }
            uploadFiles(object);
        }); 
    </script>
</html>
