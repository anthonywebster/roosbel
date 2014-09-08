<?php 
require_once "function.php"; 
$page_menu = true;

if (!isset($_COOKIE['user_roosbelt'])) {
    header("Location:cms.login.php?login=true");
    exit();
}

if ($_GET['delete']) {
    $id = (int)$_GET['delete'];
    delete($id);
}

if ($_POST) {
    $title = $_POST['page'];
    /*
        Este foreach recorre cada pagina que se encuentra en el formulario
    */
    foreach ($title as $key => $value) {
        /*
            Con esto condicion evaluo si el input se creo dinamicamente
        */
        if ($key == 'new') {
            foreach ($value as $subkey => $subvalue) {
                $flatten = flatten($subvalue);
                $post = [
                    'name'   => html($subvalue),
                    'inmenu' => 1,
                ];

                $db->insert('pages',$post);
                $id = $db->insert_id;
                $link = html($id."-".$flatten);
                $db->query("UPDATE pages SET link = $link WHERE id = $id");
            }
        } else {
            $flatten = flatten($value);
            $link = $key."-".$flatten;
            $post = [
                'name'   => html($value),
                'inmenu' => 1,
                'link'   => html($link),
            ];

            $db->update('pages',$post,"id=$key");
        }
    } // fin del foreach de page

    if (isset($_POST['subpage']['new'])) {
        foreach ($_POST['subpage']['new'] as $key => $value) {

            $flatten = flatten($value);
            $post = [
                'name'   => html($value),
                'inmenu' => 1,
            ];

            $db->insert('pages',$post);
            $id_sub = $db->insert_id;
            $link = html($id_sub."-".$flatten);
            $db->query("UPDATE pages SET parent_page = $key,link = $link WHERE id = $id_sub");

        }
    } elseif(!isset($_POST['subpage']['new']) && isset($_POST['subpage'])) {
        foreach ($_POST['subpage'] as $key => $value) {

            $flatten = flatten($value);
            $link = html($key."-".$flatten);
            $post = [
                'name'   => html($value),
                'inmenu' => 1,
                'link'   => $link
            ];

            $db->update('pages',$post,"id=$key");

        }
    }

    header("Location:cms.pages.php");
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
                    <h1 class="title-page">Menú</h1>

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
                        <form action="" method="post" class="normal row page">   
                            <div class="col-md-12">                                
                                <h4 class="label label-info add-page">Añadir páginas</h4>  
                            </div>
                            <?php if($menu) { foreach ($menu as $key => $value) { ?>                                
                                <div class="col-md-6">
                                    <label>Título</label>
                                    <input type="text" value="<?php echo $value['name'] ?>" name="page[<?php echo $key ?>]" class="form-control" placeholder="Título de página" data-id="<?php echo $key ?>">
                                    <i class="fa fa-plus btn btn-info"></i>
                                    <i class="fa fa-minus btn btn-danger" data-id="<?php echo $key ?>"></i>
                                    <i class="fa fa-pencil btn btn-success" data-url="cms.page.php?id=<?php echo $key ?>&menu=1"></i>
                                    <?php if($sub_menu[$key]) { foreach ($sub_menu[$key] as $subkey => $subvalue) {
                                        if ($subkey) {  ?>
                                            <div class="col-md-10">
                                                <label for="">Título</label>
                                                <input type="text" name="subpage[<?php echo $subvalue['id'] ?>]" value="<?php echo $subvalue['name'] ?>" class="form-control">
                                                <i class="fa fa-minus btn btn-danger" data-id="<?php echo $subvalue['id'] ?>"></i>
                                                <i class="fa fa-pencil btn btn-success" data-url="cms.page.php?id=<?php echo $subvalue['id'] ?>&menu=1"></i>
                                            </div>
                                        <?php }    
                                    } }?>
                                </div>                        
                            <?php } } ?>                      
                            <div class="template-page"></div>
                            <div class="col-md-12">                                
                                <input type="submit" class="btn btn-success" value="Guardar">
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div> <!-- Fin del container -->
    </body>
</html>
