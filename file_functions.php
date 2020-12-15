<?php
//Function from internet to reorder array.
require_once("array_shove.php");



//This functions *should* be obsolete.
//I plan to delete them.
function deleteRow($rowToDelete, $filename){
    //Read original file
    $readFile = fopen("../data/" . $filename, "r");
    $readText = fread($readFile, filesize("../data/" . $filename));
    fclose($readFile);
    //Split file by line
    $readArray = explode("\n", $readText);
    //Open the file for writing
    $writeFile = fopen("../data/" . $filename, "w");
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

function updateRow($rowToUpdate, $newString, $filename){
    //Read original file
    $readFile = fopen("../data/" . $filename, "r");
    $readText = fread($readFile, filesize("../data/" . $filename));
    fclose($readFile);
    //Split file by line
    $readArray = explode("\n", $readText);
    //Open the file for writing
    $writeFile = fopen("../data/" . $filename, "w");
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

function addNewRow($stringToAdd, $filename){
    $appendFile = fopen("../data/" . $filename, "a");
    fwrite($appendFile, $stringToAdd . "\n");
    fclose($appendFile);
}

function deleteRowJSON($rowToDelete, $filename){
    $readArray = readArrayFromJSON($filename);

    unset($readArray[$rowToDelete]);

    writeArrayToJSON($readArray, $filename);
}

function updateRowJSON($rowToUpdate, $updatedArray, $filename){
    $readArray = readArrayFromJSON($filename);

    $readArray[$rowToUpdate] = $updatedArray;

    writeArrayToJSON($readArray, $filename);
}

function addNewRowJSON($arrayToAdd, $filename){
    $readArray = readArrayFromJSON($filename);

    array_push($readArray, $arrayToAdd);

    writeArrayToJSON($readArray, $filename);
};

function readArrayFromJSON($filename){
    $fileContents = file_get_contents("../data/" . $filename);
    $readArray = json_decode($fileContents, true);
    return $readArray;
};

function writeArrayToJSON($writeArray, $filename){
    $writeString = json_encode(array_values($writeArray), JSON_PRETTY_PRINT);

    $writeFile = fopen("../data/" . $filename, "w");
    fwrite($writeFile, $writeString);
    fclose($writeFile);
}

function reorderArrayJSON($filename, $rowToMove,$direction){
  $originalArray = readArrayFromJSON($filename);
  $newArray = array_shove($originalArray, $rowToMove, $direction);
  writeArrayToJSON($newArray, $filename);
}
?>
