<?php
//Add types of contact info and their
//url prefix here.
$contactTypeConversion = array(
    "Phone Number" => "tel:",
    "Email" => "mailto:",
    "Link" => "https://",
    "Fax" => "fax:"
);

//New contact
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
        "contact_name" => $contactName,
        "contact_type" => $contactType,
        "contact_info" => $contactInfo
    );
    addNewRowJSON($newContactArray, "contactInfoText.json");
    echoToAlert($contactName . " added successfully.");
}

//Update existing contact
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

    //Create a new contact array
    $newContactArray = array(
        "contact_name" => $contactName,
        "contact_type" => $contactType,
        "contact_info" => $contactInfo
    );

    //Write to JSON and let the user know it worked
    updateRowJSON($rowToUpdate, $newContactArray, "contactInfoText.json");
    echoToAlert($contactName . " updated successfully.");
}

//Contact deletion. 
//NOTE: Index based, duplicate requests may result in
//unintended deletion. 
if (isset($_POST['contactInfoDeleteSubmit'])) {
    //Get the row number of the contact being modified
    $rowToDelete = intVal($_POST['row_num']);

    //Delete the row and tell the user
    deleteRowJSON($rowToDelete, "contactInfoText.json");
    echoToAlert("Contact deleted successfully.");
}

//Reorder contact table
if (isset($_POST['contactTableReorderSubmit'])) {
    //Get original index, desired index
    $old_index = intVal($_POST['old_index']);
    $new_index = $_POST['new_index'];

    //Reorder the json file
    reorderArrayJSON("contactInfoText.json", $old_index, $new_index);
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
                        <th>Save</th>
                    </thead>
                    <tbody id="contactTable">
                        <?php
                        $contactArray = array();
                        $contactArray = readArrayFromJSON("contactInfoText.json");
                        for ($contact = 0; $contact <= sizeof($contactArray) - 1; $contact++) {
                            $currentContactArray = $contactArray[$contact];
                            $optionsArray = array_keys($contactTypeConversion);
                        ?>
                            <tr>
                                <!-- The main form, used for updated/new contacts -->
                                <form role="form" id="contact<?php echo $contact; ?>" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>#contact" method="POST">
                                    <!-- Name of the contact. E.G: John Doe, Advisor, or School Phone: -->
                                    <td>
                                        <input form="contact<?php echo $contact; ?>" name="contactName" class="erasable-value form-control" value="<?php echo $currentContactArray['contact_name'] ?>" />
                                    </td>

                                    <!-- The type of contact info. Phone number, email, etc. -->
                                    <td>
                                        <select form="contact<?php echo $contact; ?>" class="form-control erasable-value" name="contactType">
                                            <?php
                                            for ($option = 0; $option <= sizeof($optionsArray) - 1; $option++) {
                                                if ($contactTypeConversion[$optionsArray[$option]] == $currentContactArray["contact_type"]) {
                                                    echo "<option selected>{$optionsArray[$option]}</option>";
                                                } else {
                                                    echo "<option>{$optionsArray[$option]}</option>";
                                                };
                                            }
                                            ?>
                                        </select>
                                    </td>

                                    <!-- The contact information itself.-->
                                    <td>
                                        <input name="contactInfo" form="contact<?php echo $contact; ?>" class="erasable-value form-control" value="<?php echo $currentContactArray["contact_info"] ?>" />
                                    </td>

                                    <!-- New contact button -->
                                    <td>
                                        <button type="button" class="new-disable btn btn-success" onclick="newRow('contactTable',<?php echo $contact; ?>);">+</button>
                                        <form role='form' id="contact<?php echo $contact; ?>Delete" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>#contact" . "' method="POST">
                                            <input class="new-disable btn btn-danger" type=submit name="contactInfoDeleteSubmit" value="-" />
                                        </form>
                                    </td>

                                    <!-- Reorder handle -->
                                    <td width="120px">
                                        <div class="btn btn-secondary handle">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-move" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 1.707V5.5a.5.5 0 0 1-1 0V1.707L6.354 2.854a.5.5 0 1 1-.708-.708l2-2zM8 10a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 14.293V10.5A.5.5 0 0 1 8 10zM.146 8.354a.5.5 0 0 1 0-.708l2-2a.5.5 0 1 1 .708.708L1.707 7.5H5.5a.5.5 0 0 1 0 1H1.707l1.147 1.146a.5.5 0 0 1-.708.708l-2-2zM10 8a.5.5 0 0 1 .5-.5h3.793l-1.147-1.146a.5.5 0 0 1 .708-.708l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L14.293 8.5H10.5A.5.5 0 0 1 10 8z" />
                                            </svg>
                                        </div>
                                    </td>
                                    
                                    <!-- Indexes used to tell which contact is being modified -->
                                    <input hidden name=row_num form="contact<?php echo $contact; ?>" value="<?php echo $contact; ?>">
                                    <input hidden name=row_num form="contact<?php echo $contact; ?>Delete" value="<?php echo $contact; ?>">
                                    <input hidden name=row_num form="contact<?php echo $contact; ?>MoveUp" value="<?php echo $contact; ?>">
                                    <input hidden name=row_num form="contact<?php echo $contact; ?>MoveDown" value="<?php echo $contact; ?>">
                                    
                                    <!-- Save button -->
                                    <td>
                                        <input form="contact<?php echo $contact; ?>" class="btn btn-primary submit-button" type=submit name="contactInfoUpdateSubmit" value="Save" />
                                    </td>
                                </form>
                            </tr>
                        <?php
                        };
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>