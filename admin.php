<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

//If the user isn't logged in,
//send them back to the login page.
if (!$_SESSION['valid']) {
    header("Location: login.php");
    exit();
};
//Start the file
echo "<!DOCTYPE html>";
echo "<html lang=\"en\">";

require_once("file_functions.php");

//Load bootstrap, stylesheets, etc.
require_once("admin_templates/head.php");

//Opening body tag
echo "<body>";


//Simple alert for users.
function echoToAlert($message){
    //TODO
}

//console.log
function echoToConsole($message){
    echo "<script>console.log(\"$message\");</script>";
}

//Navbar and header
require_once("admin_templates/header.php");
//About page editor
require_once("admin_templates/about.php");
//About page editor
require_once("admin_templates/about_us_image_gallery.php");

//News Section
require_once("admin_templates/news.php");

//Resource card editor
require_once("admin_templates/resources.php");

//Shared file editor
require_once("admin_templates/shared_files.php");

//Officer card editor
require_once("admin_templates/officers.php");

//Video editor
require_once("admin_templates/videos.php");

//Photo editor
require_once("admin_templates/image_gallery.php");

//Form to replace the Google Calendar link
require_once("admin_templates/calendar.php");

//Contact information editor
require_once("admin_templates/contact.php");

//Javascript
require_once("admin_templates/scripts.php");

echo "</body>";
echo "</html>";
?>
