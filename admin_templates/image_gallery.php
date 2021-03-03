i<?php
if (isset($_POST["photosNewSubmit"])) {
  $photo = $_FILES['photo'];

  $imageFileType = strtolower(pathinfo($photo["name"], PATHINFO_EXTENSION));

  $target_dir = "images/gallery/";
  $target_file = $target_dir . basename($photo["name"]);
  $PhotoArray = array(
    "path" => $target_file
  );
  AddNewRowJSON($PhotoArray, "ImageGallery.json");
  savePhoto($photo, $target_file);
}
if (isset($_POST["photoSubmit"])) {
  $photo = $_FILES['photo'];
  $rowToUpdate = intVal($_POST['row_num']);

  $imageFileType = strtolower(pathinfo($photo["name"], PATHINFO_EXTENSION));

  //Save as images/aboutUsPhotos/nameOfOffice.fileExtension
  $target_dir = "images/gallery/";
  $target_file = $target_dir . basename($photo["name"]);
  $aboutUsPhotoArray = array(
    "path" => $target_file
  );
  updateRowJSON($rowToUpdate, $aboutUsPhotoArray, "ImageGallery.json");
  savePhoto($photo, $target_file);
}
if (isset($_POST['PhotoDeleteSubmit'])) {
  //Get the row number of the officer being modified
  $rowToDelete = intVal($_POST['row_num']);
  echo $rowToDelete;
  deleteRowJSON($rowToDelete, "ImageGallery.json");
  echoToAlert("Photo deleted successfully");
}
if (isset($_POST['PhotoCardsReorderSubmit'])) {
  $old_index = intVal($_POST['old_index']);
  $new_index = $_POST['new_index'];
  reorderArrayJSON("ImageGallery.json", $old_index, $new_index);
}
?>
<section id="photos">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h2>Image Gallery</h2>
        <b>Equally sized, landscape photos recommended, but not required.</b>
        <div id="PhotoCards" class=row>
          <?php
          $PhotoArray = readArrayFromJSON("ImageGallery.json");
          //Create a table row for each contact
          for ($Photo = 0; $Photo <= sizeof($PhotoArray) - 1; $Photo++) {
            $currentPhoto = $PhotoArray[$Photo];
          ?>
            <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
              <div class="card mx-auto w-100 my-5 d-flex zoom">
                <img id="photosPhoto<?php echo $Photo; ?>" class="fresh-id fresh-for card-img-top" src="<?php echo $currentPhoto["path"]; ?>">
                <form role='form' id="Photos<?php echo $Photo; ?>imagechange" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>#photos' method="POST" enctype="multipart/form-data">
                  <div class="custom-file">
                    <input type="file" class="new-load-file-function btn-file fresh-id form-control-file" onchange="loadFile(event, 'photosPhoto<?php echo $Photo;?>' )" name="photo" id="customPhoto<?php echo $Photo;?>">

                    <label class="fresh-for custom-file-label" for="customPhoto<?php echo $Photo; ?>">Choose file</label>
                  </div>
                </form>

                <input hidden name=row_num form="Photos<?php echo $Photo; ?>imagechange" value="<?php echo $Photo; ?>">
                <input hidden name=row_num form="Photos<?php echo $Photo; ?>MoveUp" value="<?php echo $Photo; ?>">
                <input hidden name=row_num form="Photos<?php echo $Photo; ?>MoveDown" value="<?php echo $Photo; ?>">

                </form>
                <input hidden name=row_num form="Photos<?php echo $Photo; ?>" value="<?php echo $Photo; ?>">
                <input hidden name=row_num form="Photo<?php echo $Photo; ?>Delete" value="<?php echo $Photo; ?>">
                <form role='form' id="Photo<?php echo $Photo; ?>Delete" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>#photos' method="POST">
                </form>
                <div class="mt-auto">
                  <div role="group" class="btn-group w-100 mx-auto mt-auto">

                    <input form="Photo<?php echo $Photo; ?>Delete" class="new-disable btn btn-danger mx-auto" type=submit name="PhotoDeleteSubmit" value="Delete" />

                    <input form="Photos<?php echo $Photo; ?>imagechange" name="photoSubmit" type="submit" value="Save" class="submit-button btn btn-primary" />

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
