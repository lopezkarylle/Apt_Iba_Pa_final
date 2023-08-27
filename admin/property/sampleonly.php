<form action="sampleonly.php" method="POST" id="property-form" enctype="multipart/form-data">
<div class="form-group row">
            <label for="images" class="control-label">Upload at least 5 images</label>
            <input type="file" class="form-control" name="images[]" id="image" multiple><br>
            <button class="btn btn-sm btn-outline-primary" id="add_titles" type="button">Add Image Titles</button>
            <div id="image_titles_container"></div>
            <div id="image_previews_container"></div>
        </div>
        <div class="form-group row">
                <div class="col-md-4">
                        <label for="" class="control-label">Locate your property</label>
                        <!-- <div id='map' style='width: 400px; height: 300px;'></div> -->
                        <input type="hidden" name="latitude" value="15.145113074763598">
                        <input type="hidden" name="longitude" value="120.5950306751359">
                </div>
		</div>
        <button class="btn btn-sm btn-outline-danger" id="submit-button" type="submit">Add</button>
	</form>
</div>
<!-- <script src="form-validate.js"></script> -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const addTitlesButton = document.getElementById("add_titles");
        const imageTitlesContainer = document.getElementById("image_titles_container");
        const imagePreviewsContainer = document.getElementById("image_previews_container");

        addTitlesButton.addEventListener("click", function() {
            const selectedImages = document.getElementById("image").files;
            imageTitlesContainer.innerHTML = ""; // Clear previous titles
            imagePreviewsContainer.innerHTML = ""; // Clear previous image previews

            for (let i = 0; i < selectedImages.length; i++) {
                const input = document.createElement("input");
                input.type = "text";
                input.name = "image_title[]";
                input.placeholder = "Insert caption for image " + (i + 1);
                input.className = "form-control mb-2"; // Add some margin between inputs
                imageTitlesContainer.appendChild(input);

                // Create an image preview
                const imagePreview = document.createElement("img");
                imagePreview.src = URL.createObjectURL(selectedImages[i]);
                imagePreview.className = "img-thumbnail";
                imagePreview.height = "50";
                imagePreview.width = "50";
                imagePreviewsContainer.appendChild(imagePreview);
            }
        });
    });
</script>

<?php
$imageData = $_FILES["images"] ?? NULL;

// Loop through the uploaded images
if(isset($imageData)){
    for ($i = 0; $i < count($imageData['name']); $i++) {
        // Get the image properties
        $imageName = $imageData['name'][$i];
        $imageTmpName = $imageData['tmp_name'][$i];
        $title = $_POST['image_title'][$i];
    
        // Move the uploaded image to a directory on the server
        $uploadDirectory = "../../resources/images/properties/";
        $targetFilePath = $uploadDirectory . basename($imageName);
        move_uploaded_file($imageTmpName, $targetFilePath);
    
        $images = new Image();
        $images->setConnection($connection);
        $insert = $images->addImage($property_id, $imageName, $title, 1);
        //var_dump($insert);
        if($insert){ 
            $statusMsg = "Images are uploaded successfully."; 
        }else{ 
            $statusMsg = "Sorry, there was an error uploading your file."; 
        } 
    }
}

?>