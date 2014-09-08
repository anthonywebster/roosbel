<?php 
require_once "function.php"; 
$pages = true;
$id = $_GET['id'];
$inmenu = $_GET['menu']==1 ? 1 : 0;

if (!isset($_COOKIE['user_roosbelt'])) {
    header("Location:cms.login.php?login=true");
    exit();
}

if ($id) {
    $info = $db->query("SELECT * FROM pages WHERE id = $id AND status = 1 LIMIT 1 ");
}

if ($_POST) {

    $title = html($_POST['title']);
    $content = mysql_clean($_POST['content']);

    $post = [
        'name' => $title,
        'content' => $content,
        'inmenu' => $inmenu,
    ];

    if ($id) {
        $flatten = flatten($title);
        $link = html($id."-".$flatten);
        $post['link'] = $link;
        $db->update('pages',$post,"id=$id");
    } else {
        $db->insert('pages',$post);
        $id = $db->insert_id;
        $flatten = flatten($title);
        $link = html($id."-".$flatten);
        $post['link'] = $link;
        $db->update('pages',$post,"id=$id");
    }

    header("Location:cms.page.php?id=$id&menu=$inmenu");
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
                    <h1 class="title-page">Páginas</h1>

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
                        <form action="" method="post" class="normal">                           
                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" name="title" class="form-control" placeholder="Ingrese el título" value="<?php echo $info->name ? $info->name : ''; ?>">
                            </div>

                            <div class="form-group">
                                <label>Contenido</label>
                                <textarea class="form-control summernote" name="content" rows="3"><?php echo $info->content ? $info->content : ''; ?></textarea>
                            </div>
                            <input type="submit" class="btn btn-success" value="Guardar">
                        </form>

                    </div>
                </div>
            </div>

        </div> <!-- Fin del container -->
    </body>
</html>
