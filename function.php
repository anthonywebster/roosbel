<?php
/**
 * IBIS CMS Core Functionality
 *
 * Definitions of constants, variables and includes of files
 *
 * PHP 5
 *
 * @copyright     IBIS Servicios (http://ibisservicios.com)
 * @link          http://ibisservicios.com
 * @version       1.0
 */

date_default_timezone_set("America/Managua");
/*cambio*/

define ("ENCODING", "UTF-8");
define ("LANGUAGE", $_GET['lang'] ? $_GET['lang'] : "en");
define ("SALT", "kk10A,Jw");

if (file_exists("/sites/local")) {
  define ("BASEDIR", "http://e/roosbel/");
  define ("CONNECTION", "/sites/roosbel/conn/local.roosbel.php");
  define ("URL", "http://e/roosbel/");
  define ("LOCAL", true); 
} else {
  define ("BASEDIR", "http://residenciallarosaleda.com/");
  define ("CONNECTION", "/home/rosaleda/conn/online.rosaleda.php");
  define ("URL", "http://residenciallarosaleda.com/");
  define ("LOCAL", false); 
}

define ("SITENAME", "Roosbel");
define ("TAGS", "<p><strong><a><ul><li><b><em><ol><table><tr><th><td><img><h1><h2><h3><h4><h5><h6><div><iframe><b><i><hr><pre><br><span><b>");
define ("EMAIL", "info@ibisservices.com");
define ("AUTOMAIL", "automail@ibisservices.com");
require_once('global.functions.php');

$db = new DB;
$css_version = filesize("css/styles.css");
$lang = mysql_clean(LANGUAGE);

$head = '
<meta charset="utf-8" />
<base href="' . URL . '" />
<link rel="shortcut icon" href="img/favicon.ico" />
<link rel="apple-touch-icon" href="apple-touch-icon.png" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/jquery.bxslider.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<script src="js/vendor/modernizr-2.6.2.min.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet" href="css/jquery-ui.theme.css">
<link rel="stylesheet" href="css/jquery-ui.structure.css">
';

$head_cms = '
<link rel="stylesheet" href="css/cms.index.css">
<link rel="stylesheet" href="css/summernote.css">
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/blackboard.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.min.css">
<script src="js/vendor/require.js" data-main="js/main"></script>
';


$menu_principal = $db->query("SELECT SQL_CACHE name,id,parent_page,link FROM pages WHERE status = 1 AND inmenu = 1 ORDER BY id");

while ($row = $menu_principal->fetch()) {
    if ($row['parent_page']==null) {
        $menu[$row['id']] = ['id'=>$row['id'],'link' => $row['link'],"name" => $row['name']];
    } else {
        $sub_menu[$row['parent_page']][$row['id']] = ['name'=>$row['name'],'id'=>$row['id'],"link" => $row['link']];
    }
}

function delete($id) {
    global $db;
    $db->query("UPDATE pages SET status = 0 WHERE id = $id");
    return die('true');
}

function loginValidate($email,$pass)
{
    global $db;
    $email = html($email);

    $user = $db->query("SELECT * FROM users WHERE mail = $email AND status = 1");

    if (!$user->num_rows) {
        return false;
    }

    $check = encrypt($user->id.$pass);
    if ($check == $user->password) {
        $db->query("UPDATE users SET last_login = NOW() WHERE id = {$user->id}");
        $data = encrypt($password.$user->id).$user->id;
        setcookie("user_roosbelt",$data,time()+60*60*24,"/");
        return true;
    } else {
        return false;
    }
}

function searchImg($id) {
    global $db;
    $info = $db->query("SELECT position FROM galpics WHERE galleries = $id AND status = 1 LIMIT 1");
    if ($info->num_rows) {
        return $info->position;
    }
    return false;
}

?>