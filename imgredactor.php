<?php
$dir = 'media/redactor/';
 
$_FILES['file']['type'] = strtolower($_FILES['file']['type']);
 
if ($_FILES['file']['type'] == 'image/png' 
|| $_FILES['file']['type'] == 'image/jpg' 
|| $_FILES['file']['type'] == 'image/gif' 
|| $_FILES['file']['type'] == 'image/jpeg'
|| $_FILES['file']['type'] == 'image/pjpeg')
{   
    // setting file's mysterious name
    $filename = md5(date('YmdHis')).'.jpg';
    $file = $filename;

    // copying
    if (is_writable($dir)) {
        setOrientationImage($_FILES['file']['tmp_name']);
        move_uploaded_file($_FILES['file']['tmp_name'], $dir."/".$filename);
        $img = true;
    } else {
        $img = false;
    }

    // displaying file    
    $array = array(
        'filelink' => 'media/redactor'.$filename,
        'upload' => $img,
    );
    
    echo $array['filelink'];   
    
}
 
?>
