<?php 
require "function.php";
$id = (int)$_GET['id'];

if ($id) {
    $info = $db->query("SELECT content,link,id,name FROM pages WHERE id = $id AND status = 1 LIMIT 1");
}

if ($id == 4) {
    $Gallery = $db->query("SELECT * FROM galleries WHERE status = 1");
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
        <title></title>
        <meta name="description" content="">        

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <?php echo $head ?>    
        <script src="js/vendor/jquery.js"></script>
        <link rel="stylesheet" href="css/lightGallery.css">
        <script src="js/vendor/lightGallery.js"></script>
        <style>
            .content-gallery li{
                float: left;
                list-style: none;
                margin: 5px;
                box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3);
                padding: 5px;
                cursor: pointer;
                height: 115px;
            }
            .content-gallery li div{max-height: 93px;overflow: hidden;}
            .arrow-return {
                display: inline-block;
                box-shadow: -1px 1px 2px rgba(0, 0, 0, 0.3);
                width: 50px;
                height: 50px;
                text-align: center;
                line-height: 30px;
                padding: 10px;
                border-radius: 50%;
                cursor: pointer;
                color: #235A20;
                font-weight: bold;
                font-size: 27px;
                position: relative;
                left: 50%;
                margin-left: -40px;
                margin-bottom: 14px;
            }   
        </style>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div id="container">
        <div id="content">
            <?php require "include.header.php"; ?>
            
            <aside class="right">
                <?php include "include.right.php" ?>
            </aside>
            
            <div class="contentleft">
                <?php echo $info->content ?>
                <?php if ($id == 4) { ?>
                    <div class="content-gallery">

                        <div class="arrow-return">
                            &#8592;
                        </div>

                        <ul class="clearfix content-list-gallery">
                            
                        <?php if ($Gallery->num_rows) {
                            while ($row = $Gallery->fetch()) { ?>
                                <li data-id="<?php echo $row['id'] ?>">
                                    <div>
                                        <img src="media/gallery/thumb/<?php echo $row['id'].".th.".searchImg($row['id']) ?>.jpg" alt="">
                                    </div>
                                </li>
                            <?php }
                        } ?>
                        </ul>

                        <div class="return-img"></div>
                    </div>
                <?php } ?>
            </div>
            <?php include "include.footer.php" ?>
        </div>  
    </div>
        
    </body>
    <?php if ($id==4) { ?>
    <script type="text/javascript">
    $('.arrow-return').hide();
    function sendAjax (argument) {
        var id = $(this).data('id');
        $.ajax({
            url: 'return.img.php',
            cache:true,
            type: 'get',
            data: {id:id},
            beforeSend:function(xhr,set){
                $('.content-list-gallery').fadeOut(200);
                $('.arrow-return').fadeIn(200);
            },
            success: function (data) {
                $('.return-img').hide().html(data).fadeIn(200);
                $('#lightGallery').lightGallery({
                    mode:"fade"
                });
            }
        });
    }

    $('.arrow-return').on('click',function(){
        $('.content-list-gallery').fadeIn(200);
        $('#lightGallery').fadeOut(200,function(){
            $(this).remove();
        })
        $(this).fadeOut(200);
    });

    $('.content-list-gallery li').on('click',sendAjax);
</script>
    <?php } ?>
</html>
