<?php 
require_once "function.php"; 
$slide = true;
$id = $_GET['id'];
$pics = $db->query("SELECT * FROM slide WHERE status = 1");

if ($_POST['update']) {

    $id  = $_POST['id_img'];
    $url = html($_POST['link']);
    $post = ['link' => $url];
    $db->update('slide',$post,"id=$id");
    if (!empty($_FILES['img']['tmp_name'])) {
        $pic = new SimpleImage();
        $pic->load($_FILES['img']['tmp_name']);

        $pic->resizeTowidth(980);
        $pic->save("media/slide/".$id.".jpg");

        $pic->resizeTowidth(200);
        $pic->save("media/slide/".$id.".th".".jpg");
    }
    header("location:cms.slide.php");
    exit();
}

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
            ul{
                list-style:none;
            }
            .content-img li{
                width: 223px;
                height: 210px;
                margin: 11px;
            }
            .content-img li img{padding-bottom:3px;}
            .content-img li input[type="file"]{width: 100%;margin:5px 0px 7px 0px;}
            .content-img .img-limit{margin-bottom:5px;}
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
                            <div class="form-group">
                                <ul class="clearfix content-img">
                                    <?php if ($pics->num_rows) { ?>
                                         <?php while ($row = $pics->fetch()) { $imgurl = "media/slide/{$row['id']}.th.jpg" ; ?>
                                            <?php if (file_exists($imgurl)) { ?>
                                                <li>
                                                    <form action="" method="post" enctype="multipart/form-data">
                                                        <a href="cms.slide.php?idimg=<?php echo $row['id'] ?>"><span class="x">X</span></a>
                                                        <div class="img-limit">
                                                            <img src="<?php echo $imgurl ?>" alt="">
                                                        </div>
                                                        <input type="text" class="form-control auto" name="link" placeholder="url" value="<?php echo $row['link'] ?>">
                                                        <input type="file" name="img">
                                                        <input type="hidden" name="id_img" value="<?php echo $row['id'] ?>">
                                                        <input type="submit" value="Update" class="btn btn-success" name="update">
                                                    </form>
                                                </li>
                                           <?php } ?>
                                         <?php } ?>
                                    <?php } ?>
                                </ul>
                            </div>
                        <form action="" method="post" class="normal upload">               

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
</html>
