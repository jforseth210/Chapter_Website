<?php
if (isset($_POST["aboutUsPhotoNewSubmit"])) {
  $photo = $_FILES['photo'];

  $imageFileType = strtolower(pathinfo($photo["name"], PATHINFO_EXTENSION));

  //Save as images/aboutUsPhotos/nameOfOffice.fileExtension
  $target_dir = "images/about_us_gallery/";
  $target_file = $target_dir . basename($photo["name"]);
  $aboutUsPhotoArray = array(
    "path"=>$target_file
  );
  AddNewRowJSON($aboutUsPhotoArray, "aboutUsImageGallery.json");
  savePhoto($photo, $target_file);
}

if (isset($_POST['aboutUsPhotoDeleteSubmit'])) {
    //Get the row number of the officer being modified
    $rowToDelete = intVal($_POST['row_num']);
    echo $rowToDelete;
    deleteRowJSON($rowToDelete, "aboutUsImageGallery.json");
}
if (isset($_POST['aboutUsPhotoMoveSubmit'])) {
    //Get the row number of the officer being modified
    $rowToMove = intVal($_POST['row_num']);
    $direction = $_POST['direction'];
    reorderArrayJSON("aboutUsImageGallery.json", $rowToMove, $direction);
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
                      echo "
                              <div class=\"col-md-4 d-flex\">
                                  <div class=\"card mx-auto w-100 my-5 d-flex zoom\">
                                          <img id=\"aboutUsPhoto$aboutUsPhoto\" class=\"fresh-id fresh-for card-img-top\" src=\"{$currentAboutUsPhoto["path"]}\">
                                          <form role='form' id=\"aboutUsPhotos$aboutUsPhoto" . "imagechange" . "\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#aboutUsPhotos" . "' method=\"POST\" enctype=\"multipart/form-data\">
                                          <div class=\"custom-file\">
                                              <input type=\"file\" name=\"photo\" class=\"new-load-file-function fresh-id form-control-file\" id=\"customAboutUsPhoto$aboutUsPhoto\" onchange=\"loadFile(event, 'aboutUsPhoto$aboutUsPhoto')\">
                                              <label class=\"fresh-for custom-file-label\" for=\"customAboutUsPhoto$aboutUsPhoto\">Choose file</label>
                                          </div>

                                          <input hidden name=row_num form=\"aboutUsPhotos$aboutUsPhoto" . "imagechange" . "\" value=\"$aboutUsPhoto\">
                                          <input hidden name=row_num form=\"aboutUsPhotos" . $aboutUsPhoto . "MoveUp\" value=\"$aboutUsPhoto\">
                                          <input hidden name=row_num form=\"aboutUsPhotos" . $aboutUsPhoto . "MoveDown\" value=\"$aboutUsPhoto\">

                                          <input name=\"photoSubmit\" type=\"submit\" value=\"Save\" class=\"submit-button btn btn-primary w-100\"/>
                                          </form>
                                          <br />
                                          <div class=\"card-body\">
                                              <br />
                                              <input hidden name=row_num form=\"aboutUsPhotos$aboutUsPhoto\" value=\"$aboutUsPhoto\">
                                              <input hidden name=row_num form=\"aboutUsPhoto$aboutUsPhoto" . "Delete\" value=\"$aboutUsPhoto\">
                                              <div class=\"mt-auto\">
                                              <div role=\"group\" class=\"btn-group mx-auto mt-auto\">
                                                <form style=\"display:inline;\" role='form' id=\"aboutUsPhotos" . $aboutUsPhoto . "MoveUp\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#aboutUsPhotos" . "' method=\"POST\">
                                                  <button class=\"new-disable btn btn-secondary\" type=submit name=\"aboutUsPhotoMoveSubmit\">
                                                  Move Up
                                                  </button>
                                                  <input hidden name=\"direction\" value=\"up\"/>
                                                </form>
                                                    <form role='form' id=\"" . "aboutUsPhoto" . $aboutUsPhoto . "Delete\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#aboutUsPhotos" . "' method=\"POST\">
                                                        <input form=\"" . "aboutUsPhoto" . $aboutUsPhoto . "Delete\" class=\"new-disable btn btn-danger mx-auto\" type=submit name=\"aboutUsPhotoDeleteSubmit\" value=\"Delete\" />
                                                    </form>

                                                    <button type=\"button\" class=\"new-disable btn btn-success mx-auto\" onclick=\"newRow('aboutUsPhotoCards',$aboutUsPhoto);\">New</button>

                                                <form class=mx-0 style=\"display:inline;\" role='form' id=\"aboutUsPhotos" . $aboutUsPhoto . "MoveDown\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#aboutUsPhotos" . "' method=\"POST\">
                                                  <button class=\"new-disable btn btn-secondary \" type=submit name=\"aboutUsPhotoMoveSubmit\" >
                                                    Move Down
                                                  </button>
                                                  <input hidden name=\"direction\" value=\"down\"/>
                                                </form>
                                              </div>
                                          </div>
                                          </div>
                                          <p></p>
                                      </form>
                                  </div>
                              </div>
                              ";
                  };
                  ?>
                </div>
            </div>
        </div>
    </div>
</section>
