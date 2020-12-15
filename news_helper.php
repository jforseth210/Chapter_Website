<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("file_functions.php");
if (isset($_POST['get_article'])) {
    $index = intval($_POST['index']);
    $articles = readArrayFromJSON("news.json");
    //print_r($articles);
    echo json_encode($articles[$index]);
}
?>
