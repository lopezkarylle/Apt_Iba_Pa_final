<?php
use Models\Image;
include "../../init.php";

$property_id = $_GET['property_id'];
?>

<!-- View and Edit Images -->
<div name="property_images" class="container-fluid" id="property_images">
<h2>Images</h2>
		<div class="row form-group">
            <div class="col-md-4">
			<form action="delete-image.php" method="POST">
			<?php
				$images = new Image();
				$images->setConnection($connection);
				$getImages = $images->getImages($property_id);
				foreach($getImages as $img){
			?>
				<img src="../../resources/images/properties/<?= $img['image_path']?>" height="200" width="200" alt="property photo">
				<input type="hidden" name="image_id" value="<?= $img['image_id']?>">
				<input type="hidden" name="property_id" value="<?php echo isset($property_id) ? $property_id : '' ?>">
				<input type="hidden" name="image_path" value="../../resources/images/properties/<?= $img['image_path']?>">
				<input type="submit" name="delete_image" value="Delete">
				
				<?php }?>
				</form>

				<form action="upload.php" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="property_id" value="<?php echo isset($property_id) ? $property_id : '' ?>">
				<input type="file" class="form-control" name="images[]" multiple><br>
			</div>
		</div>
        <button class="btn btn-sm btn-outline-danger" name="add_image" id="add_image" type="submit">Upload Images</button>
	</form>
    <a class="btn btn-sm btn-outline-primary" type="button" href="view.php?property_id=<?php echo $property_id?>">Save & Exit</a>
</div>