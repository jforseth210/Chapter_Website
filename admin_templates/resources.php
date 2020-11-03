<section id="resources">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2>Resources</h2>
                <b>Equally sized, landscape photos recommended, but not required.</b> 
                <div id="resourceCards" class=row>
                    <?php
                    //Read the resources
                    $resourceFile = fopen("data_files/resources.txt", "r");
                    $resourceText = fread($resourceFile, filesize("data_files/resources.txt"));
                    fclose($resourceFile);

                    //Split the resources by row.
                    $resourceArray = explode("\n", $resourceText);
                    //Create a table row for each contact
                    for ($resource = 0; $resource <= sizeof($resourceArray) - 1; $resource++) {
                        $currentresource = $resourceArray[$resource];

                        $currentresourceArray = explode("|", $currentresource);


                        //Ignore empty lines
                        if ($currentresource != "") {
                            //Create the start of the row, which is also a form.
                            echo "
                                <div class=\"col-md-4 d-flex\">
                                    <div class=\"card mx-auto w-100 my-5 d-flex zoom\">
                                            <img class=\"card-img-top\" src=\"$currentresourceArray[0]\">
                                            <br />
                                            <div class=\"card-body\">
                                            <form role='form' id=\"resources$resource\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "' method=\"POST\">
                                                <h3><input form=\"resources$resource\" name=\"resourceImageURL\" class=\"erasable-value form-control\" value=\"$currentresourceArray[0]\" /></h3>
                                                <h5><input form=\"resources$resource\" name=\"resourceName\" class=\"erasable-value form-control\" value=\"$currentresourceArray[1]\" /></h5>
                                                <h5><input form=\"resources$resource\" name=\"resourceURL\" class=\"erasable-value form-control\" value=\"$currentresourceArray[2]\" /></h5>
                                                <textArea form=\"resources$resource\" style=\"height:200px !important\"name=\"resourceBody\" class=\"erasable-value form-control\">" . str_replace("NEWLINE", "\n", str_replace("VERTICALSEPARATOR", "|", $currentresourceArray[3])) . "</textarea>
                                
                                                <br />
                                                <input hidden name=row_num form=\"resources$resource\" value=\"$resource\">
                                                <input hidden name=row_num form=\"resources$resource" . "Delete\" value=\"$resource\">
                                
                                                <div role=\"group\" class=\"btn-group mx-auto mt-auto\">
                                                    <form role='form' id=\"" . "resources" . $resource . "Delete\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "' method=\" POST\">
                                                        <input class=\"btn btn-danger mx-auto\" type=submit name=\"resourceDeleteSubmit\" id=\"resourceDeleteSubmit\" value=\"Delete\" />
                                                    </form>
                                                    <input form=\"resources$resource\" class=\"btn btn-primary submit-button mx-auto\" type=submit name=\"resourceUpdateSubmit\" id=\"resourceUpdateSubmit\" value=\"Update Resource\" />
                                                    <button type=\"button\" class=\"btn btn-success mx-auto\" onclick=\"newRow('resourceCards',$resource);\">New</button>
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
