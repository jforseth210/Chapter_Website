<?php
//About Us Photos
if (isset($_POST['aboutUsPhotoDeleteSubmit'])) {
    //Get the row number of the photo being modified
    $rowToDelete = intVal($_POST['row_num']);

    deleteRowJSON($rowToDelete, "aboutUsImageGallery.json");
}
if (isset($_POST['aboutUsPhotoMoveSubmit'])) {
    //Get the row number of the photo being modified
    $rowToMove = intVal($_POST['row_num']);
    $direction = $_POST['direction'];
    reorderArrayJSON("aboutUsImageGallery.json", $rowToMove, $direction);
}
//
if (isset($_POST["aboutUsPhotoSubmit"])) {
    //Get the data
    $photo = $_FILES['photo'];

    $target_dir = "images/about_us_gallery/";
    $target_file = $target_dir . basename($photo["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($photo["name"], PATHINFO_EXTENSION));

    $photoArray = array(
        "path"=>$target_file
    );
    print_r($photo);
    addNewRowJSON($photoArray, "aboutUsImageGallery.json");

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($photoImage["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check file size
    /*if ($photoImage["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    }*/

    // Allow certain file formats
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
                    $photoArray = readArrayFromJSON("aboutUsImageGallery.json");
                    //Create a table row for each contact
                    for ($photo = 0; $photo <= sizeof($photoArray) - 1; $photo++) {
                        $currentPhoto = $photoArray[$photo];
                        //Create the start of the row, which is also a form.
                        echo "
                                <div class=\"col-md-2 d-flex\">
                                    <div class=\"card mx-auto w-100 my-5 d-flex zoom\">
                                        <img class=\"card-img-top\" src=\"{$currentPhoto["path"]}\">
                                        <form role='form' id=\"aboutUsImages$photo" . "imagechange" . "\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#aboutUsPhotos" . "' method=\"POST\" enctype=\"multipart/form-data\">
                                            <input name=\"aboutUsPhotoSubmit\" type=\"submit\" value=\"Upload New Picture\" class=\"btn btn-primary w-100\"/>
                                            <input hidden name=row_num class=row_num  value=\"$photo\">
                                            <div class=\"custom-file\">
                                              <input type=\"file\" name=\"photo\" class=\"form-control-file\" id=\"customFile\">
                                              <label class=\"custom-file-label\" for=\"customFile\">Choose file</label>
                                            </div>
                                        </form>

                                        <input hidden name=row_num form=\"aboutUsImages$photo\" value=\"$photo\">
                                        <input hidden name=row_num form=\"aboutUsImages$photo" . "Delete\" value=\"$photo\">

                                        <form role='form' id=\"" . "photos" . $photo . "Delete\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#aboutUsPhotos" . "' method=\" POST\">
                                            <input class=\"btn btn-danger mx-auto\" type=submit name=\"aboutUsPhotoDeleteSubmit\" id=\"aboutUsPhotoDeleteSubmit\" value=\"Delete\" />
                                        </form>


                                        <button type=\"button\" class=\"btn btn-success mx-auto\" onclick=\"newRow('aboutUsPhotoCards',$photo);\">New</button>
                                        <!--
                                        newRow() function designed to deal with text,
                                        not images only. Needs some dummy elements to
                                        like this one to work properly.
                                        -->
                                        <div class='erasable-value submit-button' style='display:none'></div>


                                        <form style=\"display:inline;\" role='form' id=\"aboutUsImages" . $photo . "MoveUp\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#aboutUsPhotos" . "' method=\"POST\">
                                            <button class=\"btn btn-secondary\" type=submit name=\"aboutUsPhotoMoveSubmit\" id=\"aboutUsPhotoMoveSubmit\">
                                              Move Up
                                            </button>
                                            <input hidden name=\"direction\" value=\"up\"/>
                                        </form>


                                        <form class=mx-0 style=\"display:inline;\" role='form' id=\"aboutUsImages" . $photo . "MoveDown\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#aboutUsPhotos" . "' method=\"POST\">
                                            <button class=\"btn btn-secondary \" type=submit name=\"aboutUsPhotoMoveSubmit\" id=\"aboutUsPhotoMoveSubmit\">
                                              Move Down
                                            </button>
                                            <input hidden name=\"direction\" value=\"down\"/>
                                        </form>
                                        <input hidden name=row_num form=\"aboutUsImages" . $photo . "MoveUp\" value=\"$photo\">
                                        <input hidden name=row_num form=\"aboutUsImages" . $photo . "MoveDown\" value=\"$photo\">
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
