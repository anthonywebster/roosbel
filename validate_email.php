<?php  

require "function.php";

$data = [];
$email = html($_POST['email']);
$info = $db->query("SELECT mail FROM users WHERE mail = $email ");
$data['status'] = $info->num_rows ? 'exist' : 'empty';


die(json_encode($data));

?>
