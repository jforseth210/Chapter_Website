<?php
    /*
    Ends the session and
    redirects to the homepage
    */
    session_start();
    session_destroy();
    header("/chaptersitewip.php");
    exit();
?>
