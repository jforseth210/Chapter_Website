<?php
//Form submission
if (isset($_POST['googleDriveEmbedSubmit'])) {
    $driveViewTypeConversion = array(
        "List View" => "#list",
        "Grid View" => "#grid"
    );
    $googleDriveEmbedCode = $_POST['googleDriveEmbedCode'];
    $viewType = $_POST['viewType'];
    $googleDriveEmbedCode = str_replace("https://drive.google.com/drive/folders/", "", $googleDriveEmbedCode);
    $googleDriveEmbedCode = str_replace("?usp=sharing", "", $googleDriveEmbedCode);
    $googleDriveFile = fopen("../data/googleDriveEmbedCode.txt", "w");
    $writeString = $googleDriveEmbedCode . "|" . $driveViewTypeConversion[$viewType];
    fwrite($googleDriveFile, $writeString);
    fclose($googleDriveFile);
}
?>
<section id="shared-files">
    <div class=container-fluid>
        <div class=row>
            <div class=col-lg-10>
                <h2>Shared Files</h2>
                <?php
                $driveViewTypeConversion = array(
                    "List View" => "#list",
                    "Grid View" => "#grid"
                );
                $googleDriveEmbedCodeFile = fopen("../data/googleDriveEmbedCode.txt", "r");
                $embedCode = fread($googleDriveEmbedCodeFile, filesize("../data/googleDriveEmbedCode.txt"));
                fclose($googleDriveEmbedCodeFile);
                $embedArray = explode("|", $embedCode);
                ?>
                <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "#shared-files"; ?>" method="POST">
                    <textarea class=form-control id="googleDriveEmbedCode" oninput="extractDriveFolderId();" name="googleDriveEmbedCode" style="height:200px"><?php echo "https://drive.google.com/drive/folders/" . $embedArray[0] . "?usp=sharing"; ?></textarea>
                    <?php
                    $driveViewsArray = array_keys($driveViewTypeConversion);
                    echo "
                    <select class=\"form-control\" name=\"viewType\">
                                            ";
                    for ($viewMode = 0; $viewMode <= sizeof($driveViewsArray) - 1; $viewMode++) {
                        if ($driveViewTypeConversion[$driveViewsArray[$viewMode]] == $embedArray[1]) {
                            echo "<option selected>{$driveViewsArray[$viewMode]}</option>";
                        } else {
                            echo "<option>{$driveViewsArray[$viewMode]}</option>";
                        };
                    }
                    echo "
                                        </select>"; ?>
                    <input class="btn btn-primary" name="googleDriveEmbedSubmit" type=submit value=Submit>
                </form>
            </div>
        </div>
    </div>
</section>
