<?php 
require_once "function.php"; 

$info = $db->query("SELECT name,id,parent_page FROM pages ORDER BY id");

while ($row = $info->fetch()) {
    if ($row['parent_page']==null) {
        $menu[$row['id']] = ['id'=>$row['id']];
        $name[$row['id']] = ['name'=>$row['name']];
    } else {
        $sub_menu[$row['parent_page']][$row['id']] = ['name'=>$row['name'],'id'=>$row['id']];
    }
}

var_dump($sub_menu);

if ($_POST) {
    $title = $_POST['page'];
    /*
        Este foreach recorre cada pagina que se encuentra en el formulario
    */
    foreach ($title as $key => $value) {
        $flatten = flatten($value);
        /*
            Con esto condicion evaluo si el input se creo dinamicamente
        */
        if ($key == 'new') {
            $post = [
                'name'   => html($value),
                'inmenu' => 1,
            ];

            $db->insert('pages',$post);
            $id = $db->insert_id;
            $link = html($id."-".$flatten);
            $db->query("UPDATE pages SET link = $link WHERE id = $id");
        } else {
            $link = $key."-".$flatten;
            $post = [
                'name'   => html($value),
                'inmenu' => 1,
                'link'   => html($link),
            ];

            $db->update('pages',$post,"id=$key");
            if ($_POST['subpage'][$key]) {
                foreach ($_POST['subpage'] as $subkey => $subvalue) {
                    //Esta condicion es para que solo entre una vez por cada sub-pagina
                    //ya que esta dentro de otro foreac
                    if ($subkey==$key) {
                        $flatten = flatten($value);
                        $post = [
                            'name'   => html($subvalue),
                            'inmenu' => 1,
                        ];

                        $db->insert('pages',$post);
                        $id_sub = $db->insert_id;
                        $link = html($id_sub."-".$flatten);
                        $db->query("UPDATE pages SET parent_page = $subkey,link = $link WHERE id = $id_sub");
                    }
                }
            }

        }
    }

    //header("Location:cms.pages.php");
    //exit();
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
                            <?php foreach ($menu as $key => $value) { ?>                                
                                <div class="col-md-6">
                                    <label>Título</label>
                                    <input type="text" value="<?php echo $name[$key]['name'] ?>" name="page[<?php echo $key ?>]" class="form-control" placeholder="Título de página" data-id="<?php echo $key ?>">
                                    <i class="fa fa-plus btn btn-info"></i>
                                    <i class="fa fa-minus btn btn-danger"></i>
                                    <?php foreach ($sub_menu[$key] as $subkey => $subvalue) {
                                        var_dump($subvalue);
                                        if ($subkey) {  ?>
                                            <div class="col-md-10">
                                                <label for="">Título</label>
                                                <input type="text" name="subpage[]" value="<?php echo $subvalue['name'] ?>" class="form-control">
                                            </div>
                                        <?php }    
                                    } ?>
                                </div>                        
                            <?php } ?>                      
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
    <script src="js/function.js"></script>
</html>
