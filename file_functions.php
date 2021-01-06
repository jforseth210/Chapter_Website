<?php
//Function from internet to reorder array.
require_once("array_shove.php");


function savePhoto($photo, $target_file)
{
    $uploadOk = 1;

    // Check if image file is a actual image or fake image
    $check = getimagesize($photo["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    /*if ($photo["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    }*/

    // Allow certain file formats
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($photo["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($photo["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
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

function reorderArrayJSON($filename, $rowToMove, $direction)
{
    $originalArray = readArrayFromJSON($filename);
    $newArray = array_shove($originalArray, $rowToMove, $direction);
    writeArrayToJSON($newArray, $filename);
}
