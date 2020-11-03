<section id="officers">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2>Officers</h2>
                <b>Equally sized, landscape photos recommended, but not required.</b> 
                <div id="officerCards" class=row>
                    <?php
                    //Read the officers
                    $officerFile = fopen("data_files/officers.txt", "r");
                    $officerText = fread($officerFile, filesize("data_files/officers.txt"));
                    fclose($officerFile);

                    //Split the officers by row.
                    $officerArray = explode("\n", $officerText);
                    //Create a table row for each contact
                    for ($officer = 0; $officer <= sizeof($officerArray) - 1; $officer++) {
                        $currentOfficer = $officerArray[$officer];

                        $currentOfficerArray = explode("|", $currentOfficer);


                        //Ignore empty lines
                        if ($currentOfficer != "") {
                            //Create the start of the row, which is also a form.
                            echo "
                                <div class=\"col-md-4 d-flex\">
                                    <div class=\"card mx-auto w-100 my-5 d-flex zoom\">
                                            <img class=\"card-img-top\" src=\"images/officers/$currentOfficerArray[1].$currentOfficerArray[0]\">
                                            <form role='form' id=\"officers$officer" . "imagechange" . "\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "' method=\"POST\" enctype=\"multipart/form-data\">
                                            <div class=\"custom-file\">
                                                <input type=\"file\" name=\"officerImage\" class=\"form-control-file\" id=\"customFile\">
                                                <label class=\"custom-file-label\" for=\"customFile\">Choose file</label>
                                            </div>
                                            
                                            <input hidden name=row_num form=\"officers$officer" . "imagechange" . "\" value=\"$officer\">
                                            <input name=\"officerImageSubmit\" type=\"submit\" value=\"Upload New Picture\" class=\"btn btn-primary w-100\"/>
                                            </form>
                                            <br />
                                            <div class=\"card-body\">
                                            <form role='form' id=\"officers$officer\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "' method=\"POST\">
                                                <h3><input form=\"officers$officer\" name=\"officerTitle\" class=\"erasable-value form-control\" value=\"$currentOfficerArray[1]\" /></h3>
                                                <h5><input form=\"officers$officer\" name=\"officerName\" class=\"erasable-value form-control\" value=\"$currentOfficerArray[2]\" /></h5>
                                
                                                <textArea form=\"officers$officer\" style=\"height:200px !important\"name=\"officerBio\" class=\"erasable-value form-control\">" . str_replace("NEWLINE", "\n", str_replace("VERTICALSEPARATOR", "|", $currentOfficerArray[3])) . "</textarea>
                                
                                                <br />
                                                <input hidden name=row_num form=\"officers$officer\" value=\"$officer\">
                                                <input hidden name=row_num form=\"officers$officer" . "Delete\" value=\"$officer\">
                                                <div class=\"mt-auto\">
                                                <div role=\"group\" class=\"btn-group mx-auto mt-auto\">
                                                    <form role='form' id=\"" . "officers" . $officer . "Delete\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "' method=\" POST\">
                                                        <input class=\"btn btn-danger mx-auto\" type=submit name=\"officerDeleteSubmit\" id=\"officerDeleteSubmit\" value=\"Delete\" />
                                                    </form>
                                                    <input form=\"officers$officer\" class=\"btn btn-primary submit-button mx-auto\" type=submit name=\"officerUpdateSubmit\" id=\"officerUpdateSubmit\" value=\"Update Profile\" />
                                                    <button type=\"button\" class=\"btn btn-success mx-auto\" onclick=\"newRow('officerCards',$officer);\">New</button>
                                                </div>
                                            </div>
                                            </div>
                                            <p></p>
                                        </form>
                                    </div>
                                </div>
                                ";
                        };
                    };
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
