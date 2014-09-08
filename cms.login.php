<?php 
require_once "function.php"; 
if ($_POST['register']) {

    $data = [
        'fullname' => html($_POST['name']),
        'mail' => html($_POST['email']),
        'status' => 0,
    ];

    $db->insert('users',$data);
    $id = $db->insert_id;
    $password = html(encrypt($id.$_POST['pass']));
    $db->query("UPDATE users SET password = $password WHERE id = $id");
    header("Location:cms.login.php?register=true");
    exit();
}

if ($_POST['login']) {
    $email = $_POST['email'];
    $password = $_POST['pass'];
    if (loginValidate($email,$password)) {
        header("Location:cms.page.php?login=true");
        exit();
    } else {
        header("Location:cms.login.php?login=true");
        exit();
    }
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
            .content-content{background: url(img/bg_login2.jpg);position: fixed;width: 100%;}
            h1{
                color: #fff; text-align: center;text-transform: uppercase;font-weight: bold;
                text-shadow:0 2px 2px rgba(0, 0, 0, 0.75);
            }
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
               <div class="row">
                   <div class="col-md-5 intro">
                       <h1>Bienvenido al login</h1>
                   </div>
                   <div class="col-md-7">
                       <h1>form</h1>
                        <?php if (isset($_GET['login'])) { ?>
                             <div class="form form_login">
                                <div class="content-form form_login">
                                    <form action="" method="post" class="form-register">
                                        <input type="email" name="email" class="email_origen" placeholder="Email">
                                        <input type="password" name="pass" class="pass_origen" placeholder="password">                                
                                        <input type="hidden" name="login" value="yes">
                                        <button type="submit" class="next btn btn-success" >Enviar</button>
                                    </form>
                                </div>
                            </div>
                        <?php } elseif(isset($_GET['register'])) { ?>

                           <div class="form">
                                <div class="content-form">
                                    <form action="" method="post" class="form-register">
                                        <input type="text" placeholder="Name" value="" name="name" class="name">
                                        <input type="email" name="email" class="email_origen" placeholder="Email">
                                        <input type="email" class="email_eval" placeholder="Repeat Email">
                                        <input type="password" name="pass" class="pass_origen" placeholder="password">
                                        <input type="password" class="pass_eval" placeholder="Repeat your password">
                                        <input type="hidden" name="register" value="yes">
                                        <button type="submit" class="next btn btn-success" >Enviar</button>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>                 

                   </div>
               </div>
            </div>

        </div> <!-- Fin del container -->
    </body>
</html>
