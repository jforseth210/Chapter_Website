<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

//Functions to help with reading and writing from files.
require_once("admin_templates/file_functions.php");

//About Us
if (isset($_POST['aboutUsSubmit'])) {
    $aboutUsText = $_POST['aboutUsBodyText'];
    $aboutFile = fopen("data_files/aboutUsText.txt", "w");
    fwrite($aboutFile, $aboutUsText);
    fclose($aboutFile);
}



//Resources
if (isset($_POST['resourceNewSubmit'])) {
    //Get resource information
    $resourceImageURL = $_POST['resourceImageURL'];
    $resourceName = $_POST['resourceName'];
    $resourceURL = $_POST['resourceURL'];
    $resourceBody = $_POST['resourceBody'];

    $resourceBody = str_replace("\n", "NEWLINE", $resourceBody);
    $resourceBody = str_replace("|", "VERTICALSEPARATOR", $resourceBody);

    $resourceFile = fopen("data_files/resources.txt", "a");
    $resourceString = $resourceImageURL . "|" . $resourceName . "|" . $resourceURL . "|" . $resourceBody;

    addNewRow($resourceString, "resources.txt");
}

if (isset($_POST['resourceUpdateSubmit'])) {
    //Get the row number of the resource being modified
    $rowToUpdate = intVal($_POST['row_num']);
    //Get resource information
    $resourceImageURL = $_POST['resourceImageURL'];
    $resourceName = $_POST['resourceName'];
    $resourceURL = $_POST['resourceURL'];
    $resourceBody = $_POST['resourceBody'];
    
    $resourceBody = str_replace("\n", "NEWLINE", $resourceBody);
    $resourceBody = str_replace("|", "VERTICALSEPARATOR", $resourceBody);
    
    $resourceString = $resourceImageURL . "|" . $resourceName . "|" . $resourceURL . "|" . $resourceBody;

    updateRow($rowToUpdate, $resourceString, "resources.txt");
}

if (isset($_POST['resourceDeleteSubmit'])) {
    //Get the row number of the resource being modified
    $rowToDelete = intVal($_POST['row_num']);

    deleteRow($rowToDelete, "resources.txt");
}



//Shared Files
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


//Officers
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



//Videos

//Add players and their embed codes here. 
$videoTypeConversion = array(
    "Youtube" => "<div class='youtube-player' data-id='VIDEO_ID'></div>",
    "Google Drive" => "<iframe height='100%' width='100%' src='VIDEO_ID' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>"
);
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



//Calendar
if (isset($_POST['calendarEmbedSubmit'])) {
        $calendarEmbedCode = $_POST['calendarEmbedCode'];
        $aboutFile = fopen("data_files/calendarEmbedCode.txt", "w");
        fwrite($aboutFile, $calendarEmbedCode);
        fclose($aboutFile);
}



//Contact

//Add types of contact info and their
//url prefix here. 
$contactTypeConversion = array(
    "Phone Number" => "tel:",
    "Email" => "mailto:",
    "Link" => "https://",
    "Fax" => "fax:"
);
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
