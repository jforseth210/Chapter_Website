<?php
if (isset($_POST["photosNewSubmit"])) {
  $photo = $_FILES['photo'];

  $imageFileType = strtolower(pathinfo($photo["name"], PATHINFO_EXTENSION));

  $target_dir = "images/gallery/";
  $target_file = $target_dir . basename($photo["name"]);
  $PhotoArray = array(
    "path"=>$target_file
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
}
if (isset($_POST['PhotoMoveSubmit'])) {
    //Get the row number of the officer being modified
    $rowToMove = intVal($_POST['row_num']);
    $direction = $_POST['direction'];
    arrayMoveUpDownJSON("ImageGallery.json", $rowToMove, $direction);
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
                      //Create the start of the row, which is also a form.
                      echo "
                              <div class=\"col-md-4 d-flex\">
                                  <div class=\"card mx-auto w-100 my-5 d-flex zoom\">
                                          <img id=\"photosPhoto$Photo\"class=\"fresh-id fresh-for card-img-top\" src=\"{$currentPhoto["path"]}\">
                                          <form  role='form' id=\"Photos$Photo" . "imagechange" . "\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#photos" . "' method=\"POST\" enctype=\"multipart/form-data\">
                                          </form>
                                          <div class=\"custom-file\">
                                              <input type=\"file\"  class=\"new-load-file-function btn-file fresh-id form-control-file\"
                                                     onchange=\"loadFile(event, 'photosPhoto$Photo')\"
                                                     name=\"photo\"
                                              id=\"customPhoto$Photo\">

                                              <label class=\"fresh-for custom-file-label\" for=\"customPhoto$Photo\">Choose file</label>
                                          </div>

                                          <!--<div class=\"form-group\">
                                            <label>Upload Image</label>
                                            <div class=\"input-group\">
                                                <span class=\"input-group-btn\">
                                                    <span class=\"btn btn-default btn-file\">
                                                        Browse… <input type=\"file\" id=\"imgInp\">
                                                    </span>
                                                </span>
                                                <input type=\"text\" class=\"form-control\" readonly>
                                            </div>
                                            <img id='img-upload'/>
                                        </div>-->


                                          <input hidden name=row_num form=\"Photos$Photo" . "imagechange" . "\" value=\"$Photo\">
                                          <input hidden name=row_num form=\"Photos" . $Photo . "MoveUp\" value=\"$Photo\">
                                          <input hidden name=row_num form=\"Photos" . $Photo . "MoveDown\" value=\"$Photo\">

                                          </form>
                                          <input hidden name=row_num form=\"Photos$Photo\" value=\"$Photo\">
                                          <input hidden name=row_num form=\"Photo$Photo" . "Delete\" value=\"$Photo\">
                                          <form role='form' id=\"" . "Photo" . $Photo . "Delete\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#photos" . "' method=\"POST\">
                                          </form>
                                          <div class=\"mt-auto\">
                                          <div role=\"group\" class=\"btn-group w-100 mx-auto mt-auto\">
                                          
                                          <input form=\"" . "Photo" . $Photo . "Delete\" class=\"new-disable btn btn-danger mx-auto\" type=submit name=\"PhotoDeleteSubmit\" value=\"Delete\" />
                                          
                                          <input name=\"photoSubmit\" type=\"submit\" value=\"Save\" class=\"submit-button btn btn-primary\"/>
                                          
                                          <button type=\"button\" class=\"new-disable  btn btn-success mx-auto\" onclick=\"newRow('PhotoCards',$Photo);\">New</button>
                                          </div>
                                          </div>


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
