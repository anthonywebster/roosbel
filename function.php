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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/vendor/modernizr-2.6.2.min.js"></script>
<script src="js/vendor/jquery.bxslider.js"></script>
';

$head_cms = '
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/cms.index.css">
         <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.min.css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/blackboard.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.min.css">
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.min.js"></script>
        <link rel="stylesheet" href="css/summernote.css">
        <script src="js/vendor/summernote.min.js"></script>
'
?>