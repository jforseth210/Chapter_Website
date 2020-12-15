<?php
//Add types of contact info and their
//url prefix here.
$contactTypeConversion = array(
    "Phone Number" => "tel:",
    "Email" => "mailto:",
    "Link" => "https://",
    "Fax" => "fax:"
);
//Form submission logic.
if (isset($_POST['contactInfoNewSubmit'])) {
    //Get contact information
    $contactName = $_POST['contactName'];
    $contactType = $_POST['contactType'];
    $contactInfo = $_POST['contactInfo'];
    //Convert human-readable to proper href
    //Ex: Phone Number => tel:
    $contactType = $contactTypeConversion[$contactType];
    //Prevent https://https:// if user enters it.
    $contactInfo = str_replace("https://", "", $contactInfo);

    $newContactArray = array(
        "contact_name"=>$contactName,
        "contact_type"=>$contactType,
        "contact_info"=>$contactInfo
    );
    addNewRowJSON($newContactArray, "contactInfoText.json");
}

if (isset($_POST['contactInfoUpdateSubmit'])) {

    //Get the row number of the contact being modified
    $rowToUpdate = intVal($_POST['row_num']);
    //Get contact information
    $contactName = $_POST['contactName'];
    $contactType = $_POST['contactType'];
    $contactInfo = $_POST['contactInfo'];

    //Convert human-readable to proper href
    //Ex: Phone Number => tel:
    $contactType = $contactTypeConversion[$contactType];
    //Prevent https://https:// if user enters it.
    $contactInfo = str_replace("https://", "", $contactInfo);

    $newContactArray = array(
        "contact_name"=>$contactName,
        "contact_type"=>$contactType,
        "contact_info"=>$contactInfo
    );

    updateRowJSON($rowToUpdate, $newContactArray, "contactInfoText.json");
}

if (isset($_POST['contactInfoDeleteSubmit'])) {
    //Get the row number of the contact being modified
    $rowToDelete = intVal($_POST['row_num']);

    deleteRowJSON($rowToDelete, "contactInfoText.json");
}
if (isset($_POST['contactInfoMoveSubmit'])) {
    //Get the row number of the contact being modified
    $rowToMove = intVal($_POST['row_num']);
    $direction = $_POST['direction'];
    reorderArrayJSON("contactInfoText.json", $rowToMove, $direction);
}
?>
<section id="contact">
    <div class=container-fluid>
        <div class=row>
            <div class=col-lg-11>
                <h2>Contact</h2>
                <div class="d-xs-inline  d-sm-none"><small class="">The table may not display correctly on small screens. Please flip to landscape mode or use a larger device.</small></div>
                <table class='table'>
                    <thead>
                        <th>Name:</th>
                        <th>Type:</th>
                        <th>Contact:</th>
                        <th>Add/Remove</th>
                        <th>Reorder</th>
                        <th>Update</th>
                        <tr />
                    </thead>
                    <tbody id="contactTable">
                        <?php
                        $contactArray = array();
                        $contactArray = readArrayFromJSON("contactInfoText.json");
                        for ($contact = 0; $contact <= sizeof($contactArray) - 1; $contact++) {
                            $currentContactArray = $contactArray[$contact];
                            $optionsArray = array_keys($contactTypeConversion);

                            //Create the start of the row, which is also a form.
                            echo "
                            <tr>
                            <form role='form' id=\"contact$contact\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#contact" . "' method=\"POST\">
                                <td>
                                    <input form=\"contact$contact\" name=\"contactName\" class=\"erasable-value form-control\" value=\"{$currentContactArray['contact_name']}\" />
                                </td>
                                <td>
                                    <select form=\"contact$contact\" class=\"erasable-value\"name=\"contactType\">
                                ";
                            for ($option = 0; $option <= sizeof($optionsArray) - 1; $option++) {
                                if ($contactTypeConversion[$optionsArray[$option]] == $currentContactArray["contact_type"]) {
                                    echo "<option selected>{$optionsArray[$option]}</option>";
                                } else {
                                    echo "<option>{$optionsArray[$option]}</option>";
                                };
                            }
                            echo "
                                    </select>
                                </td>
                                <td>
                                    <input name=\"contactInfo\" form=\"contact$contact\" class=\"erasable-value form-control\" value=\"{$currentContactArray["contact_info"]}\" />
                                </td>
                                <td>
                                    <button type=\"button\" class=\"btn btn-success\" onclick=\"newRow('contactTable',$contact);\">+</button>
                                    <form role='form' id=\"contact" . $contact . "Delete\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#contact" . "' method=\"POST\">
                                    <input class=\"btn btn-danger\" type=submit name=\"contactInfoDeleteSubmit\" value=\"-\"/>
                                    </form>
                                </td>
                                <td width=\"120px\">
                                  <form style=\"width:45px !important; display:inline;\" role='form' id=\"contact" . $contact . "MoveUp\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#contact" . "' method=\"POST\">
                                    <button class=\"btn btn-secondary\" type=submit name=\"contactInfoMoveSubmit\">
                                      <svg width=\"1em\" height=\"1em\" viewBox=\"0 0 16 16\" class=\"bi bi-arrow-up\" fill=\"currentColor\" xmlns=\"http://www.w3.org/2000/svg\">
                                      <path fill-rule=\"evenodd\" d=\"M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z\"/>
                                      </svg>
                                    </button>
                                    <input hidden name=\"direction\" value=\"up\"/>
                                  </form>

                                  <form class=mx-0 style=\"width:45px !important; display:inline;\" role='form' id=\"contact" . $contact . "MoveDown\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#contact" . "' method=\"POST\">
                                    <button class=\"btn btn-secondary \" type=submit name=\"contactInfoMoveSubmit\">
                                    <svg width=\"1em\" height=\"1em\" viewBox=\"0 0 16 16\" class=\"bi bi-arrow-down\" fill=\"currentColor\" xmlns=\"http://www.w3.org/2000/svg\">
                                      <path fill-rule=\"evenodd\" d=\"M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z\"/>
                                    </svg>
                                    </button>
                                    <input hidden name=\"direction\" value=\"down\"/>
                                  </form>
                                </td>
                                <input hidden name=row_num form=\"contact$contact\" value=\"$contact\">
                                <input hidden name=row_num form=\"contact" . $contact . "Delete\" value=\"$contact\">
                                <input hidden name=row_num form=\"contact" . $contact . "MoveUp\" value=\"$contact\">
                                <input hidden name=row_num form=\"contact" . $contact . "MoveDown\" value=\"$contact\">
                                <td>
                                    <input form=\"contact$contact\" class=\"btn btn-primary submit-button\" type=submit name=\"contactInfoUpdateSubmit\" value=\"Update\"/>
                                </td>
                              </form>
                            </tr>";
                            };
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
