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
if (isset($_POST['resourceCardsReorderSubmit'])) {
    $old_index = intVal($_POST['old_index']);
    $new_index = $_POST['new_index'];
    reorderArrayJSON("resources.json", $old_index, $new_index);
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
                                        <form role='form' id=\"resources$resource\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#resources" . "' method=\"POST\">
                                        </form>
                                            <h3><input form=\"resources$resource\" name=\"resourceImageURL\" class=\"erasable-value form-control\" value=\"{$currentResource["resource_image_url"]}\" placeholder=\"Image URL\"/></h3>
                                            <h5><input form=\"resources$resource\" name=\"resourceName\" class=\"erasable-value form-control\" value=\"{$currentResource["resource_name"]}\" placeholder=\"Name\" /></h5>
                                            <h5><input form=\"resources$resource\" name=\"resourceURL\" class=\"erasable-value form-control\" value=\"{$currentResource["resource_url"]}\" placeholder=\"Resource URL\" /></h5>
                                            <textArea form=\"resources$resource\" style=\"min-height:100px !important\"name=\"resourceBody\" class=\"h-100 erasable-value form-control\" placeholder=\"Description\">" . $currentResource["resource_body"] . "</textarea>
                                            <input hidden name=row_num form=\"resources$resource\" value=\"$resource\">
                                            <input hidden name=row_num form=\"resources$resource" . "Delete\" value=\"$resource\">

                                            <form role='form' id=\"" . "resources" . $resource . "Delete\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#resources" . "' method=\" POST\">
                                            </form>
                                            <div role=\"group\" class=\"w-100 btn-group mx-auto mt-auto\">
                                                <input form=\"" . "resources" . $resource . "Delete\" class=\"new-disable btn btn-danger mx-auto\" type=submit name=\"resourceDeleteSubmit\" value=\"Delete\" />
                                                <input form=\"resources$resource\" class=\"btn btn-primary submit-button mx-auto\" type=submit name=\"resourceUpdateSubmit\" value=\"Save\" />
                                                <button type=\"button\" class=\"new-disable btn btn-success mx-auto\" onclick=\"newRow('resourceCards',$resource);\">New</button>
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
