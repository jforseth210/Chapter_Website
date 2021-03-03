<?php
if (isset($_POST["aboutUsPhotoNewSubmit"])) {
  $photo = $_FILES['photo'];

  $imageFileType = strtolower(pathinfo($photo["name"], PATHINFO_EXTENSION));

  //Save as images/aboutUsPhotos/nameOfOffice.fileExtension
  $target_dir = "images/about_us_gallery/";
  $target_file = $target_dir . basename($photo["name"]);
  $aboutUsPhotoArray = array(
    "path" => $target_file
  );
  AddNewRowJSON($aboutUsPhotoArray, "aboutUsImageGallery.json");
  savePhoto($photo, $target_file);
}
if (isset($_POST["aboutUsPhotoSubmit"])) {
  $photo = $_FILES['photo'];
  $rowToUpdate = intVal($_POST['row_num']);

  $imageFileType = strtolower(pathinfo($photo["name"], PATHINFO_EXTENSION));

  //Save as images/aboutUsPhotos/nameOfOffice.fileExtension
  $target_dir = "images/about_us_gallery/";
  $target_file = $target_dir . basename($photo["name"]);
  $aboutUsPhotoArray = array(
    "path" => $target_file
  );
  updateRowJSON($rowToUpdate, $aboutUsPhotoArray, "aboutUsImageGallery.json");
  savePhoto($photo, $target_file);
}
if (isset($_POST['aboutUsPhotoDeleteSubmit'])) {
  //Get the row number of the officer being modified
  $rowToDelete = intVal($_POST['row_num']);
  echo $rowToDelete;
  deleteRowJSON($rowToDelete, "aboutUsImageGallery.json");
  echoToAlert("Photo deleted successfully");
}
if (isset($_POST['aboutUsPhotoCardsReorderSubmit'])) {
  $old_index = intVal($_POST['old_index']);
  $new_index = $_POST['new_index'];
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
          //Create a table row for each contact
          for ($aboutUsPhoto = 0; $aboutUsPhoto <= sizeof($aboutUsPhotoArray) - 1; $aboutUsPhoto++) {
            $currentAboutUsPhoto = $aboutUsPhotoArray[$aboutUsPhoto];
            //Create the start of the row, which is also a form.
          ?>
            <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
              <div class="card mx-auto w-100 my-5 d-flex zoom">
                <img id="aboutUsPhoto<?php echo $aboutUsPhoto; ?>" class="fresh-id fresh-for card-img-top" src="<?php echo $currentAboutUsPhoto["path"]; ?>">

                <form role='form' id="aboutUsPhotos<?php echo $aboutUsPhoto; ?>imagechange" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>#aboutUsPhotos" method="POST" enctype="multipart/form-data">
                  <input hidden name=row_num value="<?php echo $aboutUsPhoto; ?>">
                  <div class="custom-file">
                    <input type="file" name="photo" class="new-load-file-function fresh-id form-control-file" id="customAboutUsPhoto<?php echo $aboutUsPhoto; ?>" onchange="loadFile(event, 'aboutUsPhoto<?php echo $aboutUsPhoto; ?>')">
                    <label class="fresh-for custom-file-label" for="customAboutUsPhoto<?php echo $aboutUsPhoto; ?>">Choose file</label>
                  </div>
                </form>

                <form role='form' id="aboutUsPhoto<?php echo $aboutUsPhoto; ?>Delete" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>#aboutUsPhotos" method="POST">
                  <input hidden name=row_num value="<?php echo $aboutUsPhoto; ?>">
                </form>

                <input hidden name=row_num form="aboutUsPhotos<?php echo $aboutUsPhoto; ?>" value="<?php echo $aboutUsPhoto; ?>">


                <div class="mt-auto">
                  <div role="group" class="btn-group mx-auto mt-auto w-100">
                    <input form="aboutUsPhoto<?php echo $aboutUsPhoto; ?>Delete" class="col-4 new-disable btn btn-danger mx-auto" type=submit name="aboutUsPhotoDeleteSubmit" value="Delete" />

                    <input form="aboutUsPhotos<?php echo $aboutUsPhoto; ?>imagechange" name="aboutUsPhotoSubmit" type="submit" value="Save" class="col-4 submit-button btn btn-primary" />

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
