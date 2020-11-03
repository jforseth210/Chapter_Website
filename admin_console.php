<?php
session_start();
?>
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Maintainer Tools</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/scrolling-nav.css" rel="stylesheet">
    <!--Swiper CSS for photo gallery-->
    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.0/css/swiper.min.css" rel="stylesheet">-->
    <link rel="shortcut icon" href="images/emblem_favicon.png" type="image/x-icon">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Matomo -->
    <script type="text/javascript">
        var _paq = window._paq = window._paq || [];
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
        _paq.push(["setCookieDomain", "*.fairfieldffa.org"]);
        _paq.push(["setDomains", ["*.fairfieldffa.org"]]);
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u = "//jforseth.tech/matomo/";
            _paq.push(['setTrackerUrl', u + 'matomo.php']);
            _paq.push(['setSiteId', '2']);
            var d = document,
                g = d.createElement('script'),
                s = d.getElementsByTagName('script')[0];
            g.type = 'text/javascript';
            g.async = true;
            g.src = u + 'matomo.js';
            s.parentNode.insertBefore(g, s);
        })();
    </script>
    <!-- End Matomo Code -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <?php
    //If the user isn't logged in, 
    //send them back to the login page.
    //I'm pretty sure this server-side, 
    //but if it's not, it may be bypassable, 
    //resulting in unathorized admin access. 
    //That would be bad. 
    if (!$_SESSION['valid']) {
        header("Location: https://fairfieldffa.org/login.php");
        exit();
    };
    ?>
    <?php
    if (isset($_POST['aboutUsSubmit'])) {
        $aboutUsText = $_POST['aboutUsBodyText'];
        $aboutFile = fopen("data_files/aboutUsText.txt", "w");
        fwrite($aboutFile, $aboutUsText);
        fclose($aboutFile);
    }
    /*
    Echo a message to the user in a banner
    alert at the top of the screen.
    */
    function echoToAlert($message){
        //TODO
    }
    
    /*
    Echo a message into the JS developer
    console using a <script> tag
    */
    function echoToConsole($message){
        echo "<script>console.log(\"$message\");</script>";
    }
    ?>
    

    <nav class="navbar navbar-expand-lg navbar-dark bg-ffablue fixed-top" id="mainNav">
        <div class="container">
            <img src="images/emblem.png" class="mx-1" style="height:32px"></img>
            <a class="navbar-brand js-scroll-trigger" href="#page-top">Fairfield FFA</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#resources">Resources</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#shared-files">Shared Files</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#officers">Officers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#videos">Videos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#photos">Photos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#calendar">Calendar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="bg-ffablue text-white">
        <div class="container text-center">
            <h1>Administrator Tools</h1>
            <p class="lead">Tools to make updating and maintaining fairfieldffa.org a little easier.</p>
        </div>
    </header>

    <section id="about">
        <div class=container-fluid>
            <div class=row>
                <div class=col-lg-10>
                    <h2>About Fairfield FFA</h2>
                    <?php
                    $aboutFile = fopen("data_files/aboutUsText.txt", "r");
                    $aboutUsText = fread($aboutFile, filesize("data_files/aboutUsText.txt"));
                    fclose($aboutFile);
                    ?>
                    <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <textarea class=form-control name="aboutUsBodyText" style="height:400px"><?php echo $aboutUsText; ?></textarea>
                        <input class="btn btn-primary" name="aboutUsSubmit" type=submit value=Submit>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section id="shared-files">
        <div class=container-fluid>
            <div class=row>
                <div class=col-lg-10>
                    <h2>Shared Files</h2>
                    <?php
                    $googleDriveEmbedCodeFile = fopen("data_files/googleDriveEmbedCode.txt", "r");
                    $embedCode = fread($googleDriveEmbedCodeFile, filesize("data_files/googleDriveEmbedCode.txt"));
                    fclose($googleDriveEmbedCodeFile);
                    $embedArray = explode("|", $embedCode);
                    ?>
                    <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <textarea class=form-control id="googleDriveEmbedCode" oninput="extractDriveFolderId();" name="googleDriveEmbedCode" style="height:200px"><?php echo "https://drive.google.com/drive/folders/" . $embedArray[0] . "?usp=sharing"; ?></textarea>
                        <?php
                        echoToConsole("Message1");
                        echoToConsole("Message2");
                        $driveViewTypeConversion = array(
                            "List View" => "#list",
                            "Grid View" => "#grid"
                        );
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
    <?php
    if (isset($_POST['calendarEmbedSubmit'])) {
        $calendarEmbedCode = $_POST['calendarEmbedCode'];
        $aboutFile = fopen("data_files/calendarEmbedCode.txt", "w");
        fwrite($aboutFile, $calendarEmbedCode);
        fclose($aboutFile);
    }
    if (isset($_POST['googleDriveEmbedSubmit'])) {
        $googleDriveEmbedCode = $_POST['googleDriveEmbedCode'];
        $viewType = $_POST['viewType'];
        $googleDriveEmbedCode = str_replace("https://drive.google.com/drive/folders/", "", $googleDriveEmbedCode);
        $googleDriveEmbedCode = str_replace("?usp=sharing", "", $googleDriveEmbedCode);
        $googleDriveFile = fopen("data_files/googleDriveEmbedCode.txt", "w");
        $writeString = $googleDriveEmbedCode . "|" . $driveViewTypeConversion[$viewType];
        fwrite($googleDriveFile, $writeString);
        fclose($googleDriveFile);
    }
    function deleteRow($rowToDelete, $filename)
    {
        //Read original file
        $readFile = fopen("data_files/" . $filename, "r");
        $readText = fread($readFile, filesize("data_files/" . $filename));
        fclose($readFile);
        //Split file by line
        $readArray = explode("\n", $readText);
        //Open the file for writing
        $writeFile = fopen("data_files/" . $filename, "w");
        $writeString = "";
        //Iterate through the rows, update the one the that the user modified.
        for ($row = 0; $row <= sizeof($readArray) - 1; $row++) {
            if ($row != $rowToDelete) {
                $writeString = $writeString . $readArray[$row] . "\n";
            }
        }

        //If this line is uncommented, the final line
        //becomes truncated intermittently. 
        //If it is commented, the file will grow in size
        //on every update. 

        //$fwstring = str_replace("\n\n", "\n", $fwstring);

        //Write and close the file.
        fwrite($writeFile, $writeString);
        fclose($writeFile);
    }

    function updateRow($rowToUpdate, $newString, $filename)
    {
        //Read original file
        $readFile = fopen("data_files/" . $filename, "r");
        $readText = fread($readFile, filesize("data_files/" . $filename));
        fclose($readFile);
        //Split file by line
        $readArray = explode("\n", $readText);
        //Open the file for writing
        $writeFile = fopen("data_files/" . $filename, "w");
        $writeString = "";
        //Iterate through the rows, update the one the that the user modified.
        for ($row = 0; $row <= sizeof($readArray) - 1; $row++) {
            if ($row == $rowToUpdate) {
                $writeString = $writeString . $newString . "\n";
            } else {
                $writeString = $writeString . $readArray[$row] . "\n";
            }
        }

        //If this line is uncommented, the final line
        //becomes truncated intermittently. 
        //If it is commented, the file will grow in size
        //on every update. 

        $writeString = str_replace("\n\n", "\n", $writeString);

        //Write and close the file.
        fwrite($writeFile, $writeString);
        fclose($writeFile);
    }

    function addNewRow($stringToAdd, $filename)
    {
        $appendFile = fopen("data_files/" . $filename, "a");
        fwrite($appendFile, $stringToAdd . "\n");
        fclose($appendFile);
    }

    $contactTypeConversion = array(
        "Phone Number" => "tel:",
        "Email" => "mailto:",
        "Link" => "https://",
        "Fax" => "fax:"
    );
    $videoTypeConversion = array(
        "Youtube" => "<div class='youtube-player' data-id='VIDEO_ID'></div>",
        "Google Drive" => "<iframe height='100%' width='100%' src='VIDEO_ID' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>"
    );
    if (isset($_POST['officerNewSubmit'])) {
        //Get officer information
        $officerTitle = $_POST['officerTitle'];
        $officerName = $_POST['officerName'];
        $officerBio = $_POST['officerBio'];

        $officerBio = str_replace("\n", "NEWLINE", $officerBio);
        $officerBio = str_replace("|", "VERTICALSEPARATOR", $officerBio);

        $officerFile = fopen("data_files/officers.txt", "a");
        $officerString = "IMAGEPLACEHOLDER|" . $officerTitle . "|" . $officerName . "|" . $officerBio;

        addNewRow($officerString, "officers.txt");
    }

    if (isset($_POST['officerUpdateSubmit'])) {
        //Get the row number of the officer being modified
        $rowToUpdate = intVal($_POST['row_num']);
        //Get officer information
        $officerTitle = $_POST['officerTitle'];
        $officerName = $_POST['officerName'];
        $officerBio = $_POST['officerBio'];
        
        $officerBio = str_replace("\n", "NEWLINE", $officerBio);
        $officerBio = str_replace("|", "VERTICALSEPARATOR", $officerBio);
        
        //The update form doesn't know the file extension, 
        //so we have to read it before we overwrite
        $readFile = fopen("data_files/officers.txt", "r");
        $readText = fread($readFile, filesize("data_files/officers.txt"));
        fclose($readFile);
        //Split file by line
        $readArray = explode("\n", $readText);
        echo $readText;
        $imageExtension = explode("|", $readArray[$rowToUpdate])[0];
        
        $oldOfficerTitle = explode("|", $readArray[$rowToUpdate])[1];
        rename("images/officers/" . $oldOfficerTitle . "." . $imageExtension, "images/officers/" . $officerTitle . "." . $imageExtension);
        
        $writeString = $imageExtension . "|" . $officerTitle . "|" . $officerName . "|" . $officerBio;

        updateRow($rowToUpdate, $writeString, "officers.txt");
    }

    if (isset($_POST['officerDeleteSubmit'])) {
        //Get the row number of the officer being modified
        $rowToDelete = intVal($_POST['row_num']);

        deleteRow($rowToDelete, "officers.txt");
    }
    if (isset($_POST["officerImageSubmit"])){
        $officerImage = $_FILES['officerImage'];
        $rowToRead = intVal($_POST['row_num']);
        $rows = file("data_files/officers.txt");
        $officerRow = $rows[$rowToRead];
        $officerArray = explode("|",$officerRow);
        $nameOfOffice = $officerArray[1];
        
        $target_dir = "images/officers/";
        
        $imageFileType = strtolower(pathinfo($officerImage["name"], PATHINFO_EXTENSION));
        //Save as nameOfOffice.fileExtension
        $target_file = $target_dir . basename($nameOfOffice . "." . $imageFileType);
        $uploadOk = 1;
        echo $target_file;
        
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($officerImage["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
        }
        }
        // Check file size
        /*if ($officerImage["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        }*/

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($officerImage["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $officerImage["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        }
        
        $officerArray[0] = $imageFileType;
        $officerString = implode("|",$officerArray);
        updateRow($rowToRead, $officerString, "officers.txt");
        
    }
    
    if (isset($_POST['videoNewSubmit'])) {
        //Get video information
        $videoType = $_POST['videoType'];
        $videoInfo = $_POST['videoURL'];
        //Convert human-readable to proper href
        //Ex: Phone Number => tel:
        $videoType = $videoTypeConversion[$videoType];
        //Prevent https://https:// if user enters it. 
        //$videoInfo = str_replace("https://www.youtube.com/watch?v=", "", $videoInfo);
        //$videoInfo = str_replace("https://youtu.be/", "", $videoInfo);

        $videoString = $videoType . "|" . $videoInfo;

        addNewRow($videoString, "videos.txt");
    }

    if (isset($_POST['videoUpdateSubmit'])) {
        //Get the row number of the contact being modified
        $rowToUpdate = intVal($_POST['row_num']);
        //Get contact information
        $videoType = $_POST['videoType'];
        $videoURL = $_POST['videoURL'];
        //Convert human-readable to proper href
        //Ex: Phone Number => tel:
        $videoType = $videoTypeConversion[$videoType];
        //Prevent https://https:// if user enters it. 
        //$videoURL = str_replace("https://", "", $contactInfo);

        $videoString =  $videoType . "|" . $videoURL;

        updateRow($rowToUpdate, $videoString, "videos.txt");
    }

    if (isset($_POST['videoDeleteSubmit'])) {
        //Get the row number of the contact being modified
        $rowToDelete = intVal($_POST['row_num']);

        deleteRow($rowToDelete, "videos.txt");
    }

    if (isset($_POST['contactInfoNewSubmit'])) {
        //Get contact information
        $contactName = $_POST['contactName'];
        $contactType = $_POST['contactType'];
        $contactInfo = $_POST['contactInfo'];
        //Convert human-readable to proper href
        //Ex: Phone Number => tel:
        $contactType = $contactTypeConversion[$contactType];
        //Prevent https://https:// if user enters it. 
        $contactInfo = str_replace("https://", "", $contactInfo);

        $contactFile = fopen("data_files/contactInfoText.txt", "a");
        $contactString = $contactName . "|" . $contactType . "|" . $contactInfo;

        addNewRow($contactString, "contactInfoText.txt");
    }

    if (isset($_POST['contactInfoUpdateSubmit'])) {
        //Get the row number of the contact being modified
        $rowToUpdate = intVal($_POST['row_num']);
        //Get contact information
        $contactName = $_POST['contactName'];
        $contactType = $_POST['contactType'];
        $contactInfo = $_POST['contactInfo'];
        //Convert human-readable to proper href
        //Ex: Phone Number => tel:
        $contactType = $contactTypeConversion[$contactType];
        //Prevent https://https:// if user enters it. 
        $contactInfo = str_replace("https://", "", $contactInfo);

        $writeString = $contactName . "|" . $contactType . "|" . $contactInfo;

        updateRow($rowToUpdate, $writeString, "contactInfoText.txt");
    }

    if (isset($_POST['contactInfoDeleteSubmit'])) {
        //Get the row number of the contact being modified
        $rowToDelete = intVal($_POST['row_num']);

        deleteRow($rowToDelete, "videos.txt");
    }

    ?>
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
                                    
                                                    <div role=\"group\" class=\"btn-group mx-auto mt-auto\">
                                                        <form role='form' id=\"" . "officers" . $officer . "Delete\" action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "' method=\" POST\">
                                                            <input class=\"btn btn-danger mx-auto\" type=submit name=\"officerDeleteSubmit\" id=\"officerDeleteSubmit\" value=\"Delete\" />
                                                        </form>
                                                        <input form=\"officers$officer\" class=\"btn btn-primary submit-button mx-auto\" type=submit name=\"officerUpdateSubmit\" id=\"officerUpdateSubmit\" value=\"Update Profile\" />
                                                        <button type=\"button\" class=\"btn btn-success mx-auto\" onclick=\"newRow('officerCards',$officer);\">New</button>
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
    <section id="calendar">
        <div class=container-fluid>
            <div class=row>
                <div class=col-lg-10>
                    <h2>Change Calendar</h2>
                    <ul>
                        <li>Go to the Google Calendar you want to share.</li>
                        <li>Click "Options for ______"</li>
                        <li>Click "Settings and sharing"</li>
                        <li>Click "Integrate calendar"</li>
                        <li>Copy/paste the embed code into the box below</li>
                        <li>It will automatically extract the calendar url. Click submit.</li>
                        <li>If it gets a little too trigger happy, and deletes the tail-end of the URL, it might let you type by pressing each key twice (maybe). If it still doesn't work, temporarily block javascript on this site.</li>
                    </ul>
                    <?php
                    $calendarEmbedCodeFile = fopen("data_files/calendarEmbedCode.txt", "r");
                    $embedCode = fread($calendarEmbedCodeFile, filesize("data_files/calendarEmbedCode.txt"));
                    fclose($calendarEmbedCodeFile);
                    ?>
                    <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <textarea class=form-control id="calendarEmbedCode" oninput="extractURL();" name="calendarEmbedCode" style="height:200px"><?php echo $embedCode; ?></textarea>
                        <input class="btn btn-primary" name="calendarEmbedSubmit" type=submit value=Submit>
                    </form>
                    <script>
                        function extractURL() {
                            var userInput = document.getElementById("calendarEmbedCode").value;
                            try {
                                var url = userInput.match(/\bhttps?:\/\/\S+/gi)[0];
                                //Closing " gets picked up by the regex. Remove it. 
                                url = url.substring(0, url.length - 1);
                                // Add a short wait, to make it clear that the original data WAS pasted in correctly. 
                                // Otherwise it looks like nothing happened
                                setTimeout(function() {
                                    document.getElementById("calendarEmbedCode").value = url;
                                }, 500);
                            } catch (TypeError) {
                                //There is no URL in the textbox.
                            }
                        };
                        //Don't resubmit on reload.
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>
                </div>
            </div>
        </div>
    </section>
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
                                    <input form=\"$contact\" class=\"btn btn-primary submit-button\" type=submit name=\"contactInfoUpdateSubmit\" id=\"contactInfoUpdateSubmit\" value=\"Update\"/>
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

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!--Theme js-->
    <script src="js/scrolling-nav.js"></script>
    <script>
        function newRow(tableId, row) {
            switch (tableId) {
                case "officerCards":
                    idPrefix = "officer";
                    break;
                case "videoTable":
                    idPrefix = "video";
                    break;
                case "contactTable":
                    idPrefix = "contactInfo";
                    break;
            }
            var contactTable = document.getElementById(tableId);
            var newContact = contactTable.lastElementChild.cloneNode(true);
            var erasableInputs = newContact.getElementsByClassName("erasable-value");
            newContact.getElementsByClassName("submit-button")[0].name = idPrefix + "NewSubmit";
            newContact.getElementsByClassName("submit-button")[0].id = idPrefix + "NewSubmit";
            newContact.getElementsByClassName("submit-button")[0].setAttribute("form", "new" + idPrefix + "Form");
            newContact.getElementsByClassName("submit-button")[0].value = "Add";
            newContact.getElementsByTagName("form")[0].id = "new" + idPrefix + "Form";
            for (var i = 0; i < erasableInputs.length; i++) {
                erasableInputs[i].value = "";
                erasableInputs[i].setAttribute("form", "new" + idPrefix + "Form");
            }
            contactTable.appendChild(newContact)

        }
    </script>
</body>

</html>
