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
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody id="videoTable">
                        <?php
                        //Read the videos
                        $videoFile = fopen("data_files/videos.txt", "r");
                        $videoText = fread($videoFile, filesize("data_files/videos.txt"));
                        fclose($videoFile);

                        //Split the videos by row.
                        $videoArray = explode("\n", $videoText);
                        //Create a table row for each contact
                        for ($video = 0; $video <= sizeof($videoArray) - 1; $video++) {
                            $currentVideo = $videoArray[$video];

                            $currentVideoArray = explode("|", $currentVideo);

                            $videoTypesArray = array_keys($videoTypeConversion);

                            //Ignore empty lines
                            if ($currentVideo != "") {
                                //Create the start of the row, which is also a form.
                                echo "
                                    <tr>
                                    <form role='form' id=\"videos$video\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "' method=\"POST\">
                                    <td>
                                        <select form=\"videos$video\" class=\"form-control erasable-value\" name=\"videoType\">
                                            ";
                                for ($videoType = 0; $videoType <= sizeof($videoTypesArray) - 1; $videoType++) {
                                    if ($videoTypeConversion[$videoTypesArray[$videoType]] == $currentVideoArray[0]) {
                                        echo "<option selected>{$videoTypesArray[$videoType]}</option>";
                                    } else {
                                        echo "<option>{$videoTypesArray[$videoType]}</option>";
                                    };
                                }
                                echo "
                                        </select>
                                    </td>
                                    <td>
                                        <input form=\"videos$video\" name=\"videoURL\" class=\"erasable-value form-control\" value=\"$currentVideoArray[1]\" />
                                    </td>
                                    <td>
                                        <button type=\"button\" class=\"btn btn-success\" onclick=\"newRow('videoTable',$video);\">+</button>
                                        <form role='form' id=\"" . "videos" . $video . "Delete\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "' method=\"POST\">
                                        <input class=\"btn btn-danger\" type=submit name=\"videoDeleteSubmit\" id=\"videoDeleteSubmit\" value=\"-\"/>
                                        </form>
                                    </td>
                                    <input hidden name=row_num form=\"videos$video\" value=\"$video\">
                                    <input hidden name=row_num form=\"videos$video" . "Delete\" value=\"$video\">
                                    <td>
                                        <input form=\"videos$video\" class=\"btn btn-primary submit-button\" type=submit name=\"videoUpdateSubmit\" id=\"videoUpdateSubmit\" value=\"Update\"/>
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
