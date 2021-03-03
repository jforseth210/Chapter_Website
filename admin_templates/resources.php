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
    echoToAlert($resourceName . "added successfully");
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
    echoToAlert($resourceName . "updated successfully");
}
if (isset($_POST['resourceDeleteSubmit'])) {
    //Get the row number of the resource being modified
    $rowToDelete = intVal($_POST['row_num']);
    echoToAlert("Resource deleted successfully");
    deleteRowJSON($rowToDelete, "resources.json");
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
                    ?>
                        <div class="col-md-4 d-flex">
                            <div class="card mx-auto w-100 my-5 d-flex zoom">
                                <img class="card-img-top" src="<?php echo $currentResource["resource_image_url"];?>">
                                <form role='form' id="resources<?php echo $resource;?>" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>#resources' method=" POST">
                                </form>
                                <h3><input form="resources<?php echo $resource;?>" name="resourceImageURL" class="erasable-value form-control" value="<?php echo $currentResource["resource_image_url"]; ?> " placeholder="Image URL" /></h3>
                                <h5><input form="resources<?php echo $resource;?>" name="resourceName" class="erasable-value form-control" value="<?php echo $currentResource["resource_name"]; ?> " placeholder="Name" /></h5>
                                <h5><input form="resources<?php echo $resource;?>" name="resourceURL" class="erasable-value form-control" value="<?php echo $currentResource["resource_url"]; ?> " placeholder="Resource URL" /></h5>
                            <textArea form="resources<?php echo $resource;?>" style="min-height:100px !important"name="resourceBody" class="h-100 erasable-value form-control" placeholder="Description"><?php echo $currentResource["resource_body"];?></textarea>
                                <input hidden name=row_num form="resources<?php echo $resource;?>" value="<?php echo $resource;?>">
                                <input hidden name=row_num form="resources<?php echo $resource;?>Delete" value="<?php echo $resource;?>">

                                <form role='form' id="resources<?php echo $resource;?>Delete" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>#resources' method=" POST">
                                </form>
                                <div role="group" class="w-100 btn-group mx-auto mt-auto">
                                    <input form="resources<?php echo $resource;?>Delete" class="new-disable btn btn-danger mx-auto" type=submit name="resourceDeleteSubmit" value="Delete" />
                                    <input form="resources<?php echo $resource;?>" class="btn btn-primary submit-button mx-auto" type=submit name="resourceUpdateSubmit" value="Save" />
                                    <button type="button" class="new-disable btn btn-success mx-auto" onclick="newRow('resourceCards',<?php echo $resource;?>);">New</button>
                                </div>

                            </div>
                        </div>
                    <?php
                    };
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>