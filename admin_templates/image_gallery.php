<?php
if (isset($_POST["PhotoNewSubmit"])) {
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
    reorderArrayJSON("ImageGallery.json", $rowToMove, $direction);
}



//Already defined in about_us_image_gallery.php
/*function savePhoto($photo, $target_file){
  $uploadOk = 1;

  // Check if image file is a actual image or fake image
  $check = getimagesize($photo["tmp_name"]);
  if ($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
  } else {
      echo "File is not an image.";
      $uploadOk = 0;
  }

  // Check file size
  /*if ($photo["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
  }

  // Allow certain file formats
  $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
  echo $imageFileType;
  if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif"
  ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($photo["tmp_name"], $target_file)) {
          echo "The file " . htmlspecialchars(basename($photo["name"])) . " has been uploaded.";
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  }
}*/
?>
<section id="Photos">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2>About Us Images</h2>
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
                                          <img class=\"card-img-top\" src=\"{$currentPhoto["path"]}\">
                                          <form role='form' id=\"Photos$Photo" . "imagechange" . "\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#Photos" . "' method=\"POST\" enctype=\"multipart/form-data\">
                                          <div class=\"custom-file\">
                                              <input type=\"file\" name=\"photo\" class=\"fresh-id form-control-file\" id=\"customPhoto$Photo\">
                                              <label class=\"fresh-for custom-file-label\" for=\"customPhoto$Photo\">Choose file</label>
                                          </div>

                                          <input hidden name=row_num form=\"Photos$Photo" . "imagechange" . "\" value=\"$Photo\">
                                          <input hidden name=row_num form=\"Photos" . $Photo . "MoveUp\" value=\"$Photo\">
                                          <input hidden name=row_num form=\"Photos" . $Photo . "MoveDown\" value=\"$Photo\">

                                          <input name=\"photoSubmit\" type=\"submit\" value=\"Upload New Picture\" class=\"submit-button btn btn-primary w-100\"/>
                                          </form>
                                          <br />
                                          <div class=\"card-body\">
                                              <br />
                                              <input hidden name=row_num form=\"Photos$Photo\" value=\"$Photo\">
                                              <input hidden name=row_num form=\"Photo$Photo" . "Delete\" value=\"$Photo\">
                                              <div class=\"mt-auto\">
                                              <div role=\"group\" class=\"btn-group mx-auto mt-auto\">
                                                <form style=\"display:inline;\" role='form' id=\"Photos" . $Photo . "MoveUp\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#Photos" . "' method=\"POST\">
                                                  <button class=\"btn btn-secondary\" type=submit name=\"PhotoMoveSubmit\">
                                                  Move Up
                                                  </button>
                                                  <input hidden name=\"direction\" value=\"up\"/>
                                                </form>
                                                    <form role='form' id=\"" . "Photo" . $Photo . "Delete\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#Photos" . "' method=\"POST\">
                                                        <input form=\"" . "Photo" . $Photo . "Delete\" class=\"btn btn-danger mx-auto\" type=submit name=\"PhotoDeleteSubmit\" value=\"Delete\" />
                                                    </form>

                                                    <button type=\"button\" class=\"btn btn-success mx-auto\" onclick=\"newRow('PhotoCards',$Photo);\">New</button>

                                                <form class=mx-0 style=\"display:inline;\" role='form' id=\"Photos" . $Photo . "MoveDown\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#Photos" . "' method=\"POST\">
                                                  <button class=\"btn btn-secondary \" type=submit name=\"PhotoMoveSubmit\" >
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
