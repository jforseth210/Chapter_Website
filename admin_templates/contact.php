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
                        <th>Update</th>
                        <tr />
                    </thead>
                    <tbody id="contactTable">
                        <?php
                        //Read the contacts
                        $contactFile = fopen("data_files/contactInfoText.txt", "r");
                        $contactText = fread($contactFile, filesize("data_files/contactInfoText.txt"));
                        fclose($contactFile);
                        //Split the contacts by row.
                        $contactArray = explode("\n", $contactText);
                        //Create a table row for each contact
                        for ($contact = 0; $contact <= sizeof($contactArray) - 1; $contact++) {
                            $currentContact = $contactArray[$contact];

                            $currentContactArray = explode("|", $currentContact);

                            $optionsArray = array_keys($contactTypeConversion);

                            //Ignore empty lines
                            if ($currentContact != "") {
                                //Create the start of the row, which is also a form.
                                echo "
                                <tr>
                                <form role='form' id=\"contact$contact\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "' method=\"POST\">
                                <td>
                                    <input form=\"contact$contact\" name=\"contactName\" class=\"erasable-value form-control\" value=\"$currentContactArray[0]\" />
                                </td>
                                <td>
                                    <select form=\"contact$contact\" class=\"erasable-value\"name=\"contactType\">
                            ";
                                for ($option = 0; $option <= sizeof($optionsArray) - 1; $option++) {
                                    if ($contactTypeConversion[$optionsArray[$option]] == $currentContactArray[1]) {
                                        echo "<option selected>{$optionsArray[$option]}</option>";
                                    } else {
                                        echo "<option>{$optionsArray[$option]}</option>";
                                    };
                                }
                                echo "
                        </select>
                        </td>
                        <td>
                            <input name=\"contactInfo\" form=\"contact$contact\" class=\"erasable-value form-control\" value=\"{$currentContactArray[2]}\" />
                        </td>
                            <td>
                                <button type=\"button\" class=\"btn btn-success\" onclick=\"newRow('contactTable',$contact);\">+</button>
                                <form role='form' id=\"contact" . $contact . "Delete\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "' method=\"POST\">
                                <input class=\"btn btn-danger\" type=submit name=\"contactInfoDeleteSubmit\" id=\"contactInfoDeleteSubmit\" value=\"-\"/>
                                </form>
                            </td>
                            <input hidden name=row_num form=\"$contact\" value=\"$contact\">
                            <input hidden name=row_num form=\"" . $contact . "Delete\" value=\"$contact\">
                            <td>
                                <input form=\"contact$contact\" class=\"btn btn-primary submit-button\" type=submit name=\"contactInfoUpdateSubmit\" id=\"contactInfoUpdateSubmit\" value=\"Update\"/>
                            </td>
                            </form>
                            </tr>";
                            };
                        };
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
