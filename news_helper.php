<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//JSON r/w helper functions
require_once("file_functions.php");

/*
Send a POST request to news_helper.php
with an "index" parameter.

This returns JSON, a dictionary, with
"news_headline" and "news_article" keys,
for the article at the provided index.
*/
if (isset($_POST['get_article'])) {
    $index = intval($_POST['index']);
    $articles = readArrayFromJSON("news.json");
    //Return the nth article from the article array.
    echo json_encode($articles[$index]);
}
?>
