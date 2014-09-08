<?php 
	require "function.php";
	$id = (int)$_GET['id'];
	$files = glob("media/gallery/thumb/".$id.'*.{jpg}',GLOB_BRACE);
?>

<ul id="lightGallery">
	<?php foreach ($files as $key => $value) { $array = explode(".", $value); $position = $array[2]; ?>
		
		<li data-src="media/gallery/<?php echo $id.".".$position.".jpg" ?>"><img src="<?php echo $value ?>" alt=""></li>
	<?php } ?>
</ul>