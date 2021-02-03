<?php
//Form submissions
if (isset($_POST['resourceNewSubmit'])) {
    //Get resource information
    $resourceImageURL = $_POST['resourceImageURL'];
    $resourceName = $_POST['resourceName'];
    $resourceURL = $_POST['resourceURL'];
    $resourceBody = $_POST['resourceBody'];

    $resourceArray = array(
      "resource_image_url" => $resourceImageURL,
      "resource_name" => $resourceName,
      "resource_url" => $resourceURL,
      "resource_body" => $resourceBody
    );
    addNewRowJSON($resourceArray, "resources.json");
}

if (isset($_POST['resourceUpdateSubmit'])) {
    //Get the row number of the resource being modified
    $rowToUpdate = intVal($_POST['row_num']);
    //Get resource information
    $resourceImageURL = $_POST['resourceImageURL'];
    $resourceName = $_POST['resourceName'];
    $resourceURL = $_POST['resourceURL'];
    $resourceBody = $_POST['resourceBody'];

    $resourceArray = array(
      "resource_image_url" => $resourceImageURL,
      "resource_name" => $resourceName,
      "resource_url" => $resourceURL,
      "resource_body" => $resourceBody
    );

    updateRowJSON($rowToUpdate, $resourceArray, "resources.json");
}
if (isset($_POST['resourceDeleteSubmit'])) {
    //Get the row number of the resource being modified
    $rowToDelete = intVal($_POST['row_num']);

    deleteRowJSON($rowToDelete, "resources.json");
}
if (isset($_POST['resourceMoveSubmit'])) {
    //Get the row number of the resource being modified
    $rowToMove = intVal($_POST['row_num']);
    $direction = $_POST['direction'];
    arrayMoveUpDownJSON("resources.json", $rowToMove, $direction);
}
?>
<section id="resources">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2>Resources</h2>
                <b>Equally sized, landscape photos recommended, but not required.</b>
                <div id="resourceCards" class=row>
                    <?php
                    $resourceArray = readArrayFromJSON("resources.json");
                    //Create a table row for each contact
                    for ($resource = 0; $resource <= sizeof($resourceArray) - 1; $resource++) {
                        $currentResource = $resourceArray[$resource];
                        //Create the start of the row, which is also a form.
                        echo "
                            <div class=\"col-md-4 d-flex\">
                                <div class=\"card mx-auto w-100 my-5 d-flex zoom\">
                                        <img class=\"card-img-top\" src=\"{$currentResource["resource_image_url"]}\">
                                        <br />
                                        <div class=\"card-body\">
                                        <form role='form' id=\"resources$resource\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#resources" . "' method=\"POST\">
                                            <h3><input form=\"resources$resource\" name=\"resourceImageURL\" class=\"erasable-value form-control\" value=\"{$currentResource["resource_image_url"]}\" placeholder=\"Image URL\"/></h3>
                                            <h5><input form=\"resources$resource\" name=\"resourceName\" class=\"erasable-value form-control\" value=\"{$currentResource["resource_name"]}\" placeholder=\"Name\" /></h5>
                                            <h5><input form=\"resources$resource\" name=\"resourceURL\" class=\"erasable-value form-control\" value=\"{$currentResource["resource_url"]}\" placeholder=\"Resource URL\" /></h5>
                                            <textArea form=\"resources$resource\" style=\"height:200px !important\"name=\"resourceBody\" class=\"erasable-value form-control\" placeholder=\"Description\">" . $currentResource["resource_body"] . "</textarea>

                                            <br />
                                            <input hidden name=row_num form=\"resources$resource\" value=\"$resource\">
                                            <input hidden name=row_num form=\"resources$resource" . "Delete\" value=\"$resource\">
                                            <input hidden name=row_num form=\"resources" . $resource . "MoveUp\" value=\"$resource\">
                                            <input hidden name=row_num form=\"resources" . $resource . "MoveDown\" value=\"$resource\">

                                            <div role=\"group\" class=\"btn-group mx-auto mt-auto\">
                                                <form role='form' id=\"" . "resources" . $resource . "Delete\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#resources" . "' method=\" POST\">
                                                    <input class=\"new-disable btn btn-danger mx-auto\" type=submit name=\"resourceDeleteSubmit\" value=\"Delete\" />
                                                </form>
                                                <input form=\"resources$resource\" class=\"btn btn-primary submit-button mx-auto\" type=submit name=\"resourceUpdateSubmit\" value=\"Save\" />
                                                <button type=\"button\" class=\"new-disable btn btn-success mx-auto\" onclick=\"newRow('resourceCards',$resource);\">New</button>
                                            </div>

                                            <form style=\"display:inline;\" role='form' id=\"resources" . $resource . "MoveUp\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#resources" . "' method=\"POST\">
                                              <button class=\"new-disable btn btn-secondary\" type=submit name=\"resourceMoveSubmit\">
                                                Move Up
                                              </button>
                                              <input hidden name=\"direction\" value=\"up\"/>
                                            </form>

                                            <form class=mx-0 style=\"display:inline;\" role='form' id=\"resources" . $resource . "MoveDown\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#resources" . "' method=\"POST\">
                                              <button class=\"new-disable btn btn-secondary \" type=submit name=\"resourceMoveSubmit\">
                                                Move Down
                                              </button>
                                              <input hidden name=\"direction\" value=\"down\"/>
                                            </form>
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
