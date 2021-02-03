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
        "video_type"=>$videoType,
        "video_url"=>$videoURL
    );

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
        "video_type"=>$videoType,
        "video_url"=>$videoURL
    );

    updateRowJSON($rowToUpdate, $videoArray, "videos.json");
}

if (isset($_POST['videoDeleteSubmit'])) {
    //Get the row number of the video being modified
    $rowToDelete = intVal($_POST['row_num']);

    deleteRowJSON($rowToDelete, "videos.json");
}
if (isset($_POST['videoMoveSubmit'])) {
    //Get the row number of the video being modified
    $rowToMove = intVal($_POST['row_num']);
    $direction = $_POST['direction'];
    arrayMoveUpDownJSON("videos.json", $rowToMove, $direction);
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
                            echo "
                                <tr>
                                    <form role='form' id=\"videos$video\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#videos" . "' method=\"POST\">
                                        <td>
                                            <select form=\"videos$video\" class=\"form-control erasable-value\" name=\"videoType\">
                            ";
                                            for ($videoType = 0; $videoType <= sizeof($videoTypesArray) - 1; $videoType++) {
                                                if ($videoTypeConversion[$videoTypesArray[$videoType]] == $currentVideoArray['video_type']) {
                                                    echo "<option selected>{$videoTypesArray[$videoType]}</option>";
                                                } else {
                                                    echo "<option>{$videoTypesArray[$videoType]}</option>";
                                                };
                                            };
                            echo "
                                            </select>
                                        </td>
                                    <td>
                                        <input form=\"videos$video\" name=\"videoURL\" class=\"erasable-value form-control\" value=\"{$currentVideoArray['video_url']}\" />
                                    </td>
                                    <td>
                                        <button type=\"button\" class=\"new-disable btn btn-success\" onclick=\"newRow('videoTable',$video);\">+</button>
                                        <form role='form' id=\"" . "videos" . $video . "Delete\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#videos" . "' method=\"POST\">
                                            <input class=\"new-disable btn btn-danger\" type=submit name=\"videoDeleteSubmit\" value=\"-\"/>
                                        </form>
                                    </td>
                                    <td width=\"120px\">
                                      <form style=\"width:45px !important; display:inline;\" role='form' id=\"videos" . $video . "MoveUp\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#videos" . "' method=\"POST\">
                                        <button class=\"new-disable btn btn-secondary\" type=submit name=\"videoMoveSubmit\">
                                          <svg width=\"1em\" height=\"1em\" viewBox=\"0 0 16 16\" class=\"bi bi-arrow-up\" fill=\"currentColor\" xmlns=\"http://www.w3.org/2000/svg\">
                                          <path fill-rule=\"evenodd\" d=\"M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z\"/>
                                          </svg>
                                        </button>
                                        <input hidden name=\"direction\" value=\"up\"/>
                                      </form>

                                      <form class=mx-0 style=\"width:45px !important; display:inline;\" role='form' id=\"videos" . $video . "MoveDown\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "#videos" . "' method=\"POST\">
                                        <button class=\"new-disable btn btn-secondary \" type=submit name=\"videoMoveSubmit\" >
                                        <svg width=\"1em\" height=\"1em\" viewBox=\"0 0 16 16\" class=\"bi bi-arrow-down\" fill=\"currentColor\" xmlns=\"http://www.w3.org/2000/svg\">
                                          <path fill-rule=\"evenodd\" d=\"M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z\"/>
                                        </svg>
                                        </button>
                                        <input hidden name=\"direction\" value=\"down\"/>
                                      </form>
                                    </td>
                                    <input hidden name=row_num form=\"videos$video\" value=\"$video\">
                                    <input hidden name=row_num form=\"videos$video" . "Delete\" value=\"$video\">
                                    <input hidden name=row_num form=\"videos" . $video . "MoveUp\" value=\"$video\">
                                    <input hidden name=row_num form=\"videos" . $video . "MoveDown\" value=\"$video\">
                                    <td>
                                        <input form=\"videos$video\" class=\"btn btn-primary submit-button\" type=submit name=\"videoUpdateSubmit\" value=\"Save\"/>
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
