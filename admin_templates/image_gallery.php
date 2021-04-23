<?php
//Add a new photo
if (isset($_POST["photosNewSubmit"])) {
  //Read the form data
  $photos = $_FILES['photos'];
  $photos = reArrayFiles($photos);
  
  for ($i=0; $i < sizeof($photos); $i++) { 
    //Figure out where to save it
    $imageFileType = strtolower(pathinfo($photos[$i]["name"], PATHINFO_EXTENSION));
    $target_dir = "images/gallery/";
    $target_file = $target_dir . basename($photos[$i]["name"]);
    //Create a new photo array for the 
    //JSON file
    $PhotoArray = array(
      "path" => $target_file
    );
    
    //Save it, update the JSON file,
    //and tell the user
    savePhoto($photos[$i], $target_file);
    AddNewRowJSON($PhotoArray, "ImageGallery.json");
  }
  echoToAlert($fileCount . " new photos added successfully");
}

// https://www.php.net/manual/en/features.file-upload.multiple.php
function reArrayFiles($file_post) {

  $file_ary = array();
  $file_count = count($file_post['name']);
  $file_keys = array_keys($file_post);

  for ($i=0; $i<$file_count; $i++) {
      foreach ($file_keys as $key) {
          $file_ary[$i][$key] = $file_post[$key][$i];
      }
  }

  return $file_ary;
}

//Replace an existing photo
if (isset($_POST["photoSubmit"])) {
  //Read form data
  $photo = $_FILES['photo'][0];
  $rowToUpdate = intVal($_POST['row_num']);

  //Figure out where to save it 
  $imageFileType = strtolower(pathinfo($photo["name"], PATHINFO_EXTENSION));
  $target_dir = "images/gallery/";
  $target_file = $target_dir . basename($photo["name"]);

  //Create a new photo in JSON
  $aboutUsPhotoArray = array(
    "path" => $target_file
  );

  //Save the file, replace the old path in JSON, and tell the user
  savePhoto($photo, $target_file);
  updateRowJSON($rowToUpdate, $aboutUsPhotoArray, "ImageGallery.json");
  echoToAlert("Photo replaced successfully");
}

//Delete a photo. Caution: Based on index
if (isset($_POST['PhotoDeleteSubmit'])) {
  //Get the row number
  $rowToDelete = intVal($_POST['row_num']);

  //Delete it
  deleteRowJSON($rowToDelete, "ImageGallery.json");
  echoToAlert("Photo deleted successfully");
}

//Rearrange the photos
if (isset($_POST['PhotoCardsReorderSubmit'])) {
  //Get the original and new postitions
  $old_index = intVal($_POST['old_index']);
  $new_index = $_POST['new_index'];

  //Reorder the json file
  reorderArrayJSON("ImageGallery.json", $old_index, $new_index);
}
?>
<section id="photos">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h2>Image Gallery</h2>
        <b>Equally sized, landscape photos recommended, but not required. Uploading multiple photos is currently an experimental feature.</b>
        <div id="PhotoCards" class=row>
          <?php
          //Read and populate the original image data first.
          $PhotoArray = readArrayFromJSON("ImageGallery.json");
          for ($Photo = 0; $Photo <= sizeof($PhotoArray) - 1; $Photo++) {
            $currentPhoto = $PhotoArray[$Photo];
          ?>
            <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
              <div class="card mx-auto w-100 my-5 d-flex zoom">
                <!-- Preview image -->
                <img id="photosPhoto<?php echo $Photo; ?>" class="fresh-id fresh-for card-img-top" src="<?php echo $currentPhoto["path"]; ?>">

                <!-- File selection box -->
                <form role='form' id="Photos<?php echo $Photo; ?>imagechange" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>#photos' method="POST" enctype="multipart/form-data">
                  <div class="custom-file">
                    <input type="file" class="new-load-file-function btn-file fresh-id form-control-file" onchange="loadFile(event, 'photosPhoto<?php echo $Photo; ?>' )" name="photos[]" id="customPhoto<?php echo $Photo; ?>" multiple>

                    <label class="fresh-for custom-file-label" for="customPhoto<?php echo $Photo; ?>">Choose file</label>
                  </div>
                </form>

                <!-- Indexes. Which image is changing -->
                <input hidden name=row_num form="Photos<?php echo $Photo; ?>imagechange" value="<?php echo $Photo; ?>">
                <input hidden name=row_num form="Photos<?php echo $Photo; ?>" value="<?php echo $Photo; ?>">
                <input hidden name=row_num form="Photo<?php echo $Photo; ?>Delete" value="<?php echo $Photo; ?>">

                <!-- The form used for deletion. Has a submission button, and a row_num field. -->
                <form role='form' id="Photo<?php echo $Photo; ?>Delete" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>#photos' method="POST">
                </form>

                <!-- The delete, save, and new buttons -->
                <div class="mt-auto">
                  <div role="group" class="btn-group w-100 mx-auto mt-auto">

                    <!-- Deletion button -->
                    <input form="Photo<?php echo $Photo; ?>Delete" class="new-disable btn btn-danger mx-auto" type=submit name="PhotoDeleteSubmit" value="Delete" />

                    <!-- Save button -->
                    <input form="Photos<?php echo $Photo; ?>imagechange" name="photoSubmit" type="submit" value="Save" class="submit-button btn btn-primary" />

                    <!-- New button -->
                    <button type="button" class="new-disable btn btn-success mx-auto" onclick="newRow('PhotoCards',<?php echo $Photo; ?>);">New</button>
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