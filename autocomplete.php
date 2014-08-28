<?php  

require "function.php";

$url =[];
$term = $_POST['term'];
$info = $db->query("SELECT link,name FROM pages WHERE status = 1 AND name LIKE '%$term%' ");

while ($row = $info->fetch()) {
	array_push($url,$row['link']);
}

die(json_encode($url));

?>
