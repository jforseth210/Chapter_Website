<?php
//Add players and their embed codes here.
$videoTypeConversion = array(
    "Youtube" => "<div class='youtube-player' data-id='VIDEO_ID'></div>",
    "Google Drive" => "<iframe height='100%' width='100%' src='VIDEO_ID' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>"
);

//Form logic
if (isset($_POST['videoNewSubmit'])) {
    //Get video information
    $videoType = $_POST['videoType'];
    $videoURL = $_POST['videoURL'];
    //Convert human-readable to proper href
    //Ex: Phone Number => tel:
    $videoType = $videoTypeConversion[$videoType];
    //Prevent https://https:// if user enters it.
    //$videoInfo = str_replace("https://www.youtube.com/watch?v=", "", $videoInfo);
    //$videoInfo = str_replace("https://youtu.be/", "", $videoInfo);

    $videoArray = array(
        "video_type" => $videoType,
        "video_url" => $videoURL
    );

    echoToAlert("Video added sucessfully");
    addNewRowJSON($videoArray, "videos.json");
}

if (isset($_POST['videoUpdateSubmit'])) {
    //Get the row number of the video being modified
    $rowToUpdate = intVal($_POST['row_num']);
    //Get video information
    $videoType = $_POST['videoType'];
    $videoURL = $_POST['videoURL'];
    //Convert human-readable to proper href
    //Ex: Phone Number => tel:
    $videoType = $videoTypeConversion[$videoType];
    //Prevent https://https:// if user enters it.
    //$videoURL = str_replace("https://", "", $video);

    $videoArray = array(
        "video_type" => $videoType,
        "video_url" => $videoURL
    );

    echoToAlert("Video updated sucessfully");
    updateRowJSON($rowToUpdate, $videoArray, "videos.json");
}

if (isset($_POST['videoDeleteSubmit'])) {
    //Get the row number of the video being modified
    $rowToDelete = intVal($_POST['row_num']);

    echoToAlert("Video deleted sucessfully");
    deleteRowJSON($rowToDelete, "videos.json");
}
if (isset($_POST['videoMoveSubmit'])) {
    //Get the row number of the video being modified
    $rowToMove = intVal($_POST['row_num']);
    $direction = $_POST['direction'];
    arrayMoveUpDownJSON("videos.json", $rowToMove, $direction);
}
if (isset($_POST['videoTableReorderSubmit'])) {
    $old_index = intVal($_POST['old_index']);
    $new_index = $_POST['new_index'];
    reorderArrayJSON("videos.json", $old_index, $new_index);
}
?>
<section id="videos">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <h2>Chapter Videos</h2>
                <div class="d-xs-inline  d-sm-none"><small class="">The table may not display correctly on small screens. Please flip to landscape mode or use a larger device.</small></div>
                <table class=table>
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Link</th>
                            <th>Add/Remove</th>
                            <th>Reorder</th>
                            <th>Save</th>
                        </tr>
                    </thead>
                    <tbody id="videoTable">
                        <?php
                        //Read the videos
                        $videoArray = array();
                        $videoArray = readArrayFromJSON("videos.json");

                        //Create a table row for each video
                        for ($video = 0; $video <= sizeof($videoArray) - 1; $video++) {
                            $currentVideoArray = $videoArray[$video];

                            $videoTypesArray = array_keys($videoTypeConversion);

                            //Create the start of the row, which is also a form.
                        ?>
                            <tr>
                                <form role='form' id="videos<?php echo $video; ?>" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>#videos' method="POST">
                                    <td>
                                        <select form="videos<?php echo $video; ?>" class="form-control erasable-value" name="videoType">
                                            <?php
                                            for ($videoType = 0; $videoType <= sizeof($videoTypesArray) - 1; $videoType++) {
                                                if ($videoTypeConversion[$videoTypesArray[$videoType]] == $currentVideoArray['video_type']) {
                                            ?>
                                                    <option selected><?php echo $videoTypesArray[$videoType]; ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option><?php echo $videoTypesArray[$videoType]; ?></option>
                                            <?php
                                                };
                                            };
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input form="videos<?php echo $video; ?>" name="videoURL" class="erasable-value form-control" value="<?php echo $currentVideoArray['video_url']; ?>" />
                                    </td>
                                    <td>
                                        <button type="button" class="new-disable btn btn-success" onclick="newRow('videoTable',<?php echo $video; ?>);">+</button>
                                        <form role='form' id="videos" . <?php echo $video; ?>Delete" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>#videos' method="POST">
                                            <input class="new-disable btn btn-danger" type=submit name="videoDeleteSubmit" value="-" />
                                        </form>
                                    </td>
                                    <td width="120px">
                                        <div class="btn btn-secondary handle">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-move" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 1.707V5.5a.5.5 0 0 1-1 0V1.707L6.354 2.854a.5.5 0 1 1-.708-.708l2-2zM8 10a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 14.293V10.5A.5.5 0 0 1 8 10zM.146 8.354a.5.5 0 0 1 0-.708l2-2a.5.5 0 1 1 .708.708L1.707 7.5H5.5a.5.5 0 0 1 0 1H1.707l1.147 1.146a.5.5 0 0 1-.708.708l-2-2zM10 8a.5.5 0 0 1 .5-.5h3.793l-1.147-1.146a.5.5 0 0 1 .708-.708l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L14.293 8.5H10.5A.5.5 0 0 1 10 8z" />
                                            </svg>
                                        </div>
                                    </td>
                                    <input hidden name=row_num form="videos<?php echo $video; ?>" value="<?php echo $video; ?>">
                                    <input hidden name=row_num form="videos<?php echo $video; ?>Delete" value="<?php echo $video; ?>">
                                    <input hidden name=row_num form="videos" . <?php echo $video; ?>MoveUp" value="<?php echo $video; ?>">
                                    <input hidden name=row_num form="videos" . <?php echo $video; ?>MoveDown" value="<?php echo $video; ?>">
                                    <td>
                                        <input form="videos<?php echo $video; ?>" class="btn btn-primary submit-button" type=submit name="videoUpdateSubmit" value="Save" />
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