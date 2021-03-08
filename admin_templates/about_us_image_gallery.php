<?php
//New photo submission
if (isset($_POST["aboutUsPhotoNewSubmit"])) {
  //Form data
  $photo = $_FILES['photo'];

  //Figure out what to call the file
  $imageFileType = strtolower(pathinfo($photo["name"], PATHINFO_EXTENSION));
  $target_dir = "images/about_us_gallery/";
  $target_file = $target_dir . basename($photo["name"]);
  
  //Create a new "photo"
  $aboutUsPhotoArray = array(
    "path" => $target_file
  );

  //Save the photo, add it to the JSON file, 
  //and let the user know.
  savePhoto($photo, $target_file);
  AddNewRowJSON($aboutUsPhotoArray, "aboutUsImageGallery.json");
  echoToAlert("Photo added successfully");
}

//Replace existing photo
if (isset($_POST["aboutUsPhotoSubmit"])) {
  //Read the form data
  $photo = $_FILES['photo'];
  $rowToUpdate = intVal($_POST['row_num']);

  //Figure out what to call the file
  $imageFileType = strtolower(pathinfo($photo["name"], PATHINFO_EXTENSION));
  $target_dir = "images/about_us_gallery/";
  $target_file = $target_dir . basename($photo["name"]);
  
  //Create a new "photo"
  $aboutUsPhotoArray = array(
    "path" => $target_file
  );

  //Save the picture, update the JSON file, and let the user know. 
  savePhoto($photo, $target_file);
  updateRowJSON($rowToUpdate, $aboutUsPhotoArray, "aboutUsImageGallery.json");
  echoToAlert("Photo updated successfully");
}

//Delete a photo
//NOTE: THIS DELETES BY INDEX. DUPLICATED REQUESTS
//MAY RESULT IN UNINTENDED DELETIONS
if (isset($_POST['aboutUsPhotoDeleteSubmit'])) {
  //Get the row number of the officer being modified
  $rowToDelete = intVal($_POST['row_num']);
  
  //Delete that row
  deleteRowJSON($rowToDelete, "aboutUsImageGallery.json");
  echoToAlert("Photo deleted successfully");
}

//Move a photo
if (isset($_POST['aboutUsPhotoCardsReorderSubmit'])) {
  //Get form data
  $old_index = intVal($_POST['old_index']);
  $new_index = $_POST['new_index'];
  
  //Reorder it
  reorderArrayJSON("aboutUsImageGallery.json", $old_index, $new_index);
}

?>
<section id="aboutUsPhotos">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h2>About Us Images</h2>
        <b>Equally sized, landscape photos recommended, but not required.</b>
        <div id="aboutUsPhotoCards" class=row>
          <?php
          $aboutUsPhotoArray = readArrayFromJSON("aboutUsImageGallery.json");
          for ($aboutUsPhoto = 0; $aboutUsPhoto <= sizeof($aboutUsPhotoArray) - 1; $aboutUsPhoto++) {
            $currentAboutUsPhoto = $aboutUsPhotoArray[$aboutUsPhoto];
          ?>
            <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
              <div class="card mx-auto w-100 my-5 d-flex zoom">
                <!-- Image preview -->
                <img id="aboutUsPhoto<?php echo $aboutUsPhoto; ?>" class="fresh-id fresh-for card-img-top" src="<?php echo $currentAboutUsPhoto["path"]; ?>">


                <!-- File upload form -->
                <form role='form' id="aboutUsPhotos<?php echo $aboutUsPhoto; ?>imagechange" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>#aboutUsPhotos" method="POST" enctype="multipart/form-data">
                  <input hidden name=row_num value="<?php echo $aboutUsPhoto; ?>">
                  <div class="custom-file">
                    <input type="file" name="photo" class="new-load-file-function fresh-id form-control-file" id="customAboutUsPhoto<?php echo $aboutUsPhoto; ?>" onchange="loadFile(event, 'aboutUsPhoto<?php echo $aboutUsPhoto; ?>')">
                    <label class="fresh-for custom-file-label" for="customAboutUsPhoto<?php echo $aboutUsPhoto; ?>">Choose file</label>
                  </div>
                </form>

                <!-- Delete form -->
                <form role='form' id="aboutUsPhoto<?php echo $aboutUsPhoto; ?>Delete" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>#aboutUsPhotos" method="POST">
                  <input hidden name=row_num value="<?php echo $aboutUsPhoto; ?>">
                </form>
                
                <!-- Possibly unnecessary -->
                <input hidden name=row_num form="aboutUsPhotos<?php echo $aboutUsPhoto; ?>" value="<?php echo $aboutUsPhoto; ?>">

                <!-- Form submission buttons-->
                <div class="mt-auto">
                  <div role="group" class="btn-group mx-auto mt-auto w-100">
                    <!-- Delete button -->
                    <input form="aboutUsPhoto<?php echo $aboutUsPhoto; ?>Delete" class="col-4 new-disable btn btn-danger mx-auto" type=submit name="aboutUsPhotoDeleteSubmit" value="Delete" />
                    <!-- Save Button -->
                    <input form="aboutUsPhotos<?php echo $aboutUsPhoto; ?>imagechange" name="aboutUsPhotoSubmit" type="submit" value="Save" class="col-4 submit-button btn btn-primary" />
                    <!-- New Button -->
                    <button type="button" class="new-disable btn btn-success mx-auto" onclick="newRow('aboutUsPhotoCards',<?php echo $aboutUsPhoto; ?>);">New</button>
                  </div>
                </div>

              </div>
            </div>
          <?php
          };
          ?>
        </div>
      </div>
    </div>
  </div>
</section>
