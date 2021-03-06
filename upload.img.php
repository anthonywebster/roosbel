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
        'title' => html($_POST['title']),
    );
    if ( $infoGallery_count > 0) {
        $db->update('galleries',$postGallery,"id=$infoGallery->id");
        $id = $id;
    } else {
        $db->insert('galleries',$postGallery);
        $id = $db->insert_id;
    }
    if (!empty($_FILES['img']['tmp_name'])) {

        foreach ($_FILES['img']['tmp_name'] as $key => $value) {
            $key++;
            $position = $key + $position_image; 
            $postpic = array(
                'galleries' => $id,
                'position' => $position,
            );

            $tmp= $value;

            $db->insert('galpics',$postpic);
            $pic = new SimpleImage();
            $pic->load($value);

            $pic->resizeTowidth(650);
            $pic->save("media/gallery/".$id.".".$position.".jpg");

            $pic->resizeTowidth(200);
            $pic->save("media/gallery/thumb/".$id.".th.".$position.".jpg");


        }
    }
    $answer =['id' => $id,'type' => 'Gallery'];
    die(json_encode($answer));

} elseif ($_POST['slide']) {

        if (!empty($_FILES['img']['tmp_name'])) {

            foreach ($_FILES['img']['tmp_name'] as $key => $value) {

                $post = array(
                    'status' => 1
                );

                $db->insert('slide',$post);
                $id = $db->insert_id;
                $pic = new SimpleImage();
                $pic->load($value);

                $pic->resizeTowidth(980);
                $pic->save("media/slide/".$id.".jpg");

                $pic->resizeTowidth(200);
                $pic->save("media/slide/".$id.".th".".jpg");


            }
        }
    $status =['status'=>true,'type'=>'slide'];
    die(json_encode($status));
}
?>