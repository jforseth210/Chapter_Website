<?php
//Officers
if (isset($_POST['officerNewSubmit'])) {
    //Get officer information
    $officerTitle = $_POST['officerTitle'];
    $officerName = $_POST['officerName'];
    $officerBio = $_POST['officerBio'];

    $officerArray = array(
        "officer_title" => $officerTitle,
        "officer_name" => $officerName,
        "officer_bio" => $officerBio,
        "officer_image_ext" => "Image not yet uploaded"
    );

    addNewRowJSON($officerArray, "officers.json");
}

if (isset($_POST['officerUpdateSubmit'])) {
    //Get the row number of the officer being modified
    $rowToUpdate = intVal($_POST['row_num']);
    //Get officer information
    $officerTitle = $_POST['officerTitle'];
    $officerName = $_POST['officerName'];
    $officerBio = $_POST['officerBio'];

    $officerArray = array(
        "officer_title" => $officerTitle,
        "officer_name" => $officerName,
        "officer_bio" => $officerBio
    );

    $oldOfficerArray = readArrayFromJSON("officers.json");
    $oldOfficerArray = $oldOfficerArray[$rowToUpdate];

    //The images are saved as officer_title.ext, so if the officer's postition is
    //changed, the filename needs to change with them.
    rename("images/officers/" . $officerArray["officer_title"], "images/officers/" . $officerArray["officer_title"]);


    $officerArray['officer_image_ext'] = $oldOfficerArray['officer_image_ext'];
    updateRowJSON($rowToUpdate, $officerArray, "officers.json");
}

if (isset($_POST['officerDeleteSubmit'])) {
    //Get the row number of the officer being modified
    $rowToDelete = intVal($_POST['row_num']);

    deleteRowJSON($rowToDelete, "officers.json");
}
if (isset($_POST['officerMoveSubmit'])) {
    //Get the row number of the officer being modified
    $rowToMove = intVal($_POST['row_num']);
    $direction = $_POST['direction'];
    reorderArrayJSON("officers.json", $rowToMove, $direction);
}
//
if (isset($_POST["officerImageSubmit"])) {
    //Get the data
    $officerImage = $_FILES['officerImage'];
    $rowToRead = intVal($_POST['row_num']);

    //Read the original data
    $officerArray = readArrayFromJSON("officers.json");

    $officerTitle = $officerArray[$rowToRead]['officer_title'];
    $imageFileType = strtolower(pathinfo($officerImage["name"], PATHINFO_EXTENSION));

    $officerArray[$rowToRead]['officer_image_ext'] = $imageFileType;
    updateRowJSON($rowToRead, $officerArray[$rowToRead], "officers.json");

    //Save as images/officers/nameOfOffice.fileExtension
    $target_dir = "images/officers/";
    $target_file = $target_dir . basename($officerTitle . "." . $imageFileType);
    savePhoto($officerImage, $target_file);
}
?>
<section id="officers">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2>Officers</h2>
                <b>Equally sized, landscape photos recommended, but not required.</b>
                <div id="officerCards" class=row>
                    <?php
                    $officerArray = readArrayFromJSON("officers.json");
                    //Create a table row for each contact
                    for ($officer = 0; $officer <= sizeof($officerArray) - 1; $officer++) {
                        $currentOfficer = $officerArray[$officer];
                        //Create the start of the row, which is also a form.
                        echo "
                                <div class=\"col-md-4 d-flex\">
                                    <div class=\"card mx-auto w-100 my-5 d-flex zoom\">
                                            <img id=\"officerImage$officer\" class=\"fresh-id fresh-for card-img-top\" src=\"images/officers/{$currentOfficer["officer_title"]}.{$currentOfficer["officer_image_ext"]}\">
                                            <form role='form' id=\"officers$officer" . "imagechange" . "\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#officers" . "' method=\"POST\" enctype=\"multipart/form-data\">
                                            <div class=\"custom-file\">
                                                <input type=\"file\" name=\"officerImage\" class=\"fresh-id new-load-file-function form-control-file\" id=\"officerCustomFile$officer\" onchange=\"loadFile(event, 'officerImage$officer')\">
                                                <label class=\"custom-file-label fresh-for\" for=\"officerCustomFile$officer\">Choose file</label>
                                            </div>

                                            <input hidden name=row_num form=\"officers$officer" . "imagechange" . "\" value=\"$officer\">
                                            <input hidden name=row_num form=\"officers" . $officer . "MoveUp\" value=\"$officer\">
                                            <input hidden name=row_num form=\"officers" . $officer . "MoveDown\" value=\"$officer\">
                                            <input name=\"officerImageSubmit\" type=\"submit\" value=\"Upload New Picture\" class=\"btn btn-primary w-100\"/>
                                            </form>
                                            <br />
                                            <div class=\"card-body\">
                                            <form role='form' id=\"officers$officer\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#officers" . "' method=\"POST\">
                                                <h3><input form=\"officers$officer\" name=\"officerTitle\" class=\"erasable-value form-control\" value=\"{$currentOfficer["officer_title"]}\" placeholder=\"Title\"/></h3>
                                                <h5><input form=\"officers$officer\" name=\"officerName\" class=\"erasable-value form-control\" value=\"{$currentOfficer["officer_name"]}\" placeholder=\"Name\"/></h5>

                                                <textArea form=\"officers$officer\" style=\"height:200px !important\"name=\"officerBio\" class=\"erasable-value form-control\" placeholder=\"Bio\">" . str_replace("NEWLINE", "\n", str_replace("VERTICALSEPARATOR", "|", $currentOfficer["officer_bio"])) . "</textarea>

                                                <br />
                                                <input hidden name=row_num form=\"officers$officer\" value=\"$officer\">
                                                <input hidden name=row_num form=\"officers$officer" . "Delete\" value=\"$officer\">
                                                <div class=\"mt-auto\">
                                                <div role=\"group\" class=\"btn-group mx-auto mt-auto\">
                                                    <form role='form' id=\"" . "officers" . $officer . "Delete\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#officers" . "' method=\" POST\">
                                                        <input class=\"new-disable btn btn-danger mx-auto\" type=submit name=\"officerDeleteSubmit\" value=\"Delete\" />
                                                    </form>
                                                    <input form=\"officers$officer\" class=\"btn btn-primary submit-button mx-auto\" type=submit name=\"officerUpdateSubmit\" value=\"Save\" />
                                                    <button type=\"button\" class=\"new-disable btn btn-success mx-auto\" onclick=\"newRow('officerCards',$officer);\">New</button>
                                                </div>
                                                <form style=\"display:inline;\" role='form' id=\"officers" . $officer . "MoveUp\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#officers" . "' method=\"POST\">
                                                  <button class=\"new-disable btn btn-secondary\" type=submit name=\"officerMoveSubmit\">
                                                    Move Up
                                                  </button>
                                                  <input hidden name=\"direction\" value=\"up\"/>
                                                </form>

                                                <form class=mx-0 style=\"display:inline;\" role='form' id=\"officers" . $officer . "MoveDown\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#officers" . "' method=\"POST\">
                                                  <button class=\"new-disable btn btn-secondary \" type=submit name=\"officerMoveSubmit\">
                                                    Move Down
                                                  </button>
                                                  <input hidden name=\"direction\" value=\"down\"/>
                                                </form>
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
