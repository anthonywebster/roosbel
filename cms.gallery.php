<?php 
require_once "function.php"; 
$gallery_true = true;
$id = (int)$_GET['id'];

if (!isset($_COOKIE['user_roosbelt'])) {
    header("Location:cms.login.php?login=true");
    exit();
}

$infoGallery_count = 0;
$position_image = 0;

if ($_GET['pos']) {
    $position = (int)$_GET['pos'];
    $idimg = (int)$_GET['idimg'];
    $id = (int)$_GET['id'];
    @unlink("media/gallery/$id.th.$position.jpg");
    @unlink("media/gallery/$id.$position.jpg");
    $db->query("DELETE FROM galpics WHERE id = $idimg");
    header("location:cms.gallery.php?id=$id#last");
    die();
}

if ($_GET['degallery']) {
    $id = (int)$_GET['degallery'];
    $db->query("UPDATE galleries SET status = 0 WHERE id = $id");
    header("Location:cms.gallery.php#list");
    exit();
}

if ($id) {    
    $infoGallery = $db->query("SELECT * FROM galleries WHERE id= $id  LIMIT 1");
    if ($infoGallery->num_rows > 0) {
        $infoGallery_count = $infoGallery->num_rows;
        $pics = $db->query("SELECT * FROM galpics WHERE galleries = $infoGallery->id ORDER BY position");
        $images = $db->query("SELECT position FROM galpics WHERE galleries = $infoGallery->id ORDER BY id DESC LIMIT 1");
        if ($images->num_rows > 0) {
            $position_image = $images->position;
        }
    }
} 

$list_gallery = $db->query("SELECT * FROM galleries WHERE status = 1  ORDER BY id DESC");

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
            a.enlace{color:#5ac;}
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
                    
                    <div class="content-tab">
                        <div class="list-tab">
                            <span class="tab last" data-namehash="last"><?php echo isset($_GET['id']) ? 'Gallery' : 'New Gallery' ?></span>
                            <span class="tab list" data-namehash="list">List</span>
                        </div>
                        <!-- ********************** --> 
                        <div class="redactor target" id="last">
                                <div>
                                    <label for="">Título de Galería</label>
                                    <input type="text" class="form-control" id="title" required value="<?php echo $infoGallery->title ? $infoGallery->title :'' ?>">
                                </div>
                                <div class="form-group">
                                     <ul class="clearfix content-img">
                                        <?php if ($pics->num_rows) { ?>
                                             <?php while ($row = $pics->fetch()) { $imgurl = "media/gallery/thumb/$id.th.{$row['position']}.jpg" ; ?>
                                                <?php if (file_exists($imgurl)) { ?>
                                                    <li>
                                                        <a href="cms.gallery.php?pos=<?php echo $row['position'] ?>&idimg=<?php echo $row['id'] ?>&id=<?php echo $id ?>"><span class="x">X</span></a>
                                                        <div class="img-limit">
                                                            <img src="<?php echo $imgurl ?>" alt="">
                                                        </div>
                                                    </li>
                                               <?php } ?>
                                             <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <form action="" method="post" class="normal upload_gallery">               

                                <input type="file" name="images[]" id="img" class="input-file" multiple />

                                 <div id="holder" class="save-pic">
                                    <ul id="containerthumb" class="thumbs">
                                        
                                    </ul>
                                </div>
                                <div class="progreso"><div class="barra"></div><div class="porcentaje"></div></div>
                                    <input type="hidden" name="id" value="<?php echo $id ?>" id="id">

                                <input type="submit" class="btn btn-success" value="Guardar">
                            </form>

                        </div>

                        <div id="list" class="target">
                            <h5>List</h5>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ( $row=$list_gallery->fetch()) { ?>
                                        <tr>
                                            <td><?php echo $row['title'] ?></td>
                                            <td><?php echo $row['status'] == 1 ? "Active" : "Inactive" ?></td>
                                            <td><a href="cms.gallery.php?id=<?php echo $row['id'] ?>#last" class="enlace"><i class="fa fa-pencil"></i> Edit</a> <a href=""></td>
                                            <td><a href="cms.gallery.php?degallery=<?php echo $row['id'] ?>#list" class="enlace"><i class="fa fa-times"></i> Eliminar</a> <a href=""></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- -->
                    </div>
                </div>
            </div>

        </div> <!-- Fin del container -->
    </body>
</html>
