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
?>
<!DOCTYPE html>
<html lang="en">
<?php

//Load bootstrap, stylesheets, etc.
require_once("admin_templates/head.php");

//Opening body tag
?>

<body>
    <div class="modal fade in" id="alert-modal" tabindex="-2" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Information:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="alert-modal-alert"></p>
                </div>
            </div>
        </div>
    </div>
    <?php
    //Javascript
    require_once("admin_templates/scripts.php");
    require_once("alert.php");
    require_once("file_functions.php");

    //Navbar and header
    require_once("admin_templates/header.php");
    //About page editor
    require_once("admin_templates/account.php");
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



    ?>
</body>

</html>