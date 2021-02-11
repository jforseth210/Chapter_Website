<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
echo "<!DOCTYPE html>";
echo "<html lang=\"en\">";

require_once("alert.php");
require_once("file_functions.php");

require_once("user_templates/head.php");

echo "<body id=\"page-top\">";

require_once("user_templates/header.php");

require_once("user_templates/about.php");

require_once("user_templates/news.php");

require_once("user_templates/resources.php");

require_once("user_templates/shared_files.php");

require_once("user_templates/officers.php");

require_once("user_templates/videos.php");

require_once("user_templates/photos.php");

require_once("user_templates/calendar.php");

require_once("user_templates/contacts.php");

require_once("user_templates/footer.php");

require_once("user_templates/scripts.php");

echo "</body>";
echo "</html>";
?>
