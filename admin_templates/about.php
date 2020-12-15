<?php
//Form submission
if (isset($_POST['aboutUsSubmit'])) {
    $aboutUsText = $_POST['aboutUsBodyText'];
    $aboutFile = fopen("../data/aboutUsText.txt", "w");
    fwrite($aboutFile, $aboutUsText);
    fclose($aboutFile);
}
?>
<section id="about">
    <div class=container-fluid>
        <div class=row>
            <div class=col-lg-10>
                <h2>About Fairfield FFA</h2>
                <?php
                //require_once("file_functions.php");

                $aboutFile = fopen("../data/aboutUsText.txt", "r");
                $aboutUsText = fread($aboutFile, filesize("../data/aboutUsText.txt"));
                fclose($aboutFile);
                ?>
                <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "#about"; ?>" method="POST">
                    <textarea class=form-control name="aboutUsBodyText" style="height:400px"><?php echo $aboutUsText; ?></textarea>
                    <input class="btn btn-primary" name="aboutUsSubmit" type=submit value=Submit>
                </form>
            </div>
        </div>
    </div>
</section>
