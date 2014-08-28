<?php  
require_once "function.php"; 
header('Content-Type: text/html; charset=utf-8');
ini_set('memory_limit', '1024M');
ini_set('upload_max_filesize', '1024M');


if ($_POST['gallery']) {
    $id = $_POST['id'];
    $infoGallery_count = 0;
    $position_image = 0;

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

    $postGallery = array(
        'status' => (int)1,
        'title' => $title,
        'title_es' => $title_es,
        'description' => $desc,
        'description_es' => $desc_es,
        'status' => (int)$_POST["status"],
    );
    if ( $infoGallery_count > 0) {
        $db->update('galleries',$postGallery,"id=$infoGallery->id");
        $id = $id;
    } else {
        $db->insert('galleries',$postGallery);
        $id = $db->insert_id;
    }
    if ($_FILES) {

        foreach ($_FILES as $key => $value) {
            $key++;
            $position = $key + $position_image; 
            $postpic = array(
                'galleries' => $id,
                'position' => $position,
            );

            $tmp= $value['tmp_name'];

            $db->insert('galpics',$postpic);
            $pic = new SimpleImage();
            $pic->load($value['tmp_name']);

            $pic->resizeTowidth(650);
            $pic->save("media/gallery/".$id.".".$position.".jpg");

            $pic->resizeTowidth(200);
            $pic->save("media/gallery/".$id.".th.".$position.".jpg");


        }
    }
    die(json_encode($id));
}

} elseif ($_POST['slide']) {

        if ($_FILES) {

            foreach ($_FILES as $key => $value) {
                $post = ['status'=>1];
                $postpic = array(
                    'galleries' => $id,
                    'position' => $position,
                );

                $tmp= $value['tmp_name'];

                $db->insert('galpics',$postpic);
                $pic = new SimpleImage();
                $pic->load($value['tmp_name']);

                $pic->resizeTowidth(650);
                $pic->save("media/gallery/slide".$id.".".$position.".jpg");

                $pic->resizeTowidth(200);
                $pic->save("media/gallery/".$id.".th.".$position.".jpg");


            }
        }
    die(json_encode($id));
}
?>