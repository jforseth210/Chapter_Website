<?php
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
?>
