<?php
/*
Takes a file uploaded via a form, and
saves it to the path specified in the
string $target_file
*/
function savePhoto($photo, $target_file)
{
    /*
    Upload sucessful if 1
    Upload failed if 0
    */
    $uploadOk = 1;
    print_r($photo);
    // Check if image file is a actual image or fake image
    $check = getimagesize($photo["tmp_name"]);
    if ($check !== false) {
        echoToAlert("File is an image - " . $check["mime"] . ".");
        $uploadOk = 1;
    } else {
        echoToAlert("File is not an image.");
        $uploadOk = 0;
    }


    // Allow certain file formats
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echoToAlert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echoToAlert("Sorry, your file was not uploaded.");
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($photo["tmp_name"], $target_file)) {
            echoToAlert("The file " . htmlspecialchars(basename($photo["name"])) . " has been uploaded.");
        } else {
            echoToAlert("Sorry, there was an error uploading your file.");
        }
    }
}

// https://www.php.net/manual/en/features.file-upload.multiple.php
function reArrayFiles($file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);
  
    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }
  
    return $file_ary;
  }

function deleteRowJSON($rowToDelete, $filename)
{
    $readArray = readArrayFromJSON($filename);

    unset($readArray[$rowToDelete]);

    writeArrayToJSON($readArray, $filename);
}

function updateRowJSON($rowToUpdate, $updatedArray, $filename)
{
    $readArray = readArrayFromJSON($filename);

    $readArray[$rowToUpdate] = $updatedArray;

    writeArrayToJSON($readArray, $filename);
}

function addNewRowJSON($arrayToAdd, $filename)
{
    $readArray = readArrayFromJSON($filename);

    array_push($readArray, $arrayToAdd);
    writeArrayToJSON($readArray, $filename);
    
    reorderArrayJSON($filename, sizeof($readArray) - 1, 0);
};

function readArrayFromJSON($filename)
{
    $fileContents = file_get_contents("../data/" . $filename);
    $readArray = json_decode($fileContents, true);
    return $readArray;
};

function writeArrayToJSON($writeArray, $filename)
{
    $writeString = json_encode(array_values($writeArray), JSON_PRETTY_PRINT);

    $writeFile = fopen("../data/" . $filename, "w");
    fwrite($writeFile, $writeString);
    fclose($writeFile);
}

function reorderArrayJSON($filename, $oldIndex, $newIndex){
    $originalArray = readArrayFromJSON($filename);    
    
    $newArray = array_splice($originalArray, $oldIndex, 1);
    array_splice($originalArray, $newIndex, 0, $newArray);
    
    writeArrayToJSON($originalArray, $filename);
}